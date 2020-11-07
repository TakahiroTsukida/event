<?php

namespace App\Services\Event;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EventServiceInterface
{
    /**
     * Search Event
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function searchEvents(array $params): LengthAwarePaginator;

    /**
     * 都道府県データを返す
     * @param string $prefId
     * @return array|null
     */
    public function fetchPrefData(string $prefId): ?array;

    /**
     * !! 必ず都道府県データとセットで使うこと !!
     * 市区町村郡データを返す
     * @param array $pref //すでに絞り込みで取得した都道府県データ
     * @param string $cityId
     * @return array|null
     */
    public function fetchCityData(array $pref, string $cityId): ?array;
}
