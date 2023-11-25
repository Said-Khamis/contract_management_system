<?php namespace Tests\Repositories;

use App\Models\ContractResponsibility;
use App\Models\ContractResponsibilityStatus;
use App\Repositories\ContractResponsibilityRepository;
use App\Repositories\ContractResponsibilityStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractResponsibilityStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContractResponsibilityStatusRepository
     */
    protected $contractResponsibilityStatusRepo;
    protected $contractResponsibilityRepo;
    //protected $contractResponsibilityId;

    public function setUp() : void
    {
        parent::setUp();
        $this->contractResponsibilityRepo = \App::make(ContractResponsibilityRepository::class);
        $this->contractResponsibilityStatusRepo = \App::make(ContractResponsibilityStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contract_responsibility_status()
    {
        $contractResponsibility = ContractResponsibility::factory()->make()->toArray();
        $createdContractResponsibility = $this->contractResponsibilityRepo->create($contractResponsibility);

        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->make()->toArray();
        $contractResponsibilityStatus['contract_responsibility_id'] = $createdContractResponsibility->id;

        $createdContractResponsibilityStatus = $this->contractResponsibilityStatusRepo->create($contractResponsibilityStatus);

        $this->assertArrayHasKey('id', $createdContractResponsibilityStatus);
        $this->assertNotNull($createdContractResponsibilityStatus['id'], 'Created ContractResponsibilityStatus must have id specified');
        $this->assertNotNull(ContractResponsibilityStatus::find($createdContractResponsibilityStatus['id']), 'ContractResponsibilityStatus with given id must be in DB');
        $this->assertModelExists($createdContractResponsibilityStatus);
    }

    /**
     * @test read
     */
    public function test_read_contract_responsibility_status()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->create();

        $dbContractResponsibilityStatus = $this->contractResponsibilityStatusRepo->find($contractResponsibilityStatus->id);

        $dbContractResponsibilityStatus = $dbContractResponsibilityStatus->toArray();
        $this->assertModelData($contractResponsibilityStatus->toArray(), $dbContractResponsibilityStatus);
    }

    /**
     * @test update
     */
    public function test_update_contract_responsibility_status()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->create();
        $fakeContractResponsibilityStatus = ContractResponsibilityStatus::factory()->make()->toArray();

        $updatedContractResponsibilityStatus = $this->contractResponsibilityStatusRepo->update($fakeContractResponsibilityStatus, $contractResponsibilityStatus->id);

        $this->assertModelExists($updatedContractResponsibilityStatus);
        $dbContractResponsibilityStatus = $this->contractResponsibilityStatusRepo->find($contractResponsibilityStatus->id);
        $this->assertModelExists($dbContractResponsibilityStatus);
    }

    /**
     * @test delete
     */
    public function test_delete_contract_responsibility_status()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->create();

        $resp = $this->contractResponsibilityStatusRepo->delete($contractResponsibilityStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(ContractResponsibilityStatus::find($contractResponsibilityStatus->id), 'ContractResponsibilityStatus should not exist in DB');
    }

    public function test_contract_responsibility_status_count_database()
    {
        ContractResponsibilityStatus::factory()->count(3)->create();

        $this->assertDatabaseCount('contract_responsibility_statuses', 3);
    }

    public function test_contract_responsibility_status_has_database()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->make()->toArray();

        $createdContractResponsibilityStatus = $this->contractResponsibilityStatusRepo->create($contractResponsibilityStatus)->toArray();

        $this->assertDatabaseHas('contract_responsibility_statuses', [
            'comment' => $createdContractResponsibilityStatus['comment']
        ]);
    }

    public function test_contract_responsibility_status_model_exist_database()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->make()->toArray();

        $createdContractResponsibilityStatus = $this->contractResponsibilityStatusRepo->create($contractResponsibilityStatus);

        $this->assertModelExists($createdContractResponsibilityStatus);
    }


    public function test_contract_responsibility_status_model_missing_database()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->make()->toArray();

        $createdContractResponsibilityStatus = $this->contractResponsibilityStatusRepo->create($contractResponsibilityStatus);

        //$createdContractResponsibilityStatus = $createdContractResponsibilityStatus->toArray();

        $this->contractResponsibilityStatusRepo->delete($createdContractResponsibilityStatus->id);

        $this->assertDatabaseMissing('contract_responsibility_statuses', ['id' => $createdContractResponsibilityStatus->id, 'deleted_at' => $createdContractResponsibilityStatus->deleted_at]);
        //$this->assertModelMissing($createdContractResponsibilityStatus);
    }
}
