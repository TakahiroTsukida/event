<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\CapaContract;
use App\Repositories\Contracts\EventContract;
use App\Repositories\Contracts\PriceContract;
use App\Repositories\Contracts\ScheduleContract;
use App\Repositories\Contracts\TagContract;
use App\Services\Admin\AdminServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdminService implements AdminServiceInterface
{
    public function __construct(
        EventContract $eventContract,
        PriceContract $priceContract,
        ScheduleContract $scheduleContract,
        CapaContract $capaContract,
        TagContract $tagContract
    )
    {
        $this->eventContract = $eventContract;
        $this->priceContract = $priceContract;
        $this->scheduleContract = $scheduleContract;
        $this->capaContract = $capaContract;
        $this->tagContract = $tagContract;
    }

    /**
     * @inheritDoc
     */
    public function storeNewEvent(array $eventRecords, object $eventImage, ?Collection $eventTags): bool
    {
        // Store Event-image_path
        $eventRecords['image_path'] = $this->storeEventImage($eventImage);

        DB::beginTransaction();
        try {
            // Store Event
            $newEvent = $this->eventContract->storeNewEvent($eventRecords);
            // Store Event-Prices
            $this->priceContract->storeNewPrices($eventRecords, $newEvent->id);
            // Store Event-Schedules
            $this->scheduleContract->storeNewSchedules($eventRecords, $newEvent->id);
            // Store Event-Capas
            $this->capaContract->storeNewCapas($eventRecords, $newEvent->id);
            // Store Event-Tags
            $this->tagContract->storeNewTags($eventTags, $newEvent);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    /**
     * storage/images/event_images store
     * @param object $eventImage
     * @return string
     */
    private function storeEventImage(object $eventImage): string
    {
        $path = $eventImage->store('public/image/event_images');
        return basename($path);
    }
}
