<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VtigerType extends Model
{
    use HasFactory;

    protected $primary = 'name';

    protected $fillable = [
        'user_id',
        'name',
        'is_active'
    ];
}
