<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 23:54
 */

namespace App\Services\Reservation;


use App\Contracts\Repository\ReservationRepositoryInterface;
use App\Services\Common\Criteria;
use Illuminate\Http\Request;

class ReservationFinderService
{
    /**
     * @var ReservationRepositoryInterface
     */
    private $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function matchByRequest(Request $request)
    {
        $criteria = new Criteria($request);
        return $this->reservationRepository->match($criteria);
    }
    
}