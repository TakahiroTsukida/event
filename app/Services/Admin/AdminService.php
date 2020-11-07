<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ReservationSeatContract;
use App\Repositories\Contracts\EventContract;
use App\Repositories\Contracts\PriceContract;
use App\Repositories\Contracts\ScheduleContract;
use App\Repositories\Contracts\TagContract;
use App\Services\Admin\AdminServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdminService implements AdminServiceInterface
{
    /**
     * @var EventContract
     */
    private $eventContract;
    /**
     * @var PriceContract
     */
    private $priceContract;
    /**
     * @var ScheduleContract
     */
    private $scheduleContract;
    /**
     * @var ReservationSeatContract
     */
    private $reservationSeatContract;
    /**
     * @var TagContract
     */
    private $tagContract;

    public function __construct(
        EventContract $eventContract,
        PriceContract $priceContract,
        ScheduleContract $scheduleContract,
        ReservationSeatContract $reservationSeatContract,
        TagContract $tagContract
    )
    {
        $this->eventContract = $eventContract;
        $this->priceContract = $priceContract;
        $this->scheduleContract = $scheduleContract;
        $this->reservationSeatContract = $reservationSeatContract;
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
            //イベント新規登録
            $newEvent = $this->eventContract->storeNewEvent($eventRecords);
            //Prices新規登録
            $this->priceContract->storeNewPrices($eventRecords, $newEvent->id);
            //Schedules新規登録
            $this->scheduleContract->storeNewSchedules($eventRecords, $newEvent->id);
            //ReservationSeats新規登録
            $this->reservationSeatContract->storeNewReservationSeats($eventRecords, $newEvent->id);
            //Tags新規登録
            $this->tagContract->storeNewTags($eventTags, $newEvent);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function searchEvents(array $params): LengthAwarePaginator
    {
        return $this->eventContract->searchEvents($params);
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
