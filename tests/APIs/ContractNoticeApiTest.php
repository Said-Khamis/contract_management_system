<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ContractNotice;

class ContractNoticeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract_notice()
    {
        $contractNotice = ContractNotice::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contract_notices', $contractNotice
        );

        $this->assertApiResponse($contractNotice);
    }

    /**
     * @test
     */
    public function test_read_contract_notice()
    {
        $contractNotice = ContractNotice::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contract_notices/'.$contractNotice->id
        );

        $this->assertApiResponse($contractNotice->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract_notice()
    {
        $contractNotice = ContractNotice::factory()->create();
        $editedContractNotice = ContractNotice::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contract_notices/'.$contractNotice->id,
            $editedContractNotice
        );

        $this->assertApiResponse($editedContractNotice);
    }

    /**
     * @test
     */
    public function test_delete_contract_notice()
    {
        $contractNotice = ContractNotice::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contract_notices/'.$contractNotice->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contract_notices/'.$contractNotice->id
        );

        $this->response->assertStatus(404);
    }
}
