<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ImplementationStatus;

class ImplementationStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_implementation_status()
    {
        $implementationStatus = ImplementationStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/implementation_statuses', $implementationStatus
        );

        $this->assertApiResponse($implementationStatus);
    }

    /**
     * @test
     */
    public function test_read_implementation_status()
    {
        $implementationStatus = ImplementationStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/implementation_statuses/'.$implementationStatus->id
        );

        $this->assertApiResponse($implementationStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_implementation_status()
    {
        $implementationStatus = ImplementationStatus::factory()->create();
        $editedImplementationStatus = ImplementationStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/implementation_statuses/'.$implementationStatus->id,
            $editedImplementationStatus
        );

        $this->assertApiResponse($editedImplementationStatus);
    }

    /**
     * @test
     */
    public function test_delete_implementation_status()
    {
        $implementationStatus = ImplementationStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/implementation_statuses/'.$implementationStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/implementation_statuses/'.$implementationStatus->id
        );

        $this->response->assertStatus(404);
    }
}
