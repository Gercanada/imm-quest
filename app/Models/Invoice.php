<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $incrementing = false;
    protected $table = 'vt_Invoice';
    public function currency()
    {
        return $this->hasOne(Currency::class,'id', 'currency_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id', 'productid');
    }
    /* public function payments(){
        return $this->hasMany(Payment::class);
    } */
}
