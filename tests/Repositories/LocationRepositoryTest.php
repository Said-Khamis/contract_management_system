<?php namespace Tests\Repositories;

use App\Models\Country;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Ward;
use App\Repositories\CountryRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\LocationRepository;
use App\Repositories\WardRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LocationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected LocationRepository $locationRepo;
    protected EmployeeRepository $employeeRepository;
    protected CountryRepository $countryRepository;

    protected WardRepository $wardRepository;
    protected  int $employeeId;
    protected  int $countryId;
    protected  int $wardId;

    public function setUp() : void
    {
        parent::setUp();
        $this->locationRepo = \App::make(LocationRepository::class);
        $this->employeeRepository = \App::make(EmployeeRepository::class);
        $this->countryRepository = \App::make(CountryRepository::class);
        $this->wardRepository = \App::make(WardRepository::class);

        $this->employeeId = Employee::factory()->create()->id;
        $this->countryId = Country::factory()->create()->id;
        $this->wardId = Ward::factory()->create()->id;
    }

    /**
     * @test create
     */
    public function test_create_location()
    {
        $location = Location::factory()->make()->toArray();
        $location['locationable_type'] = "App\Models\Employee";
        $location['locationable_id'] = $this->employeeId;
        $location['country_id'] = $this->countryId;
        $location['ward_id'] = $this->wardId;

        $createdLocation = $this->locationRepo->create($location);

        $this->assertArrayHasKey('id', $createdLocation);
        $this->assertNotNull($createdLocation['id'], 'Created Location must have id specified');
        $this->assertNotNull(Location::find($createdLocation['id']), 'Location with given id must be in DB');
        $this->assertModelExists($createdLocation);
    }

    /**
     * @test read
     */
    public function test_read_location()
    {
        $location = Location::factory()->make()->toArray();
        $location['locationable_type'] = "App\Models\Employee";
        $location['locationable_id'] = $this->employeeId;
        $location['country_id'] = $this->countryId;
        $location['ward_id'] = $this->wardId;

        $createdLocation = $this->locationRepo->create($location);

        $dbLocation = $this->locationRepo->find($createdLocation->id);

        $dbLocation = $dbLocation->toArray();
        $this->assertModelData($createdLocation->toArray(), $dbLocation);
    }

    /**
     * @test update
     */
    public function test_update_location()
    {
        $location = Location::factory()->make()->toArray();
        $location['locationable_type'] = "App\Models\Employee";
        $location['locationable_id'] = $this->employeeId;
        $location['country_id'] = $this->countryId;
        $location['ward_id'] = $this->wardId;

        $createdLocation = $this->locationRepo->create($location);

        $fakeLocation = Location::factory()->make()->toArray();
        $fakeLocation['locationable_type'] = "App\Models\Employee";
        $fakeLocation['locationable_id'] = $this->employeeId;
        $fakeLocation['country_id'] = $this->countryId;
        $fakeLocation['ward_id'] = $this->wardId;

        $updatedLocation = $this->locationRepo->update($fakeLocation, $createdLocation->id);

        $this->assertModelData($fakeLocation, $updatedLocation->toArray());
        $dbLocation = $this->locationRepo->find($createdLocation->id);
        $this->assertModelData($fakeLocation, $dbLocation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_location()
    {
        $location = Location::factory()->make()->toArray();
        $location['locationable_type'] = "App\Models\Employee";
        $location['locationable_id'] = $this->employeeId;
        $location['country_id'] = $this->countryId;
        $location['ward_id'] = $this->wardId;

        $createdLocation = $this->locationRepo->create($location);

        $resp = $this->locationRepo->delete($createdLocation->id);

        $this->assertTrue($resp);
        $this->assertNull(Location::find($createdLocation->id), 'Location should not exist in DB');
    }
}
