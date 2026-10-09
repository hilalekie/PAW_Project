<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function konsol()
    {
        return $this->belongsTo(Konsol::class);
    }
}