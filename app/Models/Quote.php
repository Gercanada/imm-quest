<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public $incrementing = false;
    protected $table = 'vt_Quotes';

    /*   public function payments()
    {
        return $this->hasMany(Payment::class, 'quote_id');
    } */
}
