<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_married',
        'user_id',
        'factor_id',
        'subfactor_id',
        'criteion_id'
    ];
}