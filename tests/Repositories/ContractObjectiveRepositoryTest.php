<?php namespace Tests\Repositories;

use App\Models\ContractObjective;
use App\Models\ContractResponsibility;
use App\Repositories\ContractObjectiveRepository;
use App\Repositories\ContractPartyRepository;
use App\Repositories\ContractRepository;
use App\Repositories\ContractResponsibilityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractObjectiveRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContractObjectiveRepository
     */
    protected $contractObjectiveRepo;
    protected $contractRepo;

    public function setUp() : void
    {
        parent::setUp();
//        $this->contractRepo = \App::make(ContractRepository::class);
//        $this->contractObjectiveRepo = \App::make(ContractObjectiveRepository::class);

        $this->contractRepo = \App::make(ContractRepository::class);
        $this->contractObjectiveRepo = \App::make(ContractObjectiveRepository::class);

    }

    /**
     * @test create
     */
    public function test_create_contract_objective()
    {


        $contractObjective = ContractObjective::factory()->make()->toArray();

        $createdContractObjective = $this->contractObjectiveRepo->create($contractObjective);

        $this->assertArrayHasKey('id', $createdContractObjective);
        $this->assertNotNull($createdContractObjective['id'], 'Created ContractObjective must have id specified');
        $this->assertNotNull(ContractObjective::find($createdContractObjective['id']), 'ContractObjective with given id must be in DB');
        $this->assertModelExists($createdContractObjective);

    }

    /**
     * @test read
     */
    public function test_read_contract_objective()
    {
        $contractObjective = ContractObjective::factory()->create();

        $dbContractObjective = $this->contractObjectiveRepo->find($contractObjective->id);

        $dbContractObjective = $dbContractObjective->toArray();
        $this->assertModelData($contractObjective->toArray(), $dbContractObjective);
    }

    /**
     * @test update
     */
    public function test_update_contract_objective()
    {
        $contractObjective = ContractObjective::factory()->create();
        $fakeContractObjective = ContractObjective::factory()->make()->toArray();

        $updatedContractObjective = $this->contractObjectiveRepo->update($fakeContractObjective, $contractObjective->id);

        $this->assertModelData($fakeContractObjective, $updatedContractObjective->toArray());
        $dbContractObjective = $this->contractObjectiveRepo->find($contractObjective->id);
        $this->assertModelData($fakeContractObjective, $dbContractObjective->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_contract_objective()
    {
        $contractObjective = ContractObjective::factory()->create();

        $resp = $this->contractObjectiveRepo->delete($contractObjective->id);

        $this->assertTrue($resp);
        $this->assertNull(ContractObjective::find($contractObjective->id), 'ContractObjective should not exist in DB');
    }
}
