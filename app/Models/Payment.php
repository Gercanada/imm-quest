<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $incrementing = false;
    protected $table = 'vt_payments';

    /* public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    } */
}
