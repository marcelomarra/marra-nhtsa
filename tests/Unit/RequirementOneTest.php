<?php

namespace Tests\Unit;

use App\Jobs\VehicleSafetyRankingSearcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Tests\TestCase;

class RequirementOneTest extends TestCase
{
    use DispatchesJobs;

    public function test2015AudeA3()
    {
        $response = $this->dispatch(new VehicleSafetyRankingSearcher(2015, 'Audi', 'A3'));
        $this->assertValidVehicleWithoutRatings($response);
        $this->assertEquals($response['Count'], 4);
        $this->assertEquals(count($response['Results']), 4);
    }

    public function test2015ToyotaYaris()
    {
        $response = $this->dispatch(new VehicleSafetyRankingSearcher(2015, 'Toyota', 'Yaris'));
        $this->assertValidVehicleWithoutRatings($response);
        $this->assertEquals($response['Count'], 2);
        $this->assertEquals(count($response['Results']), 2);
    }


    public function test2015FordCrownVictoria()
    {
        $response = $this->dispatch(new VehicleSafetyRankingSearcher(2015, 'Ford', 'Crown Victoria'));
        $this->assertEmptyResult($response);
    }

    public function testUndefinedFordCrownFusion()
    {
        $response = $this->dispatch(new VehicleSafetyRankingSearcher(null, 'Ford', 'Fusion'));
        $this->assertEmptyResult($response);
    }


//* `GET http://localhost:8080/vehicles/2015/Audi/A3`
//* `GET http://localhost:8080/vehicles/2015/Toyota/Yaris`
//* `GET http://localhost:8080/vehicles/2015/Ford/Crown Victoria`
//* `GET http://localhost:8080/vehicles/undefined/Ford/Fusion`
}
