<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 12:59
 */

namespace App\Services\Reservation;


use App\Contracts\Repository\PassengerRepositoryInterface;
use App\Models\Reservation;

class MakeReservationService
{
    /**
     * @var PassengerRepositoryInterface
     */
    private $passengerRepository;

    public function __construct(PassengerRepositoryInterface $passengerRepository)
    {

        $this->passengerRepository = $passengerRepository;
    }

    /**
     * @param $data
     * @return Reservation
     */
    public function execute($data):Reservation
    {

        $passengers = $data['passengers']?:[];
        $reservation = Reservation::create([
            'flight_number'  => $data['flight_number'],
            'departure_time' => $data['departure_time'],
            'status'         => 'PENDING'
        ]);

        $reservation->passengers()->attach($passengers);

        return $reservation;
    }
}