<?php
use App\Models\ImplementationStatus;
use App\Repositories\ImplementationStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ImplementationStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ImplementationStatusRepository
     */
    protected $implementationStatusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->implementationStatusRepo = \App::make(ImplementationStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_implementation_status()
    {
        $implementationStatus = ImplementationStatus::factory()->make()->toArray();

        $createdImplementationStatus = $this->implementationStatusRepo->create($implementationStatus);

        $createdImplementationStatus = $createdImplementationStatus->toArray();
        $this->assertArrayHasKey('id', $createdImplementationStatus);
        $this->assertNotNull($createdImplementationStatus['id'], 'Created ImplementationStatus must have id specified');
        $this->assertNotNull(ImplementationStatus::find($createdImplementationStatus['id']), 'ImplementationStatus with given id must be in DB');
        $this->assertModelData($implementationStatus, $createdImplementationStatus);
    }

    /**
     * @test read
     */
    public function test_read_implementation_status()
    {
        $implementationStatus = ImplementationStatus::factory()->create();

        $dbImplementationStatus = $this->implementationStatusRepo->find($implementationStatus->id);

        $dbImplementationStatus = $dbImplementationStatus->toArray();
        $this->assertModelData($implementationStatus->toArray(), $dbImplementationStatus);
    }

    /**
     * @test update
     */
    public function test_update_implementation_status()
    {
        $implementationStatus = ImplementationStatus::factory()->create();
        $fakeImplementationStatus = ImplementationStatus::factory()->make()->toArray();

        $updatedImplementationStatus = $this->implementationStatusRepo->update($fakeImplementationStatus, $implementationStatus->id);

        $this->assertModelData($fakeImplementationStatus, $updatedImplementationStatus->toArray());
        $dbImplementationStatus = $this->implementationStatusRepo->find($implementationStatus->id);
        $this->assertModelData($fakeImplementationStatus, $dbImplementationStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_implementation_status()
    {
        $implementationStatus = ImplementationStatus::factory()->create();

        $resp = $this->implementationStatusRepo->delete($implementationStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(ImplementationStatus::find($implementationStatus->id), 'ImplementationStatus should not exist in DB');
    }
}
