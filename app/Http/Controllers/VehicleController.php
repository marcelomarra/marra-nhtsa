<?php

namespace App\Http\Controllers;

use App\Jobs\NHTSA\GetSafetyRankings;

class VehicleController extends Controller
{
    /*
     * Search for a vehicle
     *
     * @param $model_year
     * @param $manufacturer
     * @param $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($model_year, $manufacturer, $model)
    {
        return $this->performSearch($model_year, $manufacturer, $model);
    }

    /**
     * @param $model_year
     * @param $manufacturer
     * @param $model
     * @return \Illuminate\Http\JsonResponse
     */
    protected function performSearch($model_year, $manufacturer, $model)
    {
        $response = $this->dispatch(new GetSafetyRankings($model_year, $manufacturer, $model));
        $collection = collect($response['Results']);
        $transformed = $collection->reduce(function ($lookup, $vehicle) {
            $transformedVehicle = [];
            $transformedVehicle['Description'] = $vehicle['VehicleDescription'];
            $transformedVehicle['VehicleId'] = $vehicle['VehicleId'];
            $lookup[] = $transformedVehicle;
            return $lookup;
        }, []);
        $response['Results'] = $transformed;
        return response()->json($response, 200);
    }
}
