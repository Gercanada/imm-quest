<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commboard extends Model
{
    public $incrementing = false;
    protected $table = 'vt_CommBoard';

    protected $fillable = [
        'assigned_user_id',
        'name',
        'cf_2218',
        'cf_2224',
        'description',
        'cf_2226'
    ];
}
