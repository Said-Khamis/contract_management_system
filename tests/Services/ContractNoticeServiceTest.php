<?php

namespace Services;

use App\Models\Contract;
use App\Models\ContractNotice;
use App\Services\ContractNoticeService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class ContractNoticeServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected ContractNoticeService $contractNoticeService;

    public function setUp(): void
    {
        parent::setUp();
        $this->contractNoticeService = \App::make(ContractNoticeService::class);
    }

    /**
     * @throws \Throwable
     */
    public function test_create_contract_notice() : void
    {
        $notice = ContractNotice::factory()->make()->toArray();
        $dbNotice = $this->contractNoticeService->createContractNotice($notice);

        $this->assertArrayHasKey('id', $dbNotice);
        $this->assertNotNull($dbNotice['id'], 'The specified value must be in database');
        $this->assertModelExists($dbNotice);
    }

    /**
     * @throws \Throwable
     */
    public function test_update_contract_notice() : void
    {
        $notice = ContractNotice::factory()->create();
        $fakeNotice = ContractNotice::factory()->make()->toArray();

        $updatedContractNotice = $this->contractNoticeService->updatedContractNotice($fakeNotice, $notice->id);

        $this->expectsDatabaseQueryCount(2);
        $this->assertDatabaseCount('contract_notices', 1);
        $this->assertModelExists($updatedContractNotice);
    }

    public function test_delete_contract_notice() : void
    {
        $contract = Contract::factory()->create();

        $notice = ContractNotice::factory()->create(['contract_id'=>$contract->id]);

        $response = $this->contractNoticeService->deleteContractNotice($notice->id);

        $this->assertTrue($response);
        $this->assertNull(ContractNotice::find($notice->id), 'Contract Notice should not exist in database');
    }

    public function test_find_all() : void
    {
        // Contract
        $contract = Contract::factory()->create();

        $notice = ContractNotice::factory()->create(['contract_id' => $contract->id]);
        $dbNotice = $this->contractNoticeService->findAll();

        $this->assertCount(1, $dbNotice, 'The count did not match');

        $this->assertModelData($notice->toArray(), $dbNotice->first()->toArray());
    }
}
