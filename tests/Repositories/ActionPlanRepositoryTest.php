<?php namespace Tests\Repositories;

use App\Models\ActionPlan;
use App\Models\Contract;
use App\Repositories\ActionPlanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ActionPlanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActionPlanRepository
     */
    protected $actionPlanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->actionPlanRepo = \App::make(ActionPlanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_action_plan()
    {
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->make()->toArray();
        $actionPlan['contract_id'] = $contract->id;

        $createdActionPlan = $this->actionPlanRepo->create($actionPlan);

        $this->assertArrayHasKey('id', $createdActionPlan);
        $this->assertNotNull($createdActionPlan['id'], 'Created ActionPlan must have id specified');
        $this->assertNotNull(ActionPlan::find($createdActionPlan['id']), 'ActionPlan with given id must be in DB');
        $this->assertModelExists($createdActionPlan);
    }

    /**
     * @test read
     */
    public function test_read_action_plan()
    {
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->create(['contract_id'=>$contract->id]);

        $dbActionPlan = $this->actionPlanRepo->find($actionPlan->id);

        $dbActionPlan = $dbActionPlan->toArray();
        $this->assertModelData($actionPlan->toArray(), $dbActionPlan);
    }

    /**
     * @test update
     */
    public function test_update_action_plan()
    {
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->create(['contract_id'=>$contract->id]);
        $fakeActionPlan = ActionPlan::factory()->make()->toArray();

        $updatedActionPlan = $this->actionPlanRepo->update($fakeActionPlan, $actionPlan->id);

        $this->assertModelData($fakeActionPlan, $updatedActionPlan->toArray());
        $dbActionPlan = $this->actionPlanRepo->find($actionPlan->id);
        $this->assertModelData($fakeActionPlan, $dbActionPlan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_action_plan()
    {
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->create(['contract_id'=>$contract->id]);

        $resp = $this->actionPlanRepo->delete($actionPlan->id);

        $this->assertTrue($resp);
        $this->assertNull(ActionPlan::find($actionPlan->id), 'ActionPlan should not exist in DB');
    }
}
