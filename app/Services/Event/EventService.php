<?php

namespace App\Services\Event;

use App\Modules\PrefCity;
use App\Services\Event\EventServiceInterface;
use App\Repositories\Contracts\EventContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventService implements EventServiceInterface
{
    /**
     * @var PrefCity
     */
    private $prefCity;

    /**
     * @var EventContract
     */
    private $eventContract;

    /**
     * EventService constructor.
     * @param PrefCity $prefCity
     * @param EventContract $eventContract
     */
    public function __construct(
        PrefCity $prefCity,
        EventContract $eventContract
    )
    {
        $this->prefCity = $prefCity;
        $this->eventContract = $eventContract;
    }

    /**
     * @inheritDoc
     */
    public function searchEvents(array $params): LengthAwarePaginator
    {
        return $this->eventContract->searchEvents($params);
    }

    /**
     * @inheritdoc
     */
    public function fetchPrefData(string $prefId): ?array
    {
        return $this->prefCity->fetchPrefData($prefId);
    }

    /**
     * @inheritdoc
     */
    public function fetchCityData(array $pref, string $cityId): ?array
    {
        return $this->prefCity->fetchCityData($pref, $cityId);
    }
}
