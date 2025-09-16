<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 12:42
 */

namespace App\Services\Passenger;


use App\Contracts\Repository\PassengerRepositoryInterface;
use App\Models\Passenger;

class PassengerRepositoryDB implements PassengerRepositoryInterface
{

    public function findById($id):Passenger
    {
        /** @var Passenger $passenger */
        $passenger = Passenger::find($id);
        return $passenger;
    }
}