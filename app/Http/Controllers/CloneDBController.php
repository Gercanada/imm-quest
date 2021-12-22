<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Contact;
use Exception;

class CloneDBController extends Controller
{
    /**
     * This function be called as webservice
     * Be created all required by a contact tables for customer portal
     * 1. The tables be created if not exists
     * 2. The dta be inserted
     */
    public function cloneImmcaseContactData(Request $request)
    {
        $vtiger = new Vtiger();
        $userQuery = DB::table('Contacts')->select('id', 'firstname', 'lastname', 'contact_no')->where("contact_no", $request->contact_no)->take(1);
        $contact = $vtiger->search($userQuery)->result[0];

        $data = $vtiger->listTypes();
        $types = $data->result->types;


        $casequery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->id);
        $cases = $vtiger->search($casequery)->result;

        $invoicequery = DB::table('Invoice')->select('*')->where('contact_id', $contact->id);
        $invoices = $vtiger->search($invoicequery)->result;
        $quotequery = DB::table('Quotes')->select('*')->where('contact_id', $contact->id);
        $quotes = $vtiger->search($quotequery)->result;


        $typeArr = [];
        $resp = null;
        $respArr = [];
        foreach ($types as $type) {
            if (
                ($type === 'Documents') ||
                ($type === 'Checklist') ||
                ($type === 'Payments') ||
                ($type === 'Contacts') ||
                ($type === 'HelpDesk') ||
                ($type === 'Invoice') ||
                ($type === 'Quotes') ||
                ($type === 'InstallmentTracker') ||
                ($type === 'CommBoard') ||
                ($type === 'CLItems')
            ) {
                $description = $vtiger->describe($type);   // get table description to clone (docs in this example)
                $contactField = 'contact_id';

                if ($type === 'Contacts') {
                    $contactField = 'id';
                }
                if ($type === 'Documents') {
                    $contactField = 'cf_1488';
                }
                if ($type === 'Payments') {
                    $contactField = 'cf_1139';
                }
                if ($type === 'CLItems') {
                    $contactField = 'cf_contacts_id';
                }
                $query = DB::table($type)->select('*')->where($contactField, $contact->id);

                if (($type === 'Checklist') ||
                    ($type === 'InstallmentTracker') ||
                    ($type === 'CommBoard')
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
                    if ($type === 'Checklist') {
                        $contactField = 'cf_contacts_id';
                        $query = DB::table($type)->select('*')->whereIn('cf_1199', $list1); //is in cases id arr
                    }

                    if ($type === 'InstallmentTracker') {

                        if (count($invoices) > 0) {
                            foreach ($invoices as $key => $val) {
                                foreach ($invoices as $invoice) {
                                    array_push($list2, $invoice->id);
                                }
                                $query = DB::table($type)->select('*')->whereIn('cf_1176', $list2); //Installment trackers of quote
                                $resp = self::getData($query, $description->result->fields, $contact,  $contactField, $description->result->name);
                            }
                        }
                        if (count($quotes) > 0) {
                            foreach ($invoices as $key => $val) {
                                foreach ($quotes as $quote) {
                                    array_push($list3, $quote->id);
                                }
                                $query = DB::table($type)->select('*')->whereIn('cf_1175', $list3); //Installment trackers of invoice
                                $resp = self::getData($query, $description->result->fields, $contact,  $contactField, $description->result->name);
                            }
                        }
                    }
                    if ($type === 'CommBoard') {
                        $query =  DB::table($type)->select('*')
                            ->whereIn('cf_2218', $list1)
                            ->orWhereIn('cf_2218', $list_cnums);
                        $resp = self::getData($query, $description->result->fields, $contact,  $contactField, $description->result->name);
                    }
                } else {
                    $resp =  self::getData($query, $description->result->fields, $contact,  $contactField, $description->result->name);
                }
            }

            //dd($resp);
        }

