<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ContractObjective;

class ContractObjectiveApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract_objective()
    {
        $contractObjective = ContractObjective::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contract_objectives', $contractObjective
        );

        $this->assertApiResponse($contractObjective);
    }

    /**
     * @test
     */
    public function test_read_contract_objective()
    {
        $contractObjective = ContractObjective::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contract_objectives/'.$contractObjective->id
        );

        $this->assertApiResponse($contractObjective->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract_objective()
    {
        $contractObjective = ContractObjective::factory()->create();
        $editedContractObjective = ContractObjective::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contract_objectives/'.$contractObjective->id,
            $editedContractObjective
        );

        $this->assertApiResponse($editedContractObjective);
    }

    /**
     * @test
     */
    public function test_delete_contract_objective()
    {
        $contractObjective = ContractObjective::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contract_objectives/'.$contractObjective->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contract_objectives/'.$contractObjective->id
        );

        $this->response->assertStatus(404);
    }
}
