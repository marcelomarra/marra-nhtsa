<?php

namespace App\Http\Controllers;

use App\Jobs\VehicleSafetyRankingSearcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

class VehicleController extends Controller
{
    use DispatchesJobs;

    /*
     * Search for a vehicle
     *
     * @param integer $modelYear
     * @param string $manufacturer
     * @param string $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSearch($modelYear, $manufacturer, $model)
    {
        return $this->performSearch($modelYear, $manufacturer, $model);
    }

    /*
     * Search for a vehicle
     *
     * @param integer $modelYear
     * @param string $manufacturer
     * @param string $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSearch()
    {
        return $this->performSearch(request()->json('modelYear', ''), request()->json('manufacturer', ''), request()->json('model', ''));
    }

    /**
     * @param integer $modelYear
     * @param string $manufacturer
     * @param string $model
     * @return \Illuminate\Http\JsonResponse
     */
    protected function performSearch($modelYear, $manufacturer, $model)
    {
        $response = $this->dispatch(new VehicleSafetyRankingSearcher($modelYear, $manufacturer, $model));
        return response()->json($response, 200);
    }
}
