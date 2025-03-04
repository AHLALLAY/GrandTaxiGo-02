<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    protected $fillable = ['photo', 'name', 'email', 'password', 'isAvailable',];
    
    public function taxi(): HasOne { return $this->hasOne(Taxi::class); }
    public function travelRoute(): HasMany { return $this->hasMany(TravelRoute::class); }

    // public function reservations(): HasMany { return $this->hasMany(Reservation::class, 'driver_id'); }
}