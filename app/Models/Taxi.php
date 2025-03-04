<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Taxi extends Model
{
    protected $fillable = ['driver_id', 'brand', 'registration'];

    public function driver(): HasOne { return $this->hasOne(Driver::class); }
    
}