        return "dataCloned";
    }

    public function updateOnImmcase(Request $request)
    {
        try {
            $user = Auth::user();
            $vtiger = new Vtiger();
            //Get contact data of this user
            $cp_contact = Contact::where("contact_no", $request->contact_no)->firstOrFail();

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

            $data = $vtiger->update($obj->result);

            // Quotes
            //CLItems
            //Payments
            return 200;
        } catch (Exception $e) {
            return response()->json("Error", 500);
        }
    }


    /* Functions */
    static function getData($query, $fields, $contact,  $contactField, $table_name)
    {
        $vtiger = new Vtiger();
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
                array_push($fieldsArr, "$field->name $fieldType $attrtoStr");
                array_push($fieldNames, "$field->name");
            }
        }
        $fieldsArrtoSqlStr = implode(", ", $fieldsArr); //Convert fields to mysql string

        $fieldsArrtoSqlStr = "$fieldsArrtoSqlStr, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        self::jsonToMysqlTable($table_name, $fieldsArrtoSqlStr, $list, $contactField, $contact->id, $contact->contact_no, $fieldNames);
    }

    static function jsonToMysqlTable($tablename, $sqlStr, $tableData, $contactField, $contactID, $contactNo, $fields)
    {
        DB::unprepared("CREATE TABLE IF NOT EXISTS vt_$tablename($sqlStr)");

        $resp = null;

        foreach ($tableData as $row) {
            $table = null;
            $table_has = null;
            $username = null;
            $userPass = null;
            $firstname = null;
            $last_name = null;
            $nameFields = [];
            $dataFields = [];
            $toUpdate   = [];


            if (($tablename === 'Checklist')  || ($tablename === 'InstallmentTracker')) {
                if ($tablename === 'Checklist') {
                    $table = DB::select("SELECT COUNT('id') as total FROM vt_$tablename WHERE id = '$row->id';");
                }
                if ($tablename === 'InstallmentTracker') {
                    foreach ($tableData as $row2) {
                        if ($row2->cf_1175 != '') {
                            $table = DB::select("SELECT COUNT('id') as total FROM vt_$tablename WHERE id = '$row2->id' AND cf_1175  =  '$row2->cf_1175';");
                            $table_has =  DB::select("SELECT 'id' as table_id FROM vt_$tablename WHERE id = '$row2->id' AND cf_1175  =  '$row2->cf_1175';");
                        }
                        if ($row2->cf_1176 != '') {
                            $table = DB::select("SELECT COUNT('id') as total FROM vt_$tablename WHERE id = '$row2->id' AND cf_1176 = '$row2->cf_1176';");
                            $table_has =  DB::select("SELECT 'id' as table_id FROM vt_$tablename WHERE id = '$row2->id' AND cf_1176 = '$row2->cf_1176';");
                        }
                    }
                }
            } else {
                $table = DB::select("SELECT COUNT('id') as total FROM vt_$tablename WHERE  id = '$row->id';"); //$contactField = '$contactID' AND
                $table_has =  DB::select("SELECT 'id' as table_id FROM vt_$tablename WHERE  id = '$row->id';");
            }

            foreach ($row as $key => $val) {
                if ($contactField === $key && ($val != null)) {
                    $contactID = $val;
                }
                if (in_array($key, $fields)) {
                    array_push($nameFields, $key);
                    array_push($dataFields, "'$val'");
                    array_push($toUpdate, [$key => $val]);
                }
            }
            $names =   implode(", ", $nameFields);
            $data  =   implode(", ", $dataFields);

            if ($table[0]->total === 0) { //If noting found be created
                DB::insert("INSERT INTO vt_$tablename($names) VALUES($data);");
            }

            foreach ($toUpdate as $toup) {
                $tableIdsArr = [];
                foreach ($toup as $key => $val) {
                    $id = null;
                    if ($key === 'id') {
                        $id = $val;
                        array_push($tableIdsArr, $id);
                    }
                    if ($table[0]->total > 0) { //If table has founded row be updated
                        if (($tablename === 'Checklist') || ($tablename === 'InstallmentTracker') || ($tablename === 'CommBoard')) { //If table hasnt contact field
                            DB::update("UPDATE vt_$tablename set $key = '$val' WHERE id = '$id';");
                        } else {
                            DB::update("UPDATE vt_$tablename set $key = '$val' WHERE  $contactField = '$contactID' AND id = '$id';");
                        }
                    }
                    //if not exist on vt will delete here
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

                        if ($username !== null && $userPass !== null) {
                            User::firstOrCreate(['vtiger_contact_id' =>  $contactNo], [
                                'user_name' => $username,
                                'vtiger_contact_id' =>  $contactNo,
                                'name' =>  $firstname,
                                'last_name' =>  $last_name,
                                'password' => Hash::make($userPass),
                            ]);
                        }
                    }
                }
            } //end loop
            DB::table("vt_$tablename")->whereNotIn('id', $tableIdsArr)->delete();
        }
        //  dd($resp);
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

    public function testRequest(Request $request)
    {
    }
}
