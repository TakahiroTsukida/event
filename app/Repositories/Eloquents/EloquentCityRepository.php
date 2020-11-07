<?php

namespace App\Repositories\Eloquents;

use App\Models\City;
use App\Repositories\Contracts\CityContract;
use Illuminate\Support\Collection;

class EloquentCityRepository implements CityContract
{
    /**
     * @var City
     */
    private $city;

    /**
     * EloquentCityRepository constructor.
     * @param City $city
     */
    public function __construct(City $city)
    {
        $this->city = $city;
    }

    /**
     * @inheritdoc
     */
    public function fetchCitiesInPref(int $prefectureId): Collection
    {
        return $this->city->where('prefecture_id', $prefectureId)->get();
    }
}
