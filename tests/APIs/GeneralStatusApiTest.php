<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\GeneralStatus;

class GeneralStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_general_status()
    {
        $generalStatus = GeneralStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/general_statuses', $generalStatus
        );

        $this->assertApiResponse($generalStatus);
    }

    /**
     * @test
     */
    public function test_read_general_status()
    {
        $generalStatus = GeneralStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/general_statuses/'.$generalStatus->id
        );

        $this->assertApiResponse($generalStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_general_status()
    {
        $generalStatus = GeneralStatus::factory()->create();
        $editedGeneralStatus = GeneralStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/general_statuses/'.$generalStatus->id,
            $editedGeneralStatus
        );

        $this->assertApiResponse($editedGeneralStatus);
    }

    /**
     * @test
     */
    public function test_delete_general_status()
    {
        $generalStatus = GeneralStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/general_statuses/'.$generalStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/general_statuses/'.$generalStatus->id
        );

        $this->response->assertStatus(404);
    }
}
