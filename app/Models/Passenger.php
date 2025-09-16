<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'document_type',
        'document_number',
        'birth_date',
        'gender',
        'email',
        'phone',
        'nationality',
        'address',
    ];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'passenger_reservation');
    }
}
