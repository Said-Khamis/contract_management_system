<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ContractResponsibilityStatus;

class ContractResponsibilityStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract_responsibility_status()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contract_responsibility_statuses', $contractResponsibilityStatus
        );

        $this->assertApiResponse($contractResponsibilityStatus);
    }

    /**
     * @test
     */
    public function test_read_contract_responsibility_status()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contract_responsibility_statuses/'.$contractResponsibilityStatus->id
        );

        $this->assertApiResponse($contractResponsibilityStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract_responsibility_status()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->create();
        $editedContractResponsibilityStatus = ContractResponsibilityStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contract_responsibility_statuses/'.$contractResponsibilityStatus->id,
            $editedContractResponsibilityStatus
        );

        $this->assertApiResponse($editedContractResponsibilityStatus);
    }

    /**
     * @test
     */
    public function test_delete_contract_responsibility_status()
    {
        $contractResponsibilityStatus = ContractResponsibilityStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contract_responsibility_statuses/'.$contractResponsibilityStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contract_responsibility_statuses/'.$contractResponsibilityStatus->id
        );

        $this->response->assertStatus(404);
    }
}
