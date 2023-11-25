<?php

namespace Services;

use App\Models\ActionPlan;
use App\Models\Contract;
use App\Services\ActionPlanService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

Class ActionPlanServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ActionPlanService $actionPlanService;

    function setUp(): void
    {
        parent::setUp();
        $this->actionPlanService = \App::make(ActionPlanService::class);
    }

    public function test_find_all(){
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->create(['contract_id'=>$contract->id]);
        $dbActionPlan = $this->actionPlanService->findAll();

        $this->assertCount(1, $dbActionPlan);

        $this->assertModelData($actionPlan->toArray(), $dbActionPlan->first()->toArray());

    }

    public function test_create_action_plan(){
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->make()->toArray();
        $actionPlan['contract_id'] = $contract->id;
        $dbActionPlan = $this->actionPlanService->createActionPlan($actionPlan);
        $this->assertArrayHasKey('id', $dbActionPlan->toArray());
        $this->assertNotNull($dbActionPlan['id'], 'Created Action Plan must have id specified');
        $this->assertModelExists($dbActionPlan);
    }

    public function test_show_action_plan(){
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->create(['contract_id'=>$contract->id]);
        $retrievedActionPlan = $this->actionPlanService->getActionPlan($actionPlan->id);
        $this->assertEquals($actionPlan->id, $retrievedActionPlan->id);
        $this->assertEquals($actionPlan->name, $retrievedActionPlan->name);
    }

    public function test_update_action_plan(){
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->create(['contract_id'=>$contract->id]);
        $fakeActionPlan = ActionPlan::factory()->make()->toArray();
        $updateActionPlan = $this->actionPlanService->updateActionPlan($fakeActionPlan, $actionPlan->id);
        $this->assertModelData($fakeActionPlan, $updateActionPlan->toArray());
        $dbActionPlan = $this->actionPlanService->getActionPlan($actionPlan->id);
        $this->assertModelData($fakeActionPlan, $dbActionPlan->toArray());

    }

    public function test_delete_action_plan(){
        $contract = Contract::factory()->create();
        $actionPlan = ActionPlan::factory()->create(['contract_id'=>$contract->id]);
        $deleteActionPlan = $this->actionPlanService->deleteActionPlan($actionPlan->id);
        $this->assertTrue($deleteActionPlan);
        $this->assertSoftDeleted($actionPlan);
        $this->assertNull($this->actionPlanService->getActionPlan($actionPlan->id), 'Action Plan should not exist in DB');
    }
}
