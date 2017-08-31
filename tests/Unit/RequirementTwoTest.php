<?php

namespace Tests\Unit;

use App\Jobs\VehicleSafetyRankingSearcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Tests\TestCase;

class RequirementTwoTest extends TestCase
{
    use DispatchesJobs;


//{
//    "modelYear": 2015,
//    "manufacturer": "Audi",
//    "model": "A3"
//}
    public function test2015AudiA3()
    {
        $response = $this->postJson('http://localhost/api/vehicles', [
            'modelYear' => 2015,
            'manufacturer' => 'Audi',
            'model' => 'A3'
        ])->json();
        $this->assertValidVehicleWithoutRatings($response);
        $this->assertEquals($response['Count'], 4);
        $this->assertEquals(count($response['Results']), 4);
    }

//{
//    "modelYear": 2015,
//    "manufacturer": "Toyota",
//    "model": "Yaris"
//}
    public function test2015ToyotaYaris()
    {
        $response = $this->postJson('http://localhost/api/vehicles', [
            'modelYear' => 2015,
            'manufacturer' => 'Toyota',
            'model' => 'Yaris'
        ])->json();
        $this->assertValidVehicleWithoutRatings($response);
        $this->assertEquals($response['Count'], 2);
        $this->assertEquals(count($response['Results']), 2);
    }

//{
//    "manufacturer": "Honda",
//    "model": "Accord"
//}
    public function testUndefinedHondaAccord()
    {
        $response = $this->postJson('http://localhost/api/vehicles', [
            'manufacturer' => 'Honda',
            'model' => 'Accord'
        ])->json();
        $this->assertEmptyResult($response);
    }

}
