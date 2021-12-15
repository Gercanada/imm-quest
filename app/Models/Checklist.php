<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

class Checklist extends Model
{
    public $incrementing = false;
    protected $table = 'vt_checklist';

    public function case(){
       return $this->belongsTo(CPCase::class, 'case_id');
    }

    public function clitems(){
        return $this->hasMany(CLItem::class);
    }
}
