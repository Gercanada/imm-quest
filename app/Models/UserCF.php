<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCF extends Model
{
    use HasFactory;

    protected $connection = 'vtiger_mysql';

    protected $table = 'vtiger_contactscf';

    protected $primaryKey = 'contactid';
    protected $fillable = ['contactid'];
    public $timestamps = false;
}
