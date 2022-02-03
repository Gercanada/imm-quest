<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Contact;
use App\Models\Commboard;
use Exception;

class CloneDBController extends Controller
{
    /**
     * This function be called as webservice
     * Be created all required by a contact tables for customer portal
     * This method copies the data of a selected contact to the portal's database.
     *  The existing tables in immcase of which we want the contact to have read access are copied.
     * The contact tables that exist in immcase are imported and the data that does not exist in immcase are removed from the portal
     * 1. The tables be created if not exists
     * 2. The dta be inserted
     */
    public function cloneImmcaseContactData(Request $request)
    {
        try {
            $vtiger = new Vtiger();
            $userQuery = DB::table('Contacts')->select('id', 'firstname', 'lastname', 'contact_no')->where("contact_no", $request->contact_no)->take(1);
            $contact = $vtiger->search($userQuery)->result[0]; //Get contact that be cloned
            $contactField = null;

            $data = $vtiger->listTypes();
            $types = $data->result->types;

            $casequery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->id);
            $cases = $vtiger->search($casequery)->result;

            $invoicequery = DB::table('Invoice')->select('*')->where('contact_id', $contact->id);
            $invoices = $vtiger->search($invoicequery)->result;
            $quotequery = DB::table('Quotes')->select('*')->where('contact_id', $contact->id);
            $quotes = $vtiger->search($quotequery)->result;

            foreach ($types as $type) {
                if ( //Select tacles that be cloned on cp
                    ($type === 'InstallmentTracker') ||
                    ($type === 'CommBoard') ||
                    ($type === 'Documents') ||
                    ($type === 'Checklist') ||
                    ($type === 'Payments') ||
                    ($type === 'Contacts') ||
                    ($type === 'HelpDesk') ||
                    ($type === 'CLItems') ||
                    ($type === 'Invoice') ||
                    ($type === 'Currency') ||
                    ($type === 'Quotes') ||
                    ($type === 'Products')
                ) {
                    $description = $vtiger->describe($type);   // get table description to clone (docs in this example)
                    if ($type != 'Currency' || $type != 'Products') {
                        $contactField = 'contact_id';
                    }

                    if ($type === 'Contacts') {
                        $contactField = 'id';
                    }
                    if ($type === 'Documents') {
                        $contactField = 'cf_1488';
                    }
                    if ($type === 'Payments') {
                        $contactField = 'cf_1139';
                    }
                    if ($type === 'Checklist') {
                        $contactField = 'cf_contacts_id';
                    }

                    if ($type === 'CLItems') {
                        $contactField = 'cf_contacts_id';
                    }
                    //Get contact field in tables

                    if (
                        ($type === 'InstallmentTracker') ||
                        ($type === 'CommBoard') ||
                        ($type === 'Currency') ||
                        ($type === 'Products')
                    ) {
                        $list1 = [];
                        $list2 = [];
                        $list3 = [];
                        $list_cnums = [];

                        if ($cases) {
                            foreach ($cases as $case) {
                                array_push($list1, $case->id);
                                array_push($list_cnums, $case->ticket_no);
                            }
                        }
                        if ($type === 'Currency') {
                            $query = DB::table($type)->select('*')->where('deleted', 0); //Installment trackers of quote
                            self::getData($query, $description->result->fields, $contact, $contactField, $description->result->name);
                        }
                        if ($type === 'Products') {
                            $query = DB::table($type)->select('*'); //Installment trackers of quote
                            self::getData($query, $description->result->fields, $contact, $contactField, $description->result->name);
                        }

                        if ($type === 'InstallmentTracker') {
                            if (count($invoices) > 0) {
                                foreach ($invoices as $key => $val) {
                                    foreach ($invoices as $invoice) {
                                        array_push($list2, $invoice->id);
                                    }
                                    $query = DB::table($type)->select('*')->whereIn('cf_1176', $list2); //Installment trackers of quote
                                    self::getData($query, $description->result->fields, $contact, $contactField, $description->result->name);
                                }
                            }
                            if (count($quotes) > 0) {
                                foreach ($invoices as $key => $val) {
                                    foreach ($quotes as $quote) {
                                        array_push($list3, $quote->id);
                                    }
                                    $query = DB::table($type)->select('*')->whereIn('cf_1175', $list3); //Installment trackers of invoice
                                    self::getData($query, $description->result->fields, $contact, $contactField, $description->result->name);
                                }
                            }
                        }
                        if ($type === 'CommBoard') {
                            $query =  DB::table($type)->select('*')
                                ->whereIn('cf_2218', $list1)
                                ->orWhereIn('cf_2218', $list_cnums)
                                ->orWhere('modifiedby', $contact->id);
                            self::getData($query, $description->result->fields, $contact, $contactField, $description->result->name);
                        }
                    } else {
                        $query = DB::table($type)->select('*')->where($contactField, $contact->id);
                        self::getData($query, $description->result->fields, $contact,  $contactField, $description->result->name);
                    }
                }
            }
            //[CloneDBController::class, 'clearTrashDB'];
            return "dataCloned";
        } catch (Exception $e) {
            // /return $e;
            return response()->json($e, 500);
        }
    }

    /**
     * This method must also be used as a webservice from immcase.
     * It consists of importing from the customer portal database to immcase those data that the user can create and update.
     * Among them some personal data, documents and comments (commboard)
     *  Request contact_no
     */
    public function updateOnImmcase(Request $request)
    {
        try {
            $vtiger = new Vtiger();
            //Get contact data of this user
            $cp_contact = Contact::where("contact_no", $request->contact_no)->firstOrFail();
            if ($cp_contact) {
                $userQuery = DB::table('Contacts')->select('*')->where("contact_no", $request->contact_no)->take(1);
                $contact = $vtiger->search($userQuery)->result[0];
                $obj = $vtiger->retrieve($contact->id);
                //Then update the object:
                $obj->result->secondaryemail =  $cp_contact->secondaryemail;
                $obj->result->mobile           =  $cp_contact->mobile;
                $obj->result->cf_1945          =  $cp_contact->cf_1945;
                $obj->result->cf_2254          =  $cp_contact->cf_2254;
                $obj->result->cf_2246          =  $cp_contact->cf_2246;
                $obj->result->cf_2252          =  $cp_contact->cf_2252;
                $obj->result->cf_2250          =  $cp_contact->cf_2250;
                $obj->result->cf_1780          =  $cp_contact->cf_1780;
                $obj->result->user_donotcall   =  $cp_contact->user_donotcall;
                $obj->result->user_emailoptout =  $cp_contact->user_emailoptout;

                $vtiger->update($obj->result);

                // commboard
                $commboards = Commboard::where('modifiedby', $cp_contact->id)->get();
                foreach ($commboards as $comm) {
                    $commQuery = DB::table('CommBoard')->select('*')->where("id", $comm->id)->take(1);
                    $result = $vtiger->search($commQuery)->result;

                    if (count($result) > 0) {
                        $obj2 = $vtiger->retrieve($result[0]->id);
                        $obj2->name = $comm->name;
                        $obj2->assigned_user_id = $comm->assigned_user_id;
                        $obj2->createdtime = $comm->createdtime;
                        $obj2->description = $comm->description;
                        $obj2->modifiedby = $comm->modifiedby;
                        $obj2->cf_2218 = $comm->cf_2218;
                        $obj2->cf_2220 = $comm->cf_2220;
                        $obj2->cf_2224 = $comm->cf_2224;
                        $obj2->cf_2226 = $comm->cf_2226;
                        $obj2->cf_2228 = $comm->cf_222;
                        $vtiger->update($obj2->result);
                    } else {
                        $vtiger = new Vtiger();
                        $values = [
                            'assigned_user_id' => $comm->assigned_user_id,
                            'name' => $comm->name,
                            //'createdtime' => $comm->createdtime,
                            'cf_2218' => $comm->cf_2218,
                            'cf_2220' => $comm->cf_2220,
                            'cf_2224' => $comm->cf_2224,
                            'cf_2226' => $comm->cf_2226,
                            'cf_2228' => $comm->cf_2228,
                            'description' => $comm->description,
                            //'modifiedby' => $comm->modifiedby,
                        ];
                        $newComm =  $vtiger->create("CommBoard", $values);
                        $commboard = Commboard::where('id', $comm->id)->firstOrFail();
                        $commboard->id = $newComm->result->id;
                        $commboard->save();
                    }
                }
                self::clearTrashDB();
                return 200;
            }
        } catch (Exception $e) {
            return $e;
            // return response()->json($e->getMessage(), 500);
        }
    }


    /* Functions */
    static function getData($query, $fields, $contact,  $contactField, $table_name)
    {
        $vtiger = new Vtiger();
        $getted = $vtiger->search($query);
        if (array_key_exists("result", $getted)) {
            $list = $vtiger->search($query)->result;
            $fields = $fields;
            $fieldNames = [];
            $fieldsArr = [];
            foreach ($fields as $key => $field) {
                $fieldAtrs = [];
                foreach ($field as $key2 => $val) {
                    if (($key2 === 'name') || ($key2 === 'type') || ($key2 === 'label')) {
                    } else {
                        array_push($fieldAtrs, self::toMysqlAtr([$key2 => $val])); // Function to convert field attributes
                    }
                }
                $attrtoStr = implode(" ", $fieldAtrs);
                $fieldType = self::toMysqlType($field->type->name); //Function to convert datatypes
                if (str_contains($field->name, '&')) {
                    $field->name = str_replace('&', '', $field->name); // MySql cant write & in fieldname
                }
                if (!in_array("$field->name $fieldType $attrtoStr", $fieldsArr)) {
                    if ($field->name === 'id') {
                        array_push($fieldsArr, "$field->name $fieldType $attrtoStr PRIMARY KEY");
                    } else {
                        array_push($fieldsArr, "$field->name $fieldType $attrtoStr");
                    }
                    array_push($fieldNames, "$field->name");
                }
            }
            $fieldsArrtoSqlStr = implode(", ", $fieldsArr); //Convert fields to mysql string

            $fieldsArrtoSqlStr = "$fieldsArrtoSqlStr, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
            self::jsonToMysqlTable($table_name, $fieldsArrtoSqlStr, $list, $contactField, $contact->id, $contact->contact_no, $fieldNames);
        }
    }

    static function jsonToMysqlTable($tablename, $sqlStr, $tableData, $contactField, $contactID, $contactNo, $fields)
    {
        $tableIdsArr = []; // Items id from immcase thath be added to CP
        DB::unprepared("CREATE TABLE IF NOT EXISTS vt_$tablename($sqlStr)"); // If table not exists be reated

        foreach ($tableData as $row) { //set values in table
            $table = null;
            $tableRows = null;
            $username = null;
            $userPass = null;
            $firstname = null;
            $last_name = null;
            $email = null;
            $nameFields = [];
            $dataFields = [];
            $toUpdate   = [];
            $beforeRows = [];

            if ($tablename === 'InstallmentTracker') {
                //Installment tracker can be of invoices or quotes
                foreach ($tableData as $row2) {
                    if ($row2->cf_1175 != '') {
                        $table = DB::select("SELECT COUNT('id') as total FROM vt_$tablename WHERE id = '$row2->id' AND cf_1175  =  '$row2->cf_1175';");
                        $tableRows = DB::select("SELECT * FROM vt_$tablename LIMIT 1;");
                    }
                    if ($row2->cf_1176 != '') {
                        $table = DB::select("SELECT * FROM vt_$tablename WHERE id = '$row2->id' AND cf_1176 = '$row2->cf_1176';");
                        $tableRows = DB::select("SELECT * FROM vt_$tablename LIMIT 1;");
                    }
                }
            } else {
                $table = DB::select("SELECT COUNT('id') as total FROM vt_$tablename WHERE  id = '$row->id';"); //search current table on CP
                $tableRows = DB::select("SELECT * FROM vt_$tablename LIMIT 1;"); //search current table on CP
            }
            /*  if ($tablename === "Contacts") {
                dd ($tableRows);
            } */
            foreach ($row as $key => $val) {
                if (in_array($key, $fields)) {
                    array_push($nameFields, $key);
                    array_push($dataFields, "'$val'");
                    array_push($toUpdate, [$key => $val]);
                    if ($key === 'id') {
                        $id = $val;
                        array_push($tableIdsArr, $id);
                    }
                }
            }
            $names =   implode(", ", $nameFields);
            $data  =   implode(", ", $dataFields);

            if (count($tableRows) > 0) {
                foreach ($tableRows[0] as $key => $val) {
                    array_push($beforeRows, $key);
                }
            }

            foreach ($nameFields as $name) {
                foreach ($beforeRows as $rKey) {
                    if (!in_array($rKey, $nameFields)) {
                        $rows = DB::select("SELECT * FROM vt_$tablename LIMIT 1");
                        $newKeyArr = [];
                        foreach ($rows[0] as $key => $row) {
                            array_push($newKeyArr, $key);
                        }
                        if (in_array($rKey, $newKeyArr)) {
                            DB::statement("ALTER TABLE vt_$tablename DROP COLUMN  $rKey");
                        }
                    }
                }
            }
            foreach ($nameFields as $name) {
                if (!in_array($name, $beforeRows)) {
                    foreach ($beforeRows as $befo) {
                        $rows = DB::select("SELECT * FROM vt_$tablename LIMIT 1");
                        $newKeyArr = [];
                        foreach ($rows[0] as $key => $row) {
                            array_push($newKeyArr, $key);
                        }
                        if (!in_array($name, $newKeyArr)) {
                            DB::statement("ALTER TABLE vt_$tablename ADD COLUMN $name VARCHAR(155) AFTER  $befo");
                        }
                    }
                }
            }
            /* if ($tablename === 'Contacts') {
                dd ([$nameFields, $tableRows]);
            } */

            if (count($table) > 0 && $table[0]->total === 0) { //If noting found be created
                DB::insert("INSERT INTO vt_$tablename($names) VALUES($data);");
                foreach ($toUpdate as $toup) {
                    foreach ($toup as $key => $val) {
                        if ($tablename === 'Contacts') {
                            if ($tablename === 'Contacts') { //Create user from contacts
                                if ($key === 'cf_1888') {
                                    $username = $val;
                                }
                                if ($key === 'cf_1780') {
                                    $userPass = $val;
                                }
                                if ($key === 'firstname') {
                                    $firstname = $val;
                                }
                                if ($key === 'lastname') {
                                    $last_name = $val;
                                }
                                if ($key === 'email') {
                                    $email = $val;
                                }
                            }
                        }
                    }
                    if ($tablename === 'Contacts') {
                        if ($username && $userPass && $last_name && $firstname) {
                            $newUID = self::newUser($username, $userPass, $firstname, $last_name, $contactNo, $email);
                            array_push($tableIdsArr, $newUID);
                        }
                    }
                }
            } else {
                $id = null;
                $newValues = [];
                $newValueKeys = [];
                foreach ($toUpdate as $toup) {
                    foreach ($toup as $key => $val) {
                        $val = self::prepareStrConvertion($val);
                        $newValues['*' . $key . '*'] = $val;
                        array_push($newValueKeys, $key);
                        if ($key === 'id') { //Ger row id
                            $id = $val;
                        }
                        if ($tablename === 'Contacts') { //Create user from contacts
                            if ($key === 'cf_1888') {
                                $username = $val;
                            }
                            if ($key === 'cf_1780') {
                                $userPass = $val;
                            }
                            if ($key === 'firstname') {
                                $firstname = $val;
                            }
                            if ($key === 'lastname') {
                                $last_name = $val;
                            }
                            if ($key === 'email') {
                                $email = $val;
                            }
                        }
                    }
                    if ($tablename === 'Contacts') {
                        if ($username && $userPass && $last_name && $firstname) {
                            $newUID = self::newUser($username, $userPass, $firstname, $last_name, $contactNo, $email);
                            array_push($tableIdsArr, $newUID);
                        }
                    }
                } //end loop

                if (count($table) > 0 && $table[0]->total > 0) { //If table has founded row be updated
                    $setValues = self::jsonToSetOnMysql($newValues);
                    DB::update("UPDATE vt_$tablename set $setValues WHERE id = '$id';");
                }
            }
        }
    }

    public function clearTrashDB()
    {
        try {
            $vtiger = new Vtiger();
            $data = $vtiger->listTypes();
            $types = $data->result->types;
            $deleted = 0;
            foreach ($types as $type) {
                if ( //Select tacles that be cloned on cp
                    ($type === 'InstallmentTracker') ||
                    ($type === 'CommBoard') ||
                    ($type === 'Documents') ||
                    ($type === 'Checklist') ||
                    ($type === 'Payments') ||
                    ($type === 'Contacts') ||
                    ($type === 'HelpDesk') ||
                    ($type === 'CLItems') ||
                    ($type === 'Invoice') ||
                    ($type === 'Currency') ||
                    ($type === 'Quotes') ||
                    ($type === 'Products')
                ) {
                    $localvalues = DB::select("SELECT id FROM vt_$type");
                    $idvalues = [];
                    foreach ($localvalues as $loca) {
                        array_push($idvalues, $loca->id);
                    }

                    $vt_query = DB::table($type)->select('id')->whereIn("id", $idvalues)->take(1);
                    $result = $vtiger->search($vt_query);
                    if ($result->success === false) {
                        DB::table("vt_$type")->whereNotIn('id', $idvalues)->delete();
                        $deleted = $deleted + 1;
                    }
                }
            }
            return response()->json("Success. $deleted Records deleted", 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }


    public function updateCLItemFromImmcase(Request $request)
    {
        try {
            if ($request->clitemsno) {
                $vtiger = new Vtiger();
                $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $request->clitemsno)->take(1);
                $clitem =  $vtiger->search($clitemQuery)->result[0];
                $description = $vtiger->describe('CLItems');
                $contact = Contact::where("id", $clitem->cf_contacts_id)->firstOrFail();
                $contactField = "cf_contacts_id";
                self::getData($clitemQuery, $description->result->fields, $contact, $contactField, $description->result->name);
                return response()->json(['Success', $clitem->id], 200);
            }
        } catch (Exception $e) {
            return response()->json("error", 500);
        }
    }

    public function updateChecklistFromImmcase(Request $request)
    {
        try {
            if ($request->checklist_id) {
                $vtiger = new Vtiger();
                $clitemQuery = DB::table('Checklist')->select('*')->where("id", $request->checklist_id)->take(1);
                $clitem =  $vtiger->search($clitemQuery)->result[0];
                $description = $vtiger->describe('Checklist');
                $contact = Contact::where("id", $clitem->cf_contacts_id)->firstOrFail();
                $contactField = "cf_contacts_id";
                self::getData($clitemQuery, $description->result->fields, $contact, $contactField, $description->result->name);
                return response()->json(['Success', $clitem->id], 200);
            }
        } catch (Exception $e) {
            return response()->json("error", 500);
        }
    }

    static function prepareStrConvertion($val)
    {
        if (
            str_contains($val, ':') ||
            str_contains($val, '{') ||
            str_contains($val, '}')
        ) {
            $val =  str_replace(':', '*~*', $val);
            $val =  str_replace('{', '*<*', $val);
            $val =  str_replace('}', '*>*', $val);
        }
        return $val;
    }

    static function jsonToSetOnMysql($array)
    {
        $jsonEncoded = (json_encode($array));
        $replace1 = str_replace('{', '', $jsonEncoded);
        $replace2 = str_replace('}', '', $replace1);
        $replace3 = str_replace(':', '=', $replace2);
        $replace3 = str_replace('*~*', ':', $replace3);
        $replace3 = str_replace('*<*', '{', $replace3);
        $replace3 = str_replace('*>*', '>', $replace3);
        $replace4 = str_replace('"*', '', $replace3);
        $replace5 = str_replace('*"', '', $replace4);
        $replace6 = str_replace('"', "'", $replace5);
        $replace6 = str_replace('\\', "", $replace6);
        return $replace6;
    }

    static function newUser($username, $userPass, $firstname, $last_name, $contactNo, $email)
    {
        $newUser = User::updateOrCreate(
            ['vtiger_contact_id' =>  $contactNo],
            [
                'user_name' => $username,
                'vtiger_contact_id' =>  $contactNo,
                'name' =>  $firstname,
                'last_name' =>  $last_name,
                'email' =>  $email,
                'password' => Hash::make($userPass),
            ]
        );
        return $newUser->id;
    }

    static function toMysqlType($value) //convert JSON data types to mysql datatypes
    {
        $PHP_mysql_TYPES = [
            'string' => 'VARCHAR(255)',
            'integer' => 'INT',
            'float' => 'DOUBLE',
            'boolean' => 'BOOL',
            'array' => 'LONGBLOB',
            'object' => 'LONGBLOB',
            //'null' => 'NULL',
            'resource' => 'LONGBLOB',
            'file' => 'LONGBLOB'
        ];
        foreach ($PHP_mysql_TYPES as $key => $type) {
            if (gettype($value) === $key) {
                return $type;
            }
        }
    }

    static function toMysqlAtr($value) // Json field attributes to mysql create attributes
    {
        $PHP_mysql_attr = [ //if false
            'mandatory' => 'NOT NULL',
            'isunique' => 'UNIQUE',
            'nullable' => 'NULL',
            'default' => "DEFAULT"
        ];
        $arr = [];

        foreach ($value as $keyA => $x) {
            foreach ($PHP_mysql_attr as $keyB => $attr) {
                array_push($arr, $attr);
                if ($keyA == $keyB && $keyA == 'default') {
                    return "$attr '$x'";
                }
                if ($keyA == $keyB && ($x !== false) && (!in_array($attr, $arr))) {
                    return  $attr;
                }
            }
        }
    }

    public function duplicateContacts(Request $request)
    {
        $string = 'This is a string';
        $lastChar = substr($string, -1);
        return "The last char of the string is $lastChar";

        $contactid = '192168';
        $lst = substr($contactid, -1);

        if ($contactid)


            $vtiger = new Vtiger();
        $userQuery = DB::table('Contacts')->select('*')->where('lastname', 'like', '%' . $request->lastname . '%');
        $contacts = $vtiger->search($userQuery)->result; //Get contact that be cloned

        $duplicates = [];
        $namesArr = [];
        $lastNamesArr = [];
        $emailsArr = [];
        $msg = '';

        foreach ($contacts as $contact) {
            array_push($namesArr,  $contact->firstname);
            array_push($lastNamesArr,  $contact->lastname);
            array_push($emailsArr,  $contact->email);
        }

        function showDups($array)
        {
            $array_temp = array();
            foreach ($array as $val) {
                if (!in_array($val, $array_temp)) {
                    $array_temp[] = $val;
                } else {
                    return $val;
                }
            }
        }

        foreach ($contacts as $contact) {
            if ($request->by_firstname === '1' && $request->by_lastname === '1'  && $request->by_email === '1') { //Firstname,  lastname, email duplicates
                $msg = 'Duplicated firstname, lastname and email';
                if ($contact->firstname === showDups($namesArr) && $contact->lastname === showDups($lastNamesArr)) {
                    array_push($duplicates,  ['firstname' => $contact->firstname, 'lastname' => $contact->lastname, 'email' => $contact->email, 'contact_no' => $contact->contact_no]);
                }
            } else
            if ($request->by_firstname === '1' && $request->by_lastname === '1') { //Firstname and lastname duplicates
                $msg = 'Duplicated firstname and lastname';
                if ($contact->firstname === showDups($namesArr) && $contact->lastname === showDups($lastNamesArr)) {
                    array_push($duplicates,  ['firstname' => $contact->firstname, 'lastname' => $contact->lastname, 'email' => $contact->email, 'contact_no' => $contact->contact_no]);
                }
            } else
            if ($request->by_lastname === '1') { //lastname
                $msg = 'Duplicated lastname';
                if ($contact->lastname === showDups($lastNamesArr)) {
                    array_push($duplicates,  ['firstname' => $contact->firstname, 'lastname' => $contact->lastname, 'email' => $contact->email, 'contact_no' => $contact->contact_no]);
                }
            } else
            if ($request->by_firstname === '1') { //firstname
                $msg = 'Duplicated  firstname ';
                if ($contact->firstname === showDups($namesArr)) {
                    array_push($duplicates,  ['firstname' => $contact->firstname, 'lastname' => $contact->lastname, 'email' => $contact->email, 'contact_no' => $contact->contact_no]);
                }
            } else
            if ($request->by_email === '1') { //email
                $msg = 'Duplicated  email ';
                if ($contact->email === showDups($emailsArr)) {
                    array_push($duplicates,  ['firstname' => $contact->firstname, 'lastname' => $contact->lastname, 'email' => $contact->email, 'contact_no' => $contact->contact_no]);
                }
            }
        }
        return response()->json([$msg => $duplicates]);
    }

    public function testCodeFrag()
    {
        $url = 'https://immvisas.com//storage/app/public/documents/contact/2156722/cases/A2145420-Work%20Permit/checklists/CL2141417-/clitems/CLI4002016-Document/saturn.png';
        $output = "no";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_NOBODY => true
        ));

        $header = explode("\n", curl_exec($curl));
        curl_close($curl);
        return $header;
        /* Get url headers */

        if (strpos($header[0], "200") !== false) {
            $output =  "yes";
        }

        return response()->json($header);
        //$url =str_replace(' ', '%20', $url);
        $array = get_headers($url);
        $string = $array[0];
        if (strpos($string, "200")) {
            $output =  "yes";
        }
        return $output;
    }
}
