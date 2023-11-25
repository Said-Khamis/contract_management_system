<?php namespace Tests\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Repositories\CountryRepository;
use App\Repositories\CityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CityRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CityRepository
     */
    protected CityRepository $cityRepo;
    protected CountryRepository $countryRepo;
    protected int $countryId;

    public function setUp() : void
    {
        parent::setUp();
        $this->cityRepo = \App::make(CityRepository::class);
        $this->countryRepo = \App::make(CountryRepository::class);
        $country = Country::factory()->make()->toArray();
        $newCountry = $this->countryRepo->create($country);
        $this->countryId = $newCountry->id;
    }

    /**
     * @test create
     */
    public function test_create_city()

    {

        $city = City::factory()->make()->toArray();
        $city['country_id'] = $this->countryId;
        $createdCity = $this->cityRepo->create($city);

        $this->assertArrayHasKey('id', $createdCity);
        $this->assertNotNull($createdCity['id'], 'Created City must have id specified');
        $this->assertNotNull(City::find($createdCity['id']), 'City with given id must be in DB');
        $this->assertModelExists($createdCity);
    }

    /**
     * @test read
     */
    public function test_read_city()
    {
        $city = City::factory()->make()->toArray();
        $city['country_id'] = $this->countryId;
        $createdCity = $this->cityRepo->create($city);

        $dbCity = $this->cityRepo->find($createdCity->id);

        $this->assertModelExists($dbCity);
    }

    /**
     * @test update
     */
    public function test_update_city()
    {
        $city = City::factory()->create();
        $fakeCity = City::factory()->make()->toArray();

        $updatedCity = $this->cityRepo->update($fakeCity, $city->id);

        $this->assertModelData($fakeCity, $updatedCity->toArray());
        $dbCity = $this->cityRepo->find($city->id);
        $this->assertModelData($fakeCity, $dbCity->toArray());
    }

    /**
     * @test delete
     * @throws \Exception
     */
    public function test_delete_city()
    {
        $city = City::factory()->create();

        $resp = $this->cityRepo->delete($city->id);

        $this->assertTrue($resp);
        $this->assertNull(City::find($city->id), 'City should not exist in DB');
        $this->assertSoftDeleted($city);
    }
}
