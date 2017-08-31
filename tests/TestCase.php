<?php

namespace Tests;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DispatchesJobs;

    /**
     * Asserts if a result has valid vehicles and do not have ratings
     *
     * @param array $response
     * @return void
     */
    public function assertValidVehicleWithoutRatings(array $response)
    {
        $this->assertArrayHasKey('Count', $response);
        $this->assertArrayHasKey('Message', $response);
        $this->assertArrayHasKey('Results', $response);
        $this->assertGreaterThan(1, $response['Count']);
        $this->assertGreaterThan(1, count($response['Results']));
        $this->assertEquals($response['Count'], count($response['Results']));
        $results = collect($response['Results']);
        $results->each(function ($one) {
            $this->assertArrayHasKey('Description', $one);
            $this->assertArrayHasKey('VehicleId', $one);
        });
    }

    /**
     * Asserts if a result has valid vehicles and do have ratings
     *
     * @param array $response
     * @return void
     */
    public function assertValidVehicleWithRatings(array $response)
    {
        $this->assertArrayHasKey('Count', $response);
        $this->assertArrayHasKey('Message', $response);
        $this->assertArrayHasKey('Results', $response);
        $this->assertGreaterThan(1, $response['Count']);
        $this->assertGreaterThan(1, count($response['Results']));
        $this->assertEquals($response['Count'], count($response['Results']));
        $results = collect($response['Results']);
        $results->each(function ($one) {
            $this->assertArrayHasKey('Description', $one);
            $this->assertArrayHasKey('VehicleId', $one);
            $this->assertArrayHasKey('CrashRating', $one);
        });
    }

    /**
     * Asserts if a result has empty results
     *
     * @param array $response
     * @return void
     */
    public function assertEmptyResult(array $response)
    {
        $this->assertArrayHasKey('Count', $response);
        $this->assertArrayHasKey('Results', $response);
        $this->assertEquals(0, $response['Count']);
        $this->assertEquals(0, count($response['Results']));
    }
}
