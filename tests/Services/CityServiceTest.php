<?php

namespace Services;

use App\Models\City;
use App\Services\CityService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

Class CityServiceTest extends TestCase
{
use ApiTestTrait, DatabaseTransactions;
protected CityService $cityService;

function setUp(): void
{
    parent::setUp();
    $this->cityService = \App::make(CityService::class);
}

public function test_find_all()
{
    $city = City::factory()->create();
    
    $dbCity = $this->cityService->findAll();

    $this->assertCount(1, $dbCity);

    $this->assertModelData($city->toArray(), $dbCity->first()->toArray());
}

public function test_create_city()
{
    $city = City::factory()->create()->toArray();
    $dbCity = $this->cityService->createCity($city);
    $this->assertArrayHasKey('id',$dbCity);
    $this->assertNotNull($dbCity['id'], 'Created City must have id specified');
    $this->assertModelData($city, $dbCity->first()->toArray());
}

public function test_show_city()
{
    $city = City::factory()->create();
    $retrievedCity = $this->cityService->getCity($city->id);
    $this->assertEquals($city->id, $retrievedCity->id);
    $this->assertEquals($city->name, $retrievedCity->name);
}

public function test_update_city()
{
    $city = City::factory()->create();
    $fakeCity = City::factory()->make()->toArray();
    $updateCity = $this->cityService->updateCity($fakeCity, $city->id);
    $this->assertModelData($fakeCity, $updateCity->toArray());
    $this->assertModelExists($updateCity);
    $dbCity = $this->cityService->getCity($city->id);
    $this->assertModelData($fakeCity, $dbCity->toArray());
    
}

public function test_delete_city()
{
    $city = City::factory()->create();
    $deleteCity = $this->cityService->deleteCity($city->id);
    $this->assertTrue($deleteCity);
    $this->assertSoftDeleted($city);
    $this->assertNull($this->cityService->getCity($city->id), 'City should not exist in DB');
}

}