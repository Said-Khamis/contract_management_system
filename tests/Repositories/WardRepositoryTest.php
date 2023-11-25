<?php namespace Tests\Repositories;

use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use App\Models\Ward;
use App\Repositories\CountryRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\RegionRepository;
use App\Repositories\WardRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WardRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WardRepository
     */
    protected $wardRepo;
    protected $districtRepo;
    protected $regionRepo;
    protected $regionId;
    protected $countryRepo;
    protected $countryId;
    protected $districtId;

    public function setUp() : void
    {
        parent::setUp();
        $this->wardRepo = \App::make(WardRepository::class);
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

        $district = District::factory()->make()->toArray();
        $district['region_id'] = $this->regionId;
        $newDistrict = $this->districtRepo->create($district);
        $this->districtId = $newDistrict->id;
    }

    /**
     * @test create
     */
    public function test_create_ward()
    {
        $ward = Ward::factory()->make()->toArray();
        $ward['district_id'] = $this->districtId;
        $createdWard = $this->wardRepo->create($ward);

        $createdWard = $createdWard->toArray();
        $this->assertArrayHasKey('id', $createdWard);
        $this->assertNotNull($createdWard['id'], 'Created Ward must have id specified');
        $this->assertNotNull(Ward::find($createdWard['id']), 'Ward with given id must be in DB');
        $this->assertModelExists($this->wardRepo->create($ward));
    }

    /**
     * @test read
     */
    public function test_read_ward()
    {
        $ward = Ward::factory()->make()->toArray();
        $ward['district_id'] = $this->districtId;
        $createdWard = $this->wardRepo->create($ward);

        $dbWard = $this->wardRepo->find($createdWard->id);

        $dbWard = $dbWard->toArray();
        $this->assertModelExists($this->wardRepo->create($ward));
    }

    /**
     * @test update
     */
    public function test_update_ward()
    {
        $ward = Ward::factory()->create();
        $fakeWard = Ward::factory()->make()->toArray();

        $updatedWard = $this->wardRepo->update($fakeWard, $ward->id);

        $this->assertModelData($fakeWard, $updatedWard->toArray());
        $dbWard = $this->wardRepo->find($ward->id);
        $this->assertModelData($fakeWard, $dbWard->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ward()
    {
        $ward = Ward::factory()->create();

        $resp = $this->wardRepo->delete($ward->id);

        $this->assertTrue($resp);
        $this->assertNull(Ward::find($ward->id), 'Ward should not exist in DB');
    }
}
