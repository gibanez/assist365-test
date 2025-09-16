<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_number',
        'departure_time',
        'status',
    ];

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class, 'passenger_reservation');
    }

    public function changeStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
