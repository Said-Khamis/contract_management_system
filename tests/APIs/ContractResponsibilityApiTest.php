<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ContractResponsibility;

class ContractResponsibilityApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract_responsibility()
    {
        $contractResponsibility = ContractResponsibility::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contract_responsibilities', $contractResponsibility
        );

        $this->assertApiResponse($contractResponsibility);
    }

    /**
     * @test
     */
    public function test_read_contract_responsibility()
    {
        $contractResponsibility = ContractResponsibility::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contract_responsibilities/'.$contractResponsibility->id
        );

        $this->assertApiResponse($contractResponsibility->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract_responsibility()
    {
        $contractResponsibility = ContractResponsibility::factory()->create();
        $editedContractResponsibility = ContractResponsibility::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contract_responsibilities/'.$contractResponsibility->id,
            $editedContractResponsibility
        );

        $this->assertApiResponse($editedContractResponsibility);
    }

    /**
     * @test
     */
    public function test_delete_contract_responsibility()
    {
        $contractResponsibility = ContractResponsibility::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contract_responsibilities/'.$contractResponsibility->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contract_responsibilities/'.$contractResponsibility->id
        );

        $this->response->assertStatus(404);
    }
}
