<?php
use App\Models\GeneralStatus;
use App\Repositories\GeneralStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GeneralStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GeneralStatusRepository
     */
    protected $generalStatusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->generalStatusRepo = \App::make(GeneralStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_general_status()
    {
        $generalStatus = GeneralStatus::factory()->make()->toArray();

        $createdGeneralStatus = $this->generalStatusRepo->create($generalStatus);

        $createdGeneralStatus = $createdGeneralStatus->toArray();
        $this->assertArrayHasKey('id', $createdGeneralStatus);
        $this->assertNotNull($createdGeneralStatus['id'], 'Created GeneralStatus must have id specified');
        $this->assertNotNull(GeneralStatus::find($createdGeneralStatus['id']), 'GeneralStatus with given id must be in DB');
        $this->assertModelData($generalStatus, $createdGeneralStatus);
    }

    /**
     * @test read
     */
    public function test_read_general_status()
    {
        $generalStatus = GeneralStatus::factory()->create();

        $dbGeneralStatus = $this->generalStatusRepo->find($generalStatus->id);

        $dbGeneralStatus = $dbGeneralStatus->toArray();
        $this->assertModelData($generalStatus->toArray(), $dbGeneralStatus);
    }

    /**
     * @test update
     */
    public function test_update_general_status()
    {
        $generalStatus = GeneralStatus::factory()->create();
        $fakeGeneralStatus = GeneralStatus::factory()->make()->toArray();

        $updatedGeneralStatus = $this->generalStatusRepo->update($fakeGeneralStatus, $generalStatus->id);

        $this->assertModelData($fakeGeneralStatus, $updatedGeneralStatus->toArray());
        $dbGeneralStatus = $this->generalStatusRepo->find($generalStatus->id);
        $this->assertModelData($fakeGeneralStatus, $dbGeneralStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_general_status()
    {
        $generalStatus = GeneralStatus::factory()->create();

        $resp = $this->generalStatusRepo->delete($generalStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(GeneralStatus::find($generalStatus->id), 'GeneralStatus should not exist in DB');
    }
}
