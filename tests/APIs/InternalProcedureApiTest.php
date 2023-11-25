<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\InternalProcedure;

class InternalProcedureApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_internal_procedure()
    {
        $internalProcedure = InternalProcedure::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/internal_procedures', $internalProcedure
        );

        $this->assertApiResponse($internalProcedure);
    }

    /**
     * @test
     */
    public function test_read_internal_procedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/internal_procedures/'.$internalProcedure->id
        );

        $this->assertApiResponse($internalProcedure->toArray());
    }

    /**
     * @test
     */
    public function test_update_internal_procedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();
        $editedInternalProcedure = InternalProcedure::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/internal_procedures/'.$internalProcedure->id,
            $editedInternalProcedure
        );

        $this->assertApiResponse($editedInternalProcedure);
    }

    /**
     * @test
     */
    public function test_delete_internal_procedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/internal_procedures/'.$internalProcedure->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/internal_procedures/'.$internalProcedure->id
        );

        $this->response->assertStatus(404);
    }
}
