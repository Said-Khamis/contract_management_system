<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace Services;

use App\Models\Contract;
use App\Models\ContractObjective;
use App\Services\ContractObjectiveService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Throwable;

class ContractObjectiveServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ContractObjectiveService $objectiveService;

    public function setUp(): void
    {
        parent::setUp();
        $this->objectiveService = \App::make(ContractObjectiveService::class);
    }

    /**
     * Test if a contract objective can be created
     * @return void
     * @throws Throwable
     */
    public function test_create_contract_objective() : void
    {
        $contract = Contract::factory()->create();

        $objective = ContractObjective::factory()->make()->toArray();
        $objective['contract_id'] = $contract->id;
        $dbObjective = $this->objectiveService->createContractObjective($objective);

        $this->assertArrayHasKey('id', $dbObjective);
        $this->assertNotNull($dbObjective['id'], 'Created objective must have id specified');
        $this->assertModelExists($dbObjective);
    }

    /**
     * Test if a contract objective can be updated
     * @return void
     * @throws Throwable
     */
    public function test_update_contract_objective() : void
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Objective
        $objective = ContractObjective::factory()->create(['contract_id' => $contract->id]);
        $fakeObj = ContractObjective::factory()->make()->toArray();

        $updatedObj = $this->objectiveService->updateContractObjective($fakeObj, $objective->id);

        $this->assertModelExists($updatedObj);
        $dbObj = $this->objectiveService->getContractObjective($objective->id);
        $this->assertModelExists($dbObj);
    }

    /**
     * Test if a contract operation area can be deleted
     * @return void
     * @throws Throwable
     */
    public function test_delete_contract_objective()
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Objective
        $obj = ContractObjective::factory()->create(['contract_id' => $contract->id]);

        $response = $this->objectiveService->deleteContractObjective($obj->id);

        $this ->assertTrue($response);
        $this->assertNull(ContractObjective::find($obj->id), 'Contract Objective should not exist in database');

    }


    /**
     * Test reading all contract operation area from database
     * @return void
     */
    public function test_find_all()
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Objective
        $obj = ContractObjective::factory()->create(['contract_id' => $contract->id]);
        $dbObj = $this->objectiveService->findAll();

        $this->assertCount(1, $dbObj, 'The count did not match');

        $this->assertModelData($obj->toArray(), $dbObj->first()->toArray());
    }
}
