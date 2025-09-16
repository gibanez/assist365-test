<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 15:42
 */

namespace App\Services\Reservation;


use App\Exceptions\ReservationStatusNotValidException;

class ReservationStatus
{
    /**
     * @var string
     */
    private $status;

    private $vaildStatusses = ['PENDING', 'CONFIRMED', 'CANCELLED', 'CHECKED_IN'];

    public function __construct(string $status)
    {

        if(!in_array(str($status)->upper(), $this->vaildStatusses)) throw new ReservationStatusNotValidException(sprintf('El estado [%s] no es valido para una reserva', $status));

        $this->status = $status;
    }

    public function value()
    {
        return $this->status;
    }

    public static function factory(string $status)
    {
        return new self($status);
    }
}