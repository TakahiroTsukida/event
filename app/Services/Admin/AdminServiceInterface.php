<?php

namespace App\Services\Admin;



use Illuminate\Support\Collection;

interface AdminServiceInterface
{
    /**
     * Event store
     * @param array $eventRecords
     * @param object $eventImage
     * @param Collection|null $eventTags
     * @return bool
     */
    public function storeNewEvent(array $eventRecords, object $eventImage, ?Collection $eventTags): bool;
}
