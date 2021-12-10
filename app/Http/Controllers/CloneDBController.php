<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

class CloneDBController extends Controller
{
    public function createTable(Request $request)
    {

        $type = 'Documents';
        $vtiger = new Vtiger();
        $description = $vtiger->describe($type);
        //return $data->result;

        $query = DB::table($type)->select('*');
        $data = $vtiger->search($query)->result;
        $tablename = $description->result->name . '01';

        /* return JSON.stringify(json_encode($data)); */

        DB::unprepared('CREATE TABLE IF NOT EXISTS' . ' ' . $tablename . '(`fields` JSON NULL)');

        $encoded = "'".json_encode($data)."'";
        return $encoded;
        DB::unprepared('INSERT INTO'.' '.$tablename.' '.'VALUES ('.$encoded.')');

        return 'ok';

        /* $fields = DB::select("select * from $description->result->name");


foreach($fields as $key =>$field){
    if()

} */


        /* DB::insert("insert into $description->result->name (fields) values ($data), [1, 'Marc']");


        DB::update(
            'update users set votes = 100 where name = ?',
            ['Anita']
        );



        DB::unprepared('INSERT INTO facts VALUES
         (JSON_OBJECT($data))'); */

        ////return self::jsonToMysqlTable($data->result, $type);
    }

    //////////////////
    static function jsonToMysqlTable($jsonObj, $tableName)
    {
        DB::unprepared("CREATE TABLE IF NOT EXISTS $jsonObj->name
        ('fields' JSON NULL");
    }

    static function toMysqlType($value)
    {
        $PHP_mysql_TYPES = [
            'string' => 'varchar(max)',
            'integer' => 'INT',
            'float' => 'DOUBLE',
            'boolean' => 'BOOL',
            'array' => 'LONGBLOB',
            'object' => 'LONGBLOB',
            'null' => 'NULL',
            'resource' => 'LONGBLOB'
        ];

        foreach ($PHP_mysql_TYPES as $key => $type) {
            if (gettype($value) === $key) {
                return $type;
            }
        }
        if (gettype($value) === 'string') {
            return "varchar(max)";
        }
    }
}
