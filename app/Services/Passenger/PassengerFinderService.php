<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 12:39
 */

namespace App\Services\Passenger;


use App\Contracts\Repository\PassengerRepositoryInterface;
use App\Models\Passenger;

class PassengerFinderService
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
     * @param $id integer
     * @return Passenger
     */
    public function getById($id):Passenger
    {
        return $this->passengerRepository->findById($id);
    }


}