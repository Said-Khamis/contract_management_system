<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Ward;

class WardApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ward()
    {
        $ward = Ward::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/wards', $ward
        );

        $this->assertApiResponse($ward);
    }

    /**
     * @test
     */
    public function test_read_ward()
    {
        $ward = Ward::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/wards/'.$ward->id
        );

        $this->assertApiResponse($ward->toArray());
    }

    /**
     * @test
     */
    public function test_update_ward()
    {
        $ward = Ward::factory()->create();
        $editedWard = Ward::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/wards/'.$ward->id,
            $editedWard
        );

        $this->assertApiResponse($editedWard);
    }

    /**
     * @test
     */
    public function test_delete_ward()
    {
        $ward = Ward::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/wards/'.$ward->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/wards/'.$ward->id
        );

        $this->response->assertStatus(404);
    }
}
