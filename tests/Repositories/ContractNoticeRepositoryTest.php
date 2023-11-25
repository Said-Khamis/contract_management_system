<?php namespace Tests\Repositories;

use App\Models\ContractNotice;
use App\Repositories\ContractNoticeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractNoticeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContractNoticeRepository
     */
    protected $contractNoticeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contractNoticeRepo = \App::make(ContractNoticeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contract_notice()
    {
        $contractNotice = ContractNotice::factory()->make()->toArray();

        $createdContractNotice = $this->contractNoticeRepo->create($contractNotice);

        $this->assertArrayHasKey('id', $createdContractNotice);
        $this->assertNotNull($createdContractNotice['id'], 'Created ContractNotice must have id specified');
        $this->assertNotNull(ContractNotice::find($createdContractNotice['id']), 'ContractNotice with given id must be in DB');
        $this->assertModelExists($createdContractNotice);
    }

    /**
     * @test read
     */
    public function test_read_contract_notice()
    {
        $contractNotice = ContractNotice::factory()->create();

        $dbContractNotice = $this->contractNoticeRepo->find($contractNotice->id);

        $dbContractNotice = $dbContractNotice->toArray();
        $this->assertModelData($contractNotice->toArray(), $dbContractNotice);
    }

    /**
     * @test update
     */
    public function test_update_contract_notice()
    {
        $contractNotice = ContractNotice::factory()->create();
        $fakeContractNotice = ContractNotice::factory()->make()->toArray();

        $updatedContractNotice = $this->contractNoticeRepo->update($fakeContractNotice, $contractNotice->id);

        $this->expectsDatabaseQueryCount(4);
        $this->assertDatabaseCount('contract_notices', 1);
        $dbContractNotice = $this->contractNoticeRepo->find($contractNotice->id);
        $this->assertModelExists($dbContractNotice);
        $this->assertModelExists($updatedContractNotice);
    }

    /**
     * @test delete
     * @throws \Exception
     */
    public function test_delete_contract_notice()
    {
        $contractNotice = ContractNotice::factory()->create();

        $resp = $this->contractNoticeRepo->delete($contractNotice->id);

        $this->assertTrue($resp);
        $this->assertNull(ContractNotice::find($contractNotice->id), 'ContractNotice should not exist in DB');
    }
}
