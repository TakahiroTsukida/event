<?php

namespace App\Repositories\Contracts;

use App\Admin\Event;

interface PriceContract
{
    /**
     * Store Price
     * @param array $eventRecords
     * @param int $eventId
     */
    public function storeNewPrices(array $eventRecords, int $eventId): void;
}
