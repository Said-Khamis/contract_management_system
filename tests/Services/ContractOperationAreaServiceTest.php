<?php /** @noinspection ALL */

namespace Services;

use App\Models\Contract;
use App\Models\ContractOperationArea;
use App\Services\ContractOperationAreaService;
use App\Services\ContractService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractOperationAreaServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ContractOperationAreaService $operationAreaService;
    protected ContractService $contractService;

    public function setUp(): void
    {
        parent::setUp();
        $this->operationAreaService = \App::make(ContractOperationAreaService::class);
    }

    /**
     * Test if a contract operation area can be created
     * @return void
     * @throws \Throwable
     */
    public function test_create_contract_operation_area() : void
    {
        $contract = Contract::factory()->create();

        $operationArea = ContractOperationArea::factory()->make()->toArray();
        $operationArea['contract_id'] = $contract->id;
        $dbOperationArea = $this->operationAreaService->createContractOperationArea($operationArea);

        $this->assertArrayHasKey('id', $dbOperationArea);
        $this->assertNotNull($dbOperationArea['id'], 'Created operation area must have id specified');
        $this->assertModelExists($dbOperationArea);
    }

    /**
     * Test if a contract operation area can be updated
     * @return void
     * @throws \Throwable
     */
    public function test_update_contract_operation_area() : void
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Operation Area
        $operationArea = ContractOperationArea::factory()->create(['contract_id' => $contract->id]);
        $fakeOperationArea = ContractOperationArea::factory()->make()->toArray();

        $updateOperationArea = $this->operationAreaService->updateContractOperationArea($fakeOperationArea, $operationArea->id);

        $this->assertModelExists($updateOperationArea);
        $dbOperationArea = $this->operationAreaService->getContractCooperationArea($operationArea->id);
        $this->assertModelExists($dbOperationArea);
    }

    /**
     * Test if a contract operation area can be deleted
     * @return void
     */
    public function test_delete_contract_operation_area()
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Operation
        $operationArea = ContractOperationArea::factory()->create(['contract_id' => $contract->id]);

        $response = $this->operationAreaService->deleteContractOperationArea($operationArea->id);

        $this ->assertTrue($response);
        $this->assertNull(ContractOperationArea::find($operationArea->id), 'Contract Operation Area should not exist in database');

    }

    /**
     * Test reading all contract operation area from database
     * @return void
     */
    public function test_find_all()
    {
        // Contract
        $contract = Contract::factory()->create();

        // Contract Operation
        $operationArea = ContractOperationArea::factory()->create(['contract_id' => $contract->id]);
        $dbOperationArea = $this->operationAreaService->findAll();

        $this->assertCount(1, $dbOperationArea, 'The count did not match');

        $this->assertModelData($operationArea->toArray(), $dbOperationArea->first()->toArray());
    }
}
