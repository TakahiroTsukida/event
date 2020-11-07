<?php

namespace App\Services\Admin;



use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AdminServiceInterface
{
    /**
     * Store new Event
     *
     * @param array $eventRecords
     * @param object $eventImage
     * @param Collection|null $eventTags
     * @return bool
     */
    public function storeNewEvent(array $eventRecords, object $eventImage, ?Collection $eventTags): bool;

    /**
     * イベントを検索する
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function searchEvents(array $params): LengthAwarePaginator;
}
