<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ContractTermination;

class ContractTerminationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract_termination()
    {
        $contractTermination = ContractTermination::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contract_terminations', $contractTermination
        );

        $this->assertApiResponse($contractTermination);
    }

    /**
     * @test
     */
    public function test_read_contract_termination()
    {
        $contractTermination = ContractTermination::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contract_terminations/'.$contractTermination->id
        );

        $this->assertApiResponse($contractTermination->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract_termination()
    {
        $contractTermination = ContractTermination::factory()->create();
        $editedContractTermination = ContractTermination::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contract_terminations/'.$contractTermination->id,
            $editedContractTermination
        );

        $this->assertApiResponse($editedContractTermination);
    }

    /**
     * @test
     */
    public function test_delete_contract_termination()
    {
        $contractTermination = ContractTermination::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contract_terminations/'.$contractTermination->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contract_terminations/'.$contractTermination->id
        );

        $this->response->assertStatus(404);
    }
}
