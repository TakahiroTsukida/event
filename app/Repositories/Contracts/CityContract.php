<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface CityContract
{
    /**
     * 都道府県IDから該当の市区町村郡データを取得する
     * @param int $prefectureId
     * @return Collection
     */
    public function fetchCitiesInPref(int $prefectureId): Collection;
}
