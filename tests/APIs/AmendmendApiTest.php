<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Amendment;

class AmendmendApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_amendmend()
    {
        $amendmend = Amendment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/amendmends', $amendmend
        );

        $this->assertApiResponse($amendmend);
    }

    /**
     * @test
     */
    public function test_read_amendmend()
    {
        $amendmend = Amendment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/amendmends/'.$amendmend->id
        );

        $this->assertApiResponse($amendmend->toArray());
    }

    /**
     * @test
     */
    public function test_update_amendmend()
    {
        $amendmend = Amendment::factory()->create();
        $editedAmendmend = Amendment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/amendmends/'.$amendmend->id,
            $editedAmendmend
        );

        $this->assertApiResponse($editedAmendmend);
    }

    /**
     * @test
     */
    public function test_delete_amendmend()
    {
        $amendmend = Amendment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/amendmends/'.$amendmend->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/amendmends/'.$amendmend->id
        );

        $this->response->assertStatus(404);
    }
}
