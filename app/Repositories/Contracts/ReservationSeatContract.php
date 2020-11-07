<?php

namespace App\Repositories\Contracts;

interface ReservationSeatContract
{
    /**
     * 予約枠を新規作成する
     * @param array $eventRecords
     * @param int $eventId
     */
    public function storeNewReservationSeats(array $eventRecords, int $eventId): void;
}
