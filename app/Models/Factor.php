<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;
    public function subfactors()
    {
        return $this->hasMany(Subfactor::class);
    }

    public function subfactores()
    {
        return $this->hasMany(Subfactor::class)->select('subfacto');
    }
}
