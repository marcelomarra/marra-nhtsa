<?php

namespace App\Http\Controllers;

class VehicleController extends Controller
{
    /*
     * Search for a vehicle
     */
    public function search($model_year, $manufacturer, $model)
    {
        return response()->json([
            'Count' => 0,
            'Results' => []
        ], 200);
    }
}
