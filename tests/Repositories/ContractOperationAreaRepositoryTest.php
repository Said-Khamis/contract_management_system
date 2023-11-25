<?php namespace Tests\Repositories;

use App\Models\ContractOperationArea;
use App\Repositories\ContractOperationAreaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContractOperationAreaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContractOperationAreaRepository
     */
    protected $contractOperationAreaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contractOperationAreaRepo = \App::make(ContractOperationAreaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contract_operation_area()
    {
        $contractOperationArea = ContractOperationArea::factory()->make()->toArray();

        $createdContractOperationArea = $this->contractOperationAreaRepo->create($contractOperationArea);

        $this->assertArrayHasKey('id', $createdContractOperationArea);
        $this->assertNotNull($createdContractOperationArea['id'], 'Created ContractOperationArea must have id specified');
        $this->assertNotNull(ContractOperationArea::find($createdContractOperationArea['id']), 'ContractOperationArea with given id must be in DB');
        $this->assertModelExists($createdContractOperationArea);
    }

    /**
     * @test read
     */
    public function test_read_contract_operation_area()
    {
        $contractOperationArea = ContractOperationArea::factory()->create();

        $dbContractOperationArea = $this->contractOperationAreaRepo->find($contractOperationArea->id);

        $dbContractOperationArea = $dbContractOperationArea->toArray();
        $this->assertModelData($contractOperationArea->toArray(), $dbContractOperationArea);
    }

    /**
     * @test update
     */
    public function test_update_contract_operation_area()
    {
        $contractOperationArea = ContractOperationArea::factory()->create();
        $fakeContractOperationArea = ContractOperationArea::factory()->make()->toArray();

        $updatedContractOperationArea = $this->contractOperationAreaRepo->update($fakeContractOperationArea, $contractOperationArea->id);

        $this->expectsDatabaseQueryCount(2);
        $dbContractOperationArea = $this->contractOperationAreaRepo->find($contractOperationArea->id);
        $this->assertModelExists($dbContractOperationArea);
    }

    /**
     * @test delete
     */
    public function test_delete_contract_operation_area()
    {
        $contractOperationArea = ContractOperationArea::factory()->create();

        $resp = $this->contractOperationAreaRepo->delete($contractOperationArea->id);

        $this->assertTrue($resp);
        $this->assertNull(ContractOperationArea::find($contractOperationArea->id), 'ContractOperationArea should not exist in DB');
    }
}
