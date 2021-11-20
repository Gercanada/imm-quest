<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubDetail extends Model
{
    use HasFactory;
    protected $connection = 'vtiger_mysql';
    protected $table = 'vtiger_contactsubdetails';
    public $timestamps = false;

    protected $primaryKey = 'contactsubscriptionid';

    protected $fillable = [
        'contactsubscriptionid',
        'homephone',
        'otherphone',
        'assistant',
        'assistantphone',
        'birthday',
        'laststayintouchrequest',
        'laststayintouchsavedate',
        'leadsource'
    ];
}
