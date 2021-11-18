<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    public function case(){
       return $this->belongsTo(CPCase::class, 'case_id');
    }

    public function clitems(){
        return $this->hasMany(CLItem::class);
    }
}
