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
     * @param integer $model_year
     * @param string $manufacturer
     * @param string $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSearch($model_year, $manufacturer, $model)
    {
        return $this->performSearch($model_year, $manufacturer, $model);
    }

    /*
     * Search for a vehicle
     *
     * @param integer $model_year
     * @param string $manufacturer
     * @param string $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSearch()
    {
        return $this->performSearch(request()->json('modelYear', ''), request()->json('manufacturer', ''), request()->json('model', ''));
    }

    /**
     * @param integer $model_year
     * @param string $manufacturer
     * @param string $model
     * @return \Illuminate\Http\JsonResponse
     */
    protected function performSearch($model_year, $manufacturer, $model)
    {
        $response = $this->dispatch(new VehicleSafetyRankingSearcher($model_year, $manufacturer, $model));
        return response()->json($response, 200);
    }
}
