<?php

namespace App\Jobs\NHTSA;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetSafetyRankings
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
     * @return array
     */
    public function handle()
    {
        $client = new Client();
        $url = env('NHTSA_API_URL') . "modelyear/$this->modelYear/make/$this->make/model/$this->model?format=json";
        $response = $client->request('GET', $url);
        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents(), true);
        }
        return [
            'Count' => 0,
            'Results' => []
        ];
    }
}
