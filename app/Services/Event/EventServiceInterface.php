<?php

namespace App\Services\Event;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EventServiceInterface
{
    /**
     * Search Event
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function searchEvents(array $params): LengthAwarePaginator;
}
