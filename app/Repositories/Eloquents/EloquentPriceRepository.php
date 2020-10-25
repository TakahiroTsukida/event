<?php

namespace App\Repositories\Eloquents;

use App\Admin\Price;
use App\Repositories\Contracts\PriceContract;

class EloquentPriceRepository implements PriceContract
{
    /**
     * @var Price
     */
    private $price;

    /**
     * EloquentPriceRepository constructor.
     * @param Price $price
     */
    public function __construct(
        Price $price
    )
    {
        $this->price = $price;
    }

    /**
     * @inheritDoc
     */
    public function storeNewPrices(array $eventRecords, int $eventId): void
    {
        foreach ($eventRecords['price']['gender'] as $key => $value)
        {
            if ($value != null)
            {
                $this->price->create([
                    'event_id' => $eventId,
                    'gender'   => $value,
                    'status'   => $eventRecords['price']['status'][$key],
                    'price'    => $eventRecords['price']['price'][$key],
                    'notes'    => $eventRecords['price']['notes'][$key],
                ]);
            }
        }

    }
}
