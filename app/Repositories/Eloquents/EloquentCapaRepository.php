<?php

namespace App\Repositories\Eloquents;

use App\Admin\Capa;
use App\Repositories\Contracts\CapaContract;

class EloquentCapaRepository implements CapaContract
{
    /**
     * @var Capa
     */
    private $capa;

    /**
     * EloquentCapaRepository constructor.
     * @param Capa $capa
     */
    public function __construct(
        Capa $capa
    )
    {
        $this->capa = $capa;
    }

    /**
     * @inheritDoc
     */
    public function storeNewCapas(array $eventRecords, int $eventId): void
    {
        foreach ($eventRecords['capa']['name'] as $key => $value)
        {
            if ($value != null)
            {
                $this->capa->create([
                    'event_id' => $eventId,
                    'name'     => $value,
                    'people'   => $eventRecords['capa']['people'][$key],
                ]);
            }
        }
    }
}
