<?php namespace Tests\Repositories;

use App\Models\Contract;
use App\Models\ContractParty;
use App\Repositories\ContractPartyRepository;
use App\Repositories\ContractRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractPartyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContractPartyRepository
     */
    protected $contractPartyRepo;
    protected $contractRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contractRepo = \App::make(ContractRepository::class);
        $this->contractPartyRepo = \App::make(ContractPartyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contract_party()
    {
        $contract = Contract::factory()->make()->toArray();
        $createdContract = $this->contractRepo->create($contract);
        //$createdContract = $createdContract->toArray();
        $contractParty = ContractParty::factory()->make()->toArray();
        $createdContractParty['contract_id'] = $createdContract->id;

        $createdContractParty = $this->contractPartyRepo->create($contractParty);

        $this->assertArrayHasKey('id', $createdContractParty);
        $this->assertNotNull($createdContractParty['id'], 'Created ContractParty must have id specified');
        $this->assertNotNull(ContractParty::find($createdContractParty['id']), 'ContractParty with given id must be in DB');
        $this->assertModelExists($createdContractParty);
    }

    /**
     * @test read
     */
    public function test_read_contract_party()
    {
        $contractParty = ContractParty::factory()->create();

        $dbContractParty = $this->contractPartyRepo->find($contractParty->id);

        $dbContractParty = $dbContractParty->toArray();
        $this->assertModelData($contractParty->toArray(), $dbContractParty);
    }

    /**
     * @test update
     */
    public function test_update_contract_party()
    {
        $contractParty = ContractParty::factory()->create();
        $fakeContractParty = ContractParty::factory()->make()->toArray();

        $updatedContractParty = $this->contractPartyRepo->update($fakeContractParty, $contractParty->id);

        $this->expectsDatabaseQueryCount(3);
        $this->assertModelExists($updatedContractParty);
        $dbContractParty = $this->contractPartyRepo->find($contractParty->id);
        $this->assertModelExists($dbContractParty);
    }

    /**
     * @test delete
     */
    public function test_delete_contract_party()
    {
        $contractParty = ContractParty::factory()->create();

        $resp = $this->contractPartyRepo->delete($contractParty->id);

        $this->assertTrue($resp);
        $this->assertNull(ContractParty::find($contractParty->id), 'ContractParty should not exist in DB');
    }
}
