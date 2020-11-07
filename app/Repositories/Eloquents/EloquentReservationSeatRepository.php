<?php

namespace App\Repositories\Eloquents;

use App\Admin\ReservationSeat;
use App\Repositories\Contracts\ReservationSeatContract;

class EloquentReservationSeatRepository implements ReservationSeatContract
{
    /**
     * @var ReservationSeat
     */
    private $reservationSeat;

    /**
     * EloquentReservationSeatRepository constructor.
     * @param ReservationSeat $reservationSeat
     */
    public function __construct(
        ReservationSeat $reservationSeat
    )
    {
        $this->reservationSeat = $reservationSeat;
    }

    /**
     * @inheritDoc
     */
    public function storeNewReservationSeats(array $eventRecords, int $eventId): void
    {
        foreach ($eventRecords['reservation_seat']['name'] as $key => $value)
        {
            if ($value != null)
            {
                $this->reservationSeat->create([
                    'event_id' => $eventId,
                    'name'     => $value,
                    'people'   => $eventRecords['reservation_seat']['people'][$key],
                ]);
            }
        }
    }
}
