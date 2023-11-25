<?php namespace Tests\Repositories;

use App\Models\Amendment;
use App\Models\Contract;
use App\Repositories\AmendmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AmendmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AmendmentRepository
     */
    protected AmendmentRepository $amendmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->amendmentRepo = \App::make(AmendmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_amendment()
    {
        $contract = Contract::factory()->create();
        $amendment = Amendment::factory()->make()->toArray();
        $amendment['contract_id']=$contract->id;

        $createdAmendment = $this->amendmentRepo->create($amendment);

        $this->assertArrayHasKey('id', $createdAmendment);
        $this->assertNotNull($createdAmendment['id'], 'Created Amendment must have id specified');
        $this->assertNotNull(Amendment::find($createdAmendment['id']), 'Amendment with given id must be in DB');
        $this->assertModelExists($createdAmendment);
    }

    /**
     * @test read
     */
    public function test_read_amendment()
    {
        $contract = Contract::factory()->create();
        $amendmend = Amendment::factory()->create(['contract_id'=>$contract->id]);

        $dbAmendment = $this->amendmentRepo->find($amendmend->id);

        $this->assertModelExists($dbAmendment);
    }

    /**
     * @test update
     */
    public function test_update_amendment()
    {
        $contract = Contract::factory()->create();
        $amendment = Amendment::factory()->create(['contract_id'=>$contract->id]);
        $fakeAmendment = Amendment::factory()->make()->toArray();

        $updatedAmendmend = $this->amendmentRepo->update($fakeAmendment, $amendment->id);

        $this->assertModelData($fakeAmendment, $updatedAmendmend->toArray());
        $dbAmendment = $this->amendmentRepo->find($amendment->id);
        $this->assertModelData($fakeAmendment, $dbAmendment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_amendment()
    {
        $contract = Contract::factory()->create();
        $amendmend = Amendment::factory()->create(['contract_id'=>$contract->id]);

        $resp = $this->amendmentRepo->delete($amendmend->id);

        $this->assertTrue($resp);
        $this->assertNull(Amendment::find($amendmend->id), 'Amendmend should not exist in DB');
    }
}
