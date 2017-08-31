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
    public function getSearch($model_year, $manufacturer, $model)
    {
        return $this->performSearch($model_year, $manufacturer, $model);
    }

    /*
     * Search for a vehicle
     *
     * @param $model_year
     * @param $manufacturer
     * @param $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSearch()
    {
        return $this->performSearch(request()->json('modelYear', ''), request()->json('manufacturer', ''), request()->json('model', ''));
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
        if (isset($response['Results'])) {
            $collection = collect($response['Results']);
            $transformed = $collection->reduce(function ($lookup, $vehicle) {
                $transformedVehicle = [];
                $transformedVehicle['Description'] = $vehicle['VehicleDescription'];
                $transformedVehicle['VehicleId'] = $vehicle['VehicleId'];
                $lookup[] = $transformedVehicle;
                return $lookup;
            }, []);
            $response['Results'] = $transformed;
        } else {
            unset($response['Message']);
            $response['Results'] = [];
        }
        return response()->json($response, 200);
    }
}
