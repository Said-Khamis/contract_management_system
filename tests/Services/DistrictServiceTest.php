<?php

namespace Tests\Services;

use App\Models\District;
use App\Services\CountryService;
use App\Services\DistrictService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Throwable;

class DistrictServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected DistrictService $districtService;

    public function setUp() : void
    {
        parent::setUp();
        $this->districtService = \App::make(DistrictService::class);
        $this->countryService = \App::make(CountryService::class);
    }
    public function test_find_all()
    {
        //Required that district exist
        $district = District::factory()->create();

        //when district are fetched
        $dbDistrict = $this->districtService->findAll();
        $this->assertNotNull($dbDistrict);
    }

    /**
     * @throws Throwable
     */
    public function test_create_district()
    {
        $district = District::factory()->make()->toArray();

        $createdDistrict = $this->districtService->createDistrict($district);

        $createdDistrict = $createdDistrict->toArray();
        $this->assertArrayHasKey('id', $createdDistrict);
        $this->assertNotNull($createdDistrict['id'], 'Created District must have id specified');
        $this->assertNotNull(District::find($createdDistrict['id']), 'District with given id must be in DB');
    }

    public function test_read_district(){
        $district = District::factory()->create();

        $dbDistrict = $this->districtService->getDistrict($district->id);

        $dbDistrict = $dbDistrict->toArray();
        $this->assertModelData($district->toArray(), $dbDistrict);
    }

    /**
     * @throws Throwable
     */
    public function test_update_district(){
        $district = District::factory()->create();
        $fakeDistrict = District::factory()->make()->toArray();

        $updatedDistrict = $this->districtService->updateDistrict($fakeDistrict, $district->id);

        $this->assertModelData($fakeDistrict, $updatedDistrict->toArray());
        $dbDistrict = $this->districtService->getDistrict($district->id);
        $this->assertModelData($fakeDistrict, $dbDistrict->toArray());
    }

    /**
     * @throws Throwable
     */
    public function test_delete_district(): void
    {
        $district =  District::factory()->create();

        $response = $this->districtService->deleteDistrict($district->id);

        $this->assertTrue($response);
        $this->assertNull(District::find($district->id), 'District should not exist in DB');
    }

}
