<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

/** @noinspection PhpUndefinedMethodInspection */

namespace Tests\Services;

use App\Models\Category;
use App\Models\Contract;
use App\Services\ContractService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;
use Throwable;

class ContractServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected ContractService $contractService;
    protected Category $category;
    public function setUp(): void
    {
        parent::setUp();
        $this->contractService = \App::make(ContractService::class);
        $this->category = Category::factory()->create();
    }

    /**
     * Test if a contract can be created
     * @return void
     * @throws Throwable
     */
    public function test_create_contract() : void
    {
        $contract = Contract::factory()->make()->toArray();
        $contract['category_id'] = $this->category->id;
        $dbContract = $this->contractService->createContract($contract);

        $this->assertArrayHasKey('id', $dbContract);
        $this->assertNotNull($dbContract['id'], 'Created Contract must have id specified');
        $this->assertModelData($contract, $dbContract->first()->toArray());
    }

    /**
     * Test if a contract can be updated
     * @return void
     * @throws Throwable
     */
    public function test_update_contract(): void
    {
        $contract = Contract::factory()->make();
        $this->category->contracts()->save($contract);

        $fakeContact = Contract::factory()->make()->toArray();

        $updateContract = $this->contractService->updateContract($fakeContact, $contract->id);

        $this->assertModelData($fakeContact, $updateContract->toArray());
        $dbContract = $this->contractService->getContract($contract->id);
        $this->assertModelData($fakeContact, $dbContract->toArray());
    }

    /**
     * Test if a contract can be deleted
     * @return void
     * @throws Throwable
     */
    public function test_delete_contract(): void
    {
        $contract = Contract::factory()->make();
        $this->category->contracts()->save($contract);

        $response = $this->contractService->deleteContract($contract->id);

        $this->assertTrue($response);
        $this->assertNull(Contract::find($contract->id), 'Contract should not exist in database');
    }

    /**
    * Test reading all contractss from database
    * @return void
    */
    public function test_find_all(): void
    {
        $contract = Contract::factory()->make();
        $this->category->contracts()->save($contract);

        $dbContract = $this->contractService->findAll();

        $this->assertCount(1, $dbContract, 'The count did not match');
        $this->assertModelData($contract->toArray(), $dbContract->first()->toArray());
    }
}
