<?php

namespace Services;

use App\Models\Contract;
use App\Models\ContractResponsibility;
use App\Services\ContractResponsibilityService;
use App\Services\ContractService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractResponsibilityServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ContractResponsibilityService $contractResponsibilityService;

    public function setUp(): void
    {
        parent::setUp();
        $this->contractResponsibilityService = \App::make(ContractResponsibilityService::class);
    }

    /**
     * Test if a contract responsibility can be created
     * @return void
     */
    public function test_create_contract_responsibility() : void
    {
        $contract = Contract::factory()->create();

        $contractResponsibility = ContractResponsibility::factory()->make()->toArray();
        $contractResponsibility['contract_id'] = $contract->id;
        $dbContractResponsibility = $this->contractResponsibilityService->createContractResponsibility($contractResponsibility);

        $this->assertArrayHasKey('id', $dbContractResponsibility);
        $this->assertNotNull($dbContractResponsibility['id'], 'Created Contract Responsibility must have id specified');
        $this->assertModelExists($dbContractResponsibility);
    }

    /**
     * Test if a contract responsibility can be updated
     * @return void
     */
    public function test_update_contract_responsibility() : void
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Responsibility
        $contractResponsibility = ContractResponsibility::factory()->create(['contract_id' => $contract->id]);
        $fakeContractResponsibility = ContractResponsibility::factory()->make()->toArray();


        $updateContractResponsibility = $this->contractResponsibilityService->updateContractResponsibility($fakeContractResponsibility, $contractResponsibility->id);

        $this->assertModelExists($updateContractResponsibility);
        $dbContractResponsibility = $this->contractResponsibilityService->getContractResponsibility($contractResponsibility->id);
        $this->assertModelExists($dbContractResponsibility);
    }

    /**
     * Test if a contract responsibility can be deleted
     * @return void
     */
    public function test_delete_contract_responsibility() : void
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Responsibility
        $contractResponsibility = ContractResponsibility::factory()->create(['contract_id' => $contract->id]);

        $response = $this->contractResponsibilityService->deleteContractResponsibility($contractResponsibility->id);

        $this ->assertTrue($response);
        $this->assertNull(ContractResponsibility::find($contractResponsibility->id), 'Contract Responsibility should not exist in database');

    }

    /**
     * Test reading all contract responsibilities from database
     * @return void
     */
    public function test_find_all() : void
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Responsibility
        $contractResponsibility = ContractResponsibility::factory()->create(['contract_id' => $contract->id]);
        $dbContractResponsibility = $this->contractResponsibilityService->findAll();

        $this->assertCount(1, $dbContractResponsibility, 'The count did not match');

        $this->assertModelData($contractResponsibility->toArray(), $dbContractResponsibility->first()->toArray());
    }
}
