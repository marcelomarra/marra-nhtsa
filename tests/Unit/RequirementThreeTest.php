<?php

namespace Tests\Unit;

use App\Jobs\VehicleSafetyRankingSearcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Tests\TestCase;

class RequirementThreeTest extends TestCase
{
    use DispatchesJobs;




//{
//    "modelYear": 2015,
//    "manufacturer": "Audi",
//    "model": "A3"
    //* `GET http://localhost:8080/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>?withRating=true`
    public function test2015AudiA3WithRatings()
    {
        $response = $this->get('http://localhost/api/vehicles/2015/Audi/A3?withRating=true')->json();
        $this->assertValidVehicleWithRatings($response);
        $this->assertEquals($response['Count'], 4);
        $this->assertEquals(count($response['Results']), 4);
    }

    //* `GET http://localhost:8080/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>?withRating=false` (should return the same output as Requirement 1)
    public function test2015AudiA3WithRatingsFalse()
    {
        $response = $this->get('http://localhost/api/vehicles/2015/Audi/A3?withRating=false')->json();
        $this->assertValidVehicleWithoutRatings($response);
        $this->assertEquals($response['Count'], 4);
        $this->assertEquals(count($response['Results']), 4);
    }

    //* `GET http://localhost:8080/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>?withRating=bananas` (should return the same output as Requirement 1)
    public function test2015AudiA3WithRatingsBanana()
    {
        $response = $this->get('http://localhost/api/vehicles/2015/Audi/A3?withRating=banana')->json();
        $this->assertValidVehicleWithoutRatings($response);
        $this->assertEquals($response['Count'], 4);
        $this->assertEquals(count($response['Results']), 4);
    }

    //* `GET http://localhost:8080/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>` (should return the same output as Requirement 1)
    public function test2015AudiA3WithoutRatings()
    {
        $response = $this->get('http://localhost/api/vehicles/2015/Audi/A3')->json();
        $this->assertValidVehicleWithoutRatings($response);
        $this->assertEquals($response['Count'], 4);
        $this->assertEquals(count($response['Results']), 4);
    }

}
