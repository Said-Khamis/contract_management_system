<?php namespace Tests\Repositories;

use App\Models\Contract;
use App\Models\ContractParty;
use App\Models\ContractResponsibility;
use App\Repositories\ContractPartyRepository;
use App\Repositories\ContractRepository;
use App\Repositories\ContractResponsibilityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use function Symfony\Component\Uid\Factory\create;

class ContractResponsibilityRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContractResponsibilityRepository
     */
    protected $contractResponsibilityRepo;
    protected $contractRepo;
    protected $contractPartyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contractRepo = \App::make(ContractRepository::class);
        $this->contractPartyRepo = \App::make(ContractPartyRepository::class);
        $this->contractResponsibilityRepo = \App::make(ContractResponsibilityRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contract_responsibility()
    {
        $contractResponsibility = ContractResponsibility::factory()->make()->toArray();

        $createdContractResponsibility = $this->contractResponsibilityRepo->create($contractResponsibility);

        $this->assertArrayHasKey('id', $createdContractResponsibility);
        $this->assertNotNull($createdContractResponsibility['id'], 'Created ContractResponsibility must have id specified');
        $this->assertNotNull(ContractResponsibility::find($createdContractResponsibility['id']), 'ContractResponsibility with given id must be in DB');
        $this->assertModelExists($createdContractResponsibility);
    }

    /**
     * @test read
     */
    public function test_read_contract_responsibility()
    {
        $contractResponsibility = ContractResponsibility::factory()->create();

        $dbContractResponsibility = $this->contractResponsibilityRepo->find($contractResponsibility->id);

        $dbContractResponsibility = $dbContractResponsibility->toArray();
        $this->assertModelData($contractResponsibility->toArray(), $dbContractResponsibility);
    }

    /**
     * @test update
     */
    public function test_update_contract_responsibility()
    {
        $contractResponsibility = ContractResponsibility::factory()->create();
        $fakeContractResponsibility = ContractResponsibility::factory()->make()->toArray();

        $updatedContractResponsibility = $this->contractResponsibilityRepo->update($fakeContractResponsibility, $contractResponsibility->id);

        $this->assertModelExists($updatedContractResponsibility);
    }

    /**
     * @test delete
     */
    public function test_delete_contract_responsibility()
    {
        $contractResponsibility = ContractResponsibility::factory()->create();

        $resp = $this->contractResponsibilityRepo->delete($contractResponsibility->id);

        $this->assertTrue($resp);
        $this->assertNull(ContractResponsibility::find($contractResponsibility->id), 'ContractResponsibility should not exist in DB');
    }
}
