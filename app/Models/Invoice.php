<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $incrementing = false;
    protected $table = 'vt_invoice';

    /* public function payments(){
        return $this->hasMany(Payment::class);
    } */
}
