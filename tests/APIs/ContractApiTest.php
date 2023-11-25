<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Contract;

class ContractApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract()
    {
        $contract = Contract::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contractss', $contract
        );

        $this->assertApiResponse($contract);
    }

    /**
     * @test
     */
    public function test_read_contract()
    {
        $contract = Contract::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contractss/'.$contract->id
        );

        $this->assertApiResponse($contract->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract()
    {
        $contract = Contract::factory()->create();
        $editedContract = Contract::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contractss/'.$contract->id,
            $editedContract
        );

        $this->assertApiResponse($editedContract);
    }

    /**
     * @test
     */
    public function test_delete_contract()
    {
        $contract = Contract::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contractss/'.$contract->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contractss/'.$contract->id
        );

        $this->response->assertStatus(404);
    }
}
