<?php namespace Tests\Repositories;

use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use App\Repositories\CountryRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\RegionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class DistrictRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var DistrictRepository
     */
    protected DistrictRepository $districtRepo;
    protected $regionRepo;
    protected $regionId;
    protected $countryRepo;
    protected $countryId;

    public function setUp() : void
    {
        parent::setUp();
        $this->districtRepo = \App::make(DistrictRepository::class);
        $this->regionRepo = \App::make(RegionRepository::class);
        $this->countryRepo = \App::make(CountryRepository::class);

        $country = Country::factory()->make()->toArray();
        $newCountry = $this->countryRepo->create($country);
        $this->countryId = $newCountry->id;

        $region = Region::factory()->make()->toArray();
        $region['country_id'] = $this->countryId;
        $newRegion = $this->regionRepo->create($region);
        $this->regionId = $newRegion->id;
    }

    /**
     * @test create
     */
    public function test_create_district()
    {
        $district = District::factory()->make()->toArray();
        $district['region_id'] = $this->regionId;
        $createdDistrict = $this->districtRepo->create($district);

        $createdDistrict = $createdDistrict->toArray();
        $this->assertArrayHasKey('id', $createdDistrict);
        $this->assertNotNull($createdDistrict['id'], 'Created District must have id specified');
        $this->assertNotNull(District::find($createdDistrict['id']), 'District with given id must be in DB');
        $this->assertModelExists($this->districtRepo->create($district));
    }

    /**
     * @test read
     */
    public function test_read_district()
    {
        $district = District::factory()->make()->toArray();
        $district['region_id'] = $this->regionId;
        $createdDistrict = $this->districtRepo->create($district);

        $dbDistrict = $this->districtRepo->find($createdDistrict->id);

        $dbDistrict = $dbDistrict->toArray();
        $this->assertModelExists($createdDistrict);
    }

    /**
     * @test update
     */
    public function test_update_district()
    {
        $district = District::factory()->create();

        $fakeDistrict = District::factory()->make()->toArray();

        $updatedDistrict = $this->districtRepo->update($fakeDistrict, $district->id);

        $this->assertModelData($fakeDistrict, $updatedDistrict->toArray());
        $dbDistrict = $this->districtRepo->find($district->id);
        $this->assertModelExists($updatedDistrict);
        //$this->assertModelData($fakeDistrict, $dbDistrict->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_district()
    {
        $district = District::factory()->create();

        $resp = $this->districtRepo->delete($district->id);

        $this->assertTrue($resp);
        $this->assertNull(District::find($district->id), 'District should not exist in DB');
    }
}
