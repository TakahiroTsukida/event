<?php

namespace App\Repositories\Contracts;


interface ScheduleContract
{
    /**
     * Store Schedule
     * @param array $eventRecords
     * @param int $eventId
     */
    public function storeNewSchedules(array $eventRecords, int $eventId): void;
}
