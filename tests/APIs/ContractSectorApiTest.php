<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sector;

class ContractSectorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contract_sector()
    {
        $contractSector = Sector::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sectors', $contractSector
        );

        $this->assertApiResponse($contractSector);
    }

    /**
     * @test
     */
    public function test_read_contract_sector()
    {
        $contractSector = Sector::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sectors/'.$contractSector->id
        );

        $this->assertApiResponse($contractSector->toArray());
    }

    /**
     * @test
     */
    public function test_update_contract_sector()
    {
        $contractSector = Sector::factory()->create();
        $editedContractSector = Sector::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sectors/'.$contractSector->id,
            $editedContractSector
        );

        $this->assertApiResponse($editedContractSector);
    }

    /**
     * @test
     */
    public function test_delete_contract_sector()
    {
        $contractSector = Sector::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sectors/'.$contractSector->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sectors/'.$contractSector->id
        );

        $this->response->assertStatus(404);
    }
}
