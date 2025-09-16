<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 13:24
 */

namespace App\Services\Reservation;


use App\Contracts\Repository\ReservationRepositoryInterface;
use App\Models\Reservation;
use App\Services\Common\NotifyService;

class ChangeStatusService
{
    /**
     * @var ReservationRepositoryInterface
     */
    private $reservationRepository;
    /**
     * @var NotifyService
     */
    private $notifyService;

    public function __construct(ReservationRepositoryInterface $reservationRepository, NotifyService $notifyService)
    {
        $this->reservationRepository = $reservationRepository;
        $this->notifyService = $notifyService;
    }

    /**
     * @param $id
     * @param ReservationStatus $status
     */
    public function execute($id, ReservationStatus $status)
    {
        $reservation = $this->reservationRepository->findById($id);
        $reservation->changeStatus($status->value())->save();

        $this->notifyService->send('reservation.updated', $this->notificationData($reservation));

    }

    private function notificationData(Reservation $reservation)
    {
        return [
            'event' => 'reservation.updated',
            'data'  => [
                'id'         => $reservation->id,
                'status'     => $reservation->status,
                'flight_number'     => $reservation->flight_number,
                'departure_time'     => $reservation->departure_time,
                'passengers' => $reservation->passengers()->get()->toArray(),
            ]
        ];
    }


}