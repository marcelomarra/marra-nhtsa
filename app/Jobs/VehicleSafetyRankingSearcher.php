<?php

namespace App\Jobs;

use App\Jobs\NHTSA\GetSafetyRankings;
use App\Jobs\NHTSA\GetVehicleOverallRating;
use Illuminate\Foundation\Bus\DispatchesJobs;

class VehicleSafetyRankingSearcher
{
    use DispatchesJobs;
    /**
     * @var
     */
    private $modelYear;
    /**
     * @var
     */
    private $make;
    /**
     * @var
     */
    private $model;

    /**
     * Create a new job instance.
     *
     * @param $modelYear
     * @param $make
     * @param $model
     */
    public function __construct($modelYear, $make, $model)
    {
        $this->modelYear = $modelYear;
        $this->make = $make;
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return string
     */
    public function handle()
    {
        $response = $this->dispatch(new GetSafetyRankings($this->modelYear, $this->make, $this->model));
        if (isset($response['Results'])) {
            $collection = collect($response['Results']);
            $show_ratings = request()->get('withRating');
            $transformed = $collection->reduce(function ($lookup, $vehicle) use ($show_ratings) {
                $transformedVehicle = [];
                $transformedVehicle['Description'] = $vehicle['VehicleDescription'];
                $transformedVehicle['VehicleId'] = $vehicle['VehicleId'];
                if ($show_ratings === 'true') {
                    $transformedVehicle['CrashRating'] = (string)$this->dispatch(new GetVehicleOverallRating($vehicle['VehicleId']));
                }
                $lookup[] = $transformedVehicle;
                return $lookup;
            }, []);
            $response['Results'] = $transformed;
        } else {
            unset($response['Message']);
            $response['Results'] = [];
            $response['Count'] = "0";
        }
        return $response;
    }
}
