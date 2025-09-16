<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 12:41
 */

namespace App\Contracts\Repository;


use App\Models\Passenger;

interface PassengerRepositoryInterface
{
    public function findById($id):Passenger;
}