<?php

namespace Services;

use App\Models\Contract;
use App\Models\ContractResponsibility;
use App\Models\ContractResponsibilityStatus;
use App\Services\ContractResponsibilityStatusService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractResponsibilityStatusServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected ContractResponsibilityStatusService $responsibilityStatusService;

    public function setUp(): void
    {
        parent::setUp();
        $this->responsibilityStatusService = \App::make(ContractResponsibilityStatusService::class);
    }

    /**
     * Test if a contract responsibility status can be created
     * @return void
     */
    public function test_create_contract_responsibility_status() : void
    {
        $contract = Contract::factory()->create();
        $responsibility = ContractResponsibility::factory()->create(['contract_id'=>$contract->id]);

        $status = ContractResponsibilityStatus::factory()->make()->toArray();
        $status['contract_responsibility_id'] = $responsibility->id;

        $dbStatus = $this->responsibilityStatusService->createContractResponsibilityStatus($status);

        $this->assertArrayHasKey('id', $dbStatus);
        $this->assertModelExists($dbStatus);
        $this->assertNotNull(ContractResponsibilityStatus::find($dbStatus['id']), 'The created model must have id specified');
    }

    /**
     * Test if a contract responsibility status can be updated
     * @return void
     */
    public function test_update_contract_responsibility_status() : void
    {
        $status = ContractResponsibilityStatus::factory()->create();
        $fakeStatus = ContractResponsibilityStatus::factory()->make()->toArray();

        $updatedStatus = $this->responsibilityStatusService->updateContractResponsibilityStatus($fakeStatus, $status->id);

        $this->assertModelExists($status);
        $dbStatus = $this->responsibilityStatusService->getContractResponsibilityStatus($status->id);
        $this->assertModelExists($dbStatus);
    }

    /**
     * Test if a contract responsibility status can be deleted
     * @return void
     */
    public function test_delete_contract_responsibility() : void
    {
        $status = ContractResponsibilityStatus::factory()->create();

        $response = $this->responsibilityStatusService->deleteContractResponsibility($status->id);

        $this->assertTrue($response);
        $this->assertNull(ContractResponsibilityStatus::find($status->id), 'Model should not exist in database');
    }

    /**
     * Test reading all contract responsibilities status from database
     * @return void
     */
    public function test_find_all(): void
    {
        $status = ContractResponsibilityStatus::factory()->create();

        $dbStatus = $this->responsibilityStatusService->findAll();
        $this->assertCount(1, $dbStatus);
        $this->assertModelData($status->toArray(), $dbStatus->first()->toArray());
    }
}
