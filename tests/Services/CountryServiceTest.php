<?php

namespace Services;

use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Throwable;

class CountryServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected CountryService $countryService;

    public function setUp() : void
    {
        parent::setUp();
        $this->countryService = \App::make(CountryService::class);
    }
    public function test_find_all()
    {
        //Required that country exist
        $country = Country::factory()->create();

        //when country are fetched
        $dbCountry = $this->countryService->findAll();

        //the created count must be same as expected
        $this->assertCount(10, $dbCountry,);

        //test if array fetched has a key
        $this->assertArrayHasKey('id', $country);
        $this->assertNotNull($country['id'], 'Created Country must have id specified');
    }

    /**
     * @throws Throwable
     */
    public function test_create_country()
    {
        $country = Country::factory()->make()->toArray();

        $dbCountry = $this->countryService->createCountry($country);

        $this->assertArrayHasKey('id', $dbCountry);
        $this->assertNotNull($dbCountry['id'], 'Created Country must have id specified');
        $this->assertNotNull(Country::find($dbCountry['id']), 'Country with given id must be in DB');
        $this->assertModelData($country, $dbCountry->toArray());
    }

    public function test_read_country(){
        $country = Country::factory()->create();

        $dbCountry = $this->countryService->getCountry($country->id);

        $dbCountry = $dbCountry->toArray();
        $this->assertModelData($country->toArray(), $dbCountry);

    }


    /**
     * @throws Throwable
     */
    public function test_update_country(){
        $country = Country::factory()->create();
        $fakeCountry = Country::factory()->make()->toArray();

        $updatedCountry = $this->countryService->updateCountry($fakeCountry, $country->id);

        $this->assertModelData($fakeCountry, $updatedCountry->toArray());
        $dbCountry = $this->countryService->getCountry($country->id);
        $this->assertModelData($fakeCountry, $dbCountry->toArray());
    }

    /**
     * @throws Throwable
     */
    public function test_delete_country(): void
    {
        $country =  Country::factory()->create();

        $response = $this->countryService->deleteCountry($country->id);

        //$this->assertDatabaseMissing('countries', ['id' => $country->id]);
        //$this->assertTrue(Country::where('id', $country->id)->delete() > 0);
        $this->assertTrue($response);
        $this->assertNull(Country::find($country->id), 'Country should not exist in DB');
    }

}
