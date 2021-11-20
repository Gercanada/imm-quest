<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $connection = 'vtiger_mysql';
    protected $table = 'vtiger_contactdetails';
    public $timestamps = false;

    protected $primaryKey = 'contactid';

    protected $fillable = [
        'email',
        'phone',
        'mobile',
        'title',
        'department',
        'fax',
        'reportsto',
        'training',
        'usertype',
        'contacttype',
        'otheremail',
        'secondaryemail',
        'donotcall',
        'emailoptout',
        'imagename',
        'reference',
        'notify_owner',
        'isconvertedfromlead',
        'contact_no',
        'lastname',
        'contactid',
    ];
}
