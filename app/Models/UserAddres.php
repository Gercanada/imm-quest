<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddres extends Model
{
    use HasFactory;


    protected $connection = 'vtiger_mysql';

    protected $table = 'vtiger_contactaddress';
    public $timestamps = false;

    protected $primaryKey = 'contactaddressid';

    protected $fillable = [
        'contactaddressid',
        'mailingcity',
        'mailingstreet',
        'mailingcountry',
        'othercountry',
        'mailingstate',
        'mailingpobox',
        'othercity',
        'otherstate',
        'mailingzip',
        'otherzip',
        'otherstreet',
        'otherpobox'
    ];
}
