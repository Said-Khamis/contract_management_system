<?php namespace Tests\Repositories;

use App\Models\Contract;
use App\Models\ContractTermination;
use App\Repositories\ContractTerminationRepository;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractTerminationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContractTerminationRepository
     */
    protected ContractTerminationRepository $contractTerminationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contractTerminationRepo = \App::make(ContractTerminationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contract_termination()
    {
        $contract = Contract::factory()->create();
        $contractTermination = ContractTermination::factory()->make()->toArray();
        $contractTermination['contract_id'] = $contract->id;

        $createdContractTermination = $this->contractTerminationRepo->create($contractTermination);

        $createdContractTermination = $createdContractTermination->toArray();
        $this->assertArrayHasKey('id', $createdContractTermination);
        $this->assertNotNull($createdContractTermination['id'], 'Created ContractTermination must have id specified');
        $this->assertNotNull(ContractTermination::find($createdContractTermination['id']), 'ContractTermination with given id must be in DB');
        $this->assertModelData($contractTermination, $createdContractTermination);
    }

    /**
     * @test read
     */
    public function test_read_contract_termination()
    {
        $contract = Contract::factory()->create();
        $contractTermination = ContractTermination::factory()->create(['contract_id'=>$contract->id]);

        $dbContractTermination = $this->contractTerminationRepo->find($contractTermination->id);

        $dbContractTermination = $dbContractTermination->toArray();
        $this->assertModelData($contractTermination->toArray(), $dbContractTermination);
    }

    /**
     * @test update
     */
    public function test_update_contract_termination()
    {
        $contract = Contract::factory()->create();
        $contractTermination = ContractTermination::factory()->create(['contract_id'=>$contract->id]);
        $fakeContractTermination = ContractTermination::factory()->make()->toArray();

        $updatedContractTermination = $this->contractTerminationRepo->update($fakeContractTermination, $contractTermination->id);

        $this->assertModelData($fakeContractTermination, $updatedContractTermination->toArray());
        $dbContractTermination = $this->contractTerminationRepo->find($contractTermination->id);
        $this->assertModelData($fakeContractTermination, $dbContractTermination->toArray());
    }

    /**
     * @test delete
     * @throws Exception
     */
    public function test_delete_contract_termination()
    {
        $contract = Contract::factory()->create();
        $contractTermination = ContractTermination::factory()->create(['contract_id'=>$contract->id]);

        $resp = $this->contractTerminationRepo->delete($contractTermination->id);

        $this->assertTrue($resp);
        $this->assertNull(ContractTermination::find($contractTermination->id), 'ContractTermination should not exist in DB');
    }
}
