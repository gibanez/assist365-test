<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 13:23
 */

namespace App\Services\Reservation;


use App\Contracts\Repository\ReservationRepositoryInterface;
use App\Models\Reservation;
use App\Services\Common\Criteria;

class ReservationRepositoryDB implements ReservationRepositoryInterface
{

    public function findById($id): Reservation
    {
        return Reservation::find($id);
    }

    public function match(Criteria $criteria)
    {
        $query = Reservation::query();
        $reservations = $criteria->apply($query)->get();

        return $reservations;

    }
}