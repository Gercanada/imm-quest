<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CloneDBController extends Controller
{
    /**
     * This function be called as webservice
     * Be created all required by a contact tables for customer portal
     * 1. The tables be created if not exists
     * 2. The dta be inserted
     */
    public function createTable(Request $request)
    {
        $vtiger = new Vtiger();
        $userQuery = DB::table('Contacts')->select('id', 'firstname', 'lastname', 'contact_no')->where("contact_no", $request->contact_no)->take(1);
        $contact = $vtiger->search($userQuery)->result[0];

        $data = $vtiger->listTypes();
        $types = $data->result->types;
        //return $types;//[]

        $casequery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->id);
        $cases = $vtiger->search($casequery)->result;

        foreach ($types as $type) {
            // $type = 'Documents';
            if (
                ($type === 'Documents') ||
                ($type === 'Checklist') ||
                ($type === 'Payments') ||
                ($type === 'Contacts') ||
                ($type === 'HelpDesk') ||
                ($type === 'Invoice') ||
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
                if ($type === 'Checklist') {
                    $contactField = 'cf_contacts_id';
                }
                if ($type === 'Payments') {
                    $contactField = 'cf_1139';
                }
                if ($type === 'CLItems') {
                    $contactField = 'cf_contacts_id';
                }

                $query = DB::table($type)->select('*')->where($contactField, $contact->id);

                if ($type === 'Checklist') {
                    $list1 = [];
                    if ($cases) {
                        foreach ($cases as $case) {
                            array_push($list1, $case->id);
                        }
                    }
                    $query = DB::table($type)->select('*')->whereIn('cf_1199', $list1)->select('*'); //is in cases id arr
                }

                $list = $vtiger->search($query)->result;
                $fields = $description->result->fields;
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
                self::jsonToMysqlTable($description->result->name, $fieldsArrtoSqlStr, $list, $contactField, $contact->id, $contact->contact_no, $fieldNames);
            }
        }
        return "dataCloned";
    }

    /* Functions */
    static function jsonToMysqlTable($tablename, $sqlStr, $tableData, $contactField, $contactID, $contactNo, $fields)
    {
        DB::unprepared("CREATE TABLE IF NOT EXISTS vt_$tablename($sqlStr)");

        $table = DB::select("SELECT COUNT('$contactField') as total FROM vt_$tablename WHERE $contactField = '$contactID' ;");


        foreach ($tableData as $row) {
            if($tablename ==='Checklist'){
                 $table = DB::select("SELECT COUNT('id') as total FROM vt_$tablename WHERE id = '$row->id' ;");
            }

            $nameFields = [];
            $dataFields = [];
            $toUpdate   = [];

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



            $username = null;
            $userPass = null;

            foreach ($toUpdate as $toup) {
                foreach ($toup as $key => $val) {
                    if ($table[0]->total > 0) {
                        DB::update("UPDATE vt_$tablename set $key = '$val' WHERE  $contactField = '$contactID';");
                    }
                    //if not exist on vt will delete here
                    if ($tablename === 'Contacts') {
                        if ($key === 'cf_1888') {
                            $username = $val;
                        }
                        if ($key === 'cf_1780') {
                            $userPass = $val;
                        }
                    }
                }                //
                if ($tablename === 'Contacts' /* && $table[0]->total == 0 */) { //Create CPuser from contact
                    if ($username !== null && $userPass !== null) {
                        User::firstOrCreate(['vtiger_contact_id' =>  $contactNo], [
                            'user_name' => $username,
                            'vtiger_contact_id' =>  $contactNo,
                            'password' => Hash::make($userPass),
                        ]);
                    }
                }
            } //end loop

            if ($table[0]->total == 0) {
                DB::insert("INSERT INTO vt_$tablename($names) VALUES($data);");
                //Insertion data as string
            }
        }
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
            'null' => 'NULL',
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

        foreach ($value as $keyA => $x) {
            foreach ($PHP_mysql_attr as $keyB => $attr) {
                if ($keyA == $keyB && $keyA == 'default') {
                    return "$attr '$x'";
                }
                if ($keyA == $keyB && ($x !== false)) {
                    return  $attr;
                }
            }
        }
    }
}
