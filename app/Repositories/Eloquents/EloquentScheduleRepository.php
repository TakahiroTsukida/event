<?php

namespace App\Repositories\Eloquents;


use App\Admin\Schedule;
use App\Repositories\Contracts\ScheduleContract;

class EloquentScheduleRepository implements ScheduleContract
{
    /**
     * @var Schedule
     */
    private $schedule;

    /**
     * EloquentScheduleRepository constructor.
     * @param Schedule $schedule
     */
    public function __construct(
        Schedule $schedule
    )
    {
        $this->schedule = $schedule;
    }

    /**
     * @inheritDoc
     */
    public function storeNewSchedules(array $eventRecords, int $eventId): void
    {
        foreach ($eventRecords['schedule']['name'] as $key => $value)
        {
            if ($value != null)
            {
                $this->schedule->create([
                    'event_id'    => $eventId,
                    'name'        => $value,
                    'begin'       => $eventRecords['schedule']['begin'][$key],
                    'end'         => $eventRecords['schedule']['end'][$key],
                    'descripsion' => $eventRecords['schedule']['descripsion'][$key],
                ]);
            }
        }
    }
}
