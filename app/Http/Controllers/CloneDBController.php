<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

class CloneDBController extends Controller
{
    public function createTable(Request $request)
    {
        $vtiger = new Vtiger();
        $userQuery = DB::table('Contacts')->select('id', 'firstname', 'lastname')->where("contact_no", $request->contact_no)->take(1);
        $contact = $vtiger->search($userQuery)->result[0];

        $data = $vtiger->listTypes();
        $types = $data->result->types;
        //return $types;//[]

        foreach ($types as $type) {
            // $type = 'Documents';
            if (($type === 'Documents') || ($type === 'Checklist') || ($type === 'Payments') || ($type === 'CLItems')) {
                $description = $vtiger->describe($type);   // get table description to clone (docs in this example)
                $query = DB::table($type)->select('*');
                $list = $vtiger->search($query)->result;

                $contactField = 'contact_id';

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
                $fields = $description->result->fields;

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
                    array_push($fieldsArr, "$field->name $fieldType $attrtoStr");
                }
                $fieldsArrtoSqlStr = implode(", ", $fieldsArr); //Convert fields to mysql string
                self::jsonToMysqlTable($description->result->name, $fieldsArrtoSqlStr, $list, $contactField, $contact->id);
            }
        }
        return "dataCloned";
    }

    /* Functions */
    static function jsonToMysqlTable($tablename, $sqlStr, $tableData, $contactField, $contactID)
    {
        $nameFields = [];
        $dataFields = [];
        $toUpdate = [];
        $contactID = null;

        DB::unprepared("CREATE TABLE IF NOT EXISTS vt_$tablename($sqlStr)");

        foreach ($tableData as $row) {
            foreach ($row as $key => $val) {
                if ($contactField === $key && ($val != null)) {
                    $contactID = $val;
                }
                if ($key != 'imageattachmentids') {
                    array_push($nameFields, $key);
                    array_push($dataFields, "'$val'");
                    array_push($toUpdate, [$key => $val]);
                }
            }

            $names =   implode(", ", $nameFields);
            $data =   implode(", ", $dataFields);

            $table = DB::select("SELECT COUNT('$contactField') as total FROM vt_$tablename WHERE $contactField = '$contactID' ;");
            if ($table[0]->total > 0) {
                foreach ($toUpdate as $toup) {
                    foreach ($toup as $key => $val) {
                        DB::update("UPDATE vt_$tablename set $key = '$val' WHERE  $contactField = '$contactID';");

                        //if not exist on vt will delete here
                    }
                }
            } else {
                DB::insert("INSERT INTO vt_$tablename ($names) VALUES ($data);");
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
