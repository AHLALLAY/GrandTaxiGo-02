<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TravelRoute extends Model
{
    protected $fillable=['depart', 'destination', 'driver_id'];

    public function driver(): BelongsTo { return $this->belongsTo(Driver::class); }

    // public function reservations(): HasMany { return $this->hasMany(Reservation::class); }
}