<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiderLocation extends Model
{
    use HasFactory;

    protected $fillable = ['rider_id', 'lat', 'long', 'captured_at'];

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
}
