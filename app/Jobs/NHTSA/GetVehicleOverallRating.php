<?php

namespace App\Jobs\NHTSA;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetVehicleOverallRating
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $vehicleId;

    /**
     * Create a new job instance.
     *
     * @param $vehicleId
     */
    public function __construct($vehicleId)
    {
        $this->vehicleId = $vehicleId;
    }

    /**
     * Execute the job.
     *
     * @return string
     */
    public function handle()
    {
        $client = new Client();
        $url = env('NHTSA_API_URL') . "VehicleId/$this->vehicleId?format=json";
        $response = $client->request('GET', $url);
        if ($response->getStatusCode() === 200) {
            $rating = json_decode($response->getBody(), true);
            if (isset($rating['Results']) && count($rating['Results'])) {
                return $rating['Results'][0]['OverallRating'];
            }
            return 'Not Rated';
        } else {
            return 'Not Rated';
        }
    }
}
