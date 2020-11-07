<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\City\CityServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    /**
     * @var CityServiceInterface
     */
    private $cityServiceInterface;

    public function __construct(CityServiceInterface $cityServiceInterface)
    {
        $this->cityServiceInterface = $cityServiceInterface;
    }

    public function cities(Request $request)
    {
        Log::debug($request);

        $prefectureId = (int)$request->input('prefectureId');

        //市区町村郡名を取得
        $cities = $prefectureId
            ? $this->cityServiceInterface->fetchCitiesInPref($prefectureId)
            : false;

        if ($cities) {
            return response()->json([
                'cities' => $cities,
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'cities' => null,
                'status' => 500,
            ]);
        }
    }
}
