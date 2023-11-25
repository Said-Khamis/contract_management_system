<?php

namespace Services;

use App\Models\Region;
use App\Services\RegionService;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Throwable;

class RegionServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected RegionService $regionService;

    public function setUp() : void
    {
        parent::setUp();
        $this->regionService = \App::make(RegionService::class);
    }
    public function test_find_all()
    {
        //Required that region exist
        $region = Region::factory()->create();

        //when region are fetched
        $dbRegion = $this->regionService->findAll();

        //the created count must be same as expected
        $this->assertNotNull($dbRegion);
    }

    /**
     * @throws Throwable
     */
    public function test_create_region()
    {
        $region = Region::factory()->make()->toArray();

        $dbRegion = $this->regionService->createRegion($region);

        $this->assertArrayHasKey('id', $dbRegion);
        $this->assertNotNull($dbRegion['id'], 'Created Region must have id specified');
        $this->assertNotNull(Region::find($dbRegion['id']), 'Region with given id must be in DB');
        $this->assertModelData($region, $dbRegion->toArray());
    }

    public function test_read_country(){
        $region = Region::factory()->create();

        $dbRegion = $this->regionService->getRegion($region->id);

        $dbRegion = $dbRegion->toArray();
        $this->assertModelData($region->toArray(), $dbRegion);

    }

    /**
     * @throws Throwable
     */
    public function test_update_region(){
        $region = Region::factory()->create();
        $fakeRegion = Region::factory()->make()->toArray();

        $updatedRegion = $this->regionService->updateRegion($fakeRegion, $region->id);

        $this->assertModelData($fakeRegion, $updatedRegion->toArray());
        $dbCountry = $this->regionService->getRegion($region->id);
        $this->assertModelData($fakeRegion, $dbCountry->toArray());
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function test_delete_region(): void
    {
        $region =  Region::factory()->create();

        $response = $this->regionService->deleteRegion($region->id);

        $this->assertTrue($response);
        $this->assertNull($this->regionService->getRegion($region->id), 'Region should not exist in DB');
    }

}
