<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'body' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'is_married',
        'name',
        'body',
        'is_theactual'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
