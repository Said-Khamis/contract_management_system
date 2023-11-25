<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ContractOperationArea;

class ContractOperationAreaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract_operation_area()
    {
        $contractOperationArea = ContractOperationArea::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contract_operation_areas', $contractOperationArea
        );

        $this->assertApiResponse($contractOperationArea);
    }

    /**
     * @test
     */
    public function test_read_contract_operation_area()
    {
        $contractOperationArea = ContractOperationArea::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contract_operation_areas/'.$contractOperationArea->id
        );

        $this->assertApiResponse($contractOperationArea->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract_operation_area()
    {
        $contractOperationArea = ContractOperationArea::factory()->create();
        $editedContractOperationArea = ContractOperationArea::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contract_operation_areas/'.$contractOperationArea->id,
            $editedContractOperationArea
        );

        $this->assertApiResponse($editedContractOperationArea);
    }

    /**
     * @test
     */
    public function test_delete_contract_operation_area()
    {
        $contractOperationArea = ContractOperationArea::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contract_operation_areas/'.$contractOperationArea->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contract_operation_areas/'.$contractOperationArea->id
        );

        $this->response->assertStatus(404);
    }
}
