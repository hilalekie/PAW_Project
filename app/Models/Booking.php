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

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}