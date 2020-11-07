<?php

namespace App\Modules;

class PrefCity
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var mixed
     */
    private $prefCityAll;

    /**
     * PrefCity constructor.
     */
    public function __construct()
    {
        $this->path = public_path('json/pref_city.json');
        $this->prefCityAll = json_decode(file_get_contents($this->path), true);
    }

    /**
     * 都道府県・市区町村郡の全データを返す
     * @return array
     */
    public function getPrefCityAll(): array
    {
        return $this->prefCityAll;
    }

    /**
     * 都道府県IDから該当の都道府県データを返す
     * @param string $prefId
     * @return array|null
     */
    public function fetchPrefData(string $prefId): ?array
    {
        $pref = null;
        foreach ($this->prefCityAll as $key => $value) {
            foreach ($value as $index => $item) {
                if ($item['id'] === $prefId) {
                    $pref = $value;
                    break 2;
                }
            }
        }
        return isset($pref) ? array_shift($pref) : null;
    }

    /**
     * !! 必ず都道府県データとセットで使うこと !!
     * 市区町村郡データを返す
     * @param array $pref //すでに絞り込みで取得した都道府県データ
     * @param string $cityId
     * @return array|null
     */
    public function fetchCityData(array $pref, string $cityId): ?array
    {
        // 該当の市区町村郡データを取得
        $city = null;
        foreach ($pref['city'] as $key => $value) {
            if ($value['id'] === $cityId) {
                $city = $value;
                break;
            }
        }
        return $city;
    }
}
