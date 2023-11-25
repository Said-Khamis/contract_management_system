<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ActionPlan;

class ActionPlanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_action_plan()
    {
        $actionPlan = ActionPlan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/action_plans', $actionPlan
        );

        $this->assertApiResponse($actionPlan);
    }

    /**
     * @test
     */
    public function test_read_action_plan()
    {
        $actionPlan = ActionPlan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/action_plans/'.$actionPlan->id
        );

        $this->assertApiResponse($actionPlan->toArray());
    }

    /**
     * @test
     */
    public function test_update_action_plan()
    {
        $actionPlan = ActionPlan::factory()->create();
        $editedActionPlan = ActionPlan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/action_plans/'.$actionPlan->id,
            $editedActionPlan
        );

        $this->assertApiResponse($editedActionPlan);
    }

    /**
     * @test
     */
    public function test_delete_action_plan()
    {
        $actionPlan = ActionPlan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/action_plans/'.$actionPlan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/action_plans/'.$actionPlan->id
        );

        $this->response->assertStatus(404);
    }
}
