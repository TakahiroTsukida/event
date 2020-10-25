<?php

namespace App\Services\Event;

use App\Services\Event\EventServiceInterface;
use App\Repositories\Contracts\EventContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventService implements EventServiceInterface
{
    private $eventContract;

    public function __construct(
        EventContract $eventContract
    )
    {
        $this->eventContract = $eventContract;
    }

    /**
     * @inheritDoc
     */
    public function searchEvents(array $params): LengthAwarePaginator
    {
        return $this->eventContract->searchEvents($params);
    }
}