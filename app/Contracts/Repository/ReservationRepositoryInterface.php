<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 13:07
 */

namespace App\Contracts\Repository;


use App\Models\Reservation;
use App\Services\Common\Criteria;

interface ReservationRepositoryInterface
{
    public function findById($id):Reservation;

    public function match(Criteria $criteria);
}