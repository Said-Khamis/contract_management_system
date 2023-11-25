<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ContractParty;

class ContractPartyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract_party()
    {
        $contractParty = ContractParty::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contract_parties', $contractParty
        );

        $this->assertApiResponse($contractParty);
    }

    /**
     * @test
     */
    public function test_read_contract_party()
    {
        $contractParty = ContractParty::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contract_parties/'.$contractParty->id
        );

        $this->assertApiResponse($contractParty->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract_party()
    {
        $contractParty = ContractParty::factory()->create();
        $editedContractParty = ContractParty::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contract_parties/'.$contractParty->id,
            $editedContractParty
        );

        $this->assertApiResponse($editedContractParty);
    }

    /**
     * @test
     */
    public function test_delete_contract_party()
    {
        $contractParty = ContractParty::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contract_parties/'.$contractParty->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contract_parties/'.$contractParty->id
        );

        $this->response->assertStatus(404);
    }
}
