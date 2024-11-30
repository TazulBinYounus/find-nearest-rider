<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'service_name',
        'timestamp',
    ];

    public $timestamps = true;

    public function locations()
    {
        return $this->hasMany(RiderLocation::class);
    }
}
