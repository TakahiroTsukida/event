<?php

namespace App\Repositories\Contracts;

interface CapaContract
{
    /**
     * Store Capa
     * @param array $eventRecords
     * @param int $eventId
     */
    public function storeNewCapas(array $eventRecords, int $eventId): void;
}
