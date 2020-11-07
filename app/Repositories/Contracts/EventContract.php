<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface EventContract
{

    /**
     * Store Event
     * @param array $eventRecords
     * @return object
     */
    public function storeNewEvent(array $eventRecords): object;

    /**
     * Search Event
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function searchEvents(array $params): LengthAwarePaginator;

}
