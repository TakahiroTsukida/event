<?php

namespace App\Services\City;

use App\Models\City;
use App\Repositories\Contracts\CityContract;
use Illuminate\Support\Collection;

class CityService implements CityServiceInterface
{
    /**
     * @var CityContract
     */
    private $cityContract;

    public function __construct(CityContract $cityContract)
    {
        $this->cityContract = $cityContract;
    }

    /**
     * @inheritdoc
     */
    public function fetchCitiesInPref(int $prefectureId): Collection
    {
        return $this->cityContract->fetchCitiesInPref($prefectureId);
    }
}
