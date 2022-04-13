<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;
    // protected $table = "factors";
    /*  protected $fillable = [
        'id',
        'title',
        'sub_title'
    ]; */

    public function subfactors()
    {
        return $this->hasMany(Subfactor::class);
    }
}