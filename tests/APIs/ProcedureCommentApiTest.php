<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProcedureComment;

class ProcedureCommentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_procedure_comment()
    {
        $procedureComment = ProcedureComment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/procedure_comments', $procedureComment
        );

        $this->assertApiResponse($procedureComment);
    }

    /**
     * @test
     */
    public function test_read_procedure_comment()
    {
        $procedureComment = ProcedureComment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/procedure_comments/'.$procedureComment->id
        );

        $this->assertApiResponse($procedureComment->toArray());
    }

    /**
     * @test
     */
    public function test_update_procedure_comment()
    {
        $procedureComment = ProcedureComment::factory()->create();
        $editedProcedureComment = ProcedureComment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/procedure_comments/'.$procedureComment->id,
            $editedProcedureComment
        );

        $this->assertApiResponse($editedProcedureComment);
    }

    /**
     * @test
     */
    public function test_delete_procedure_comment()
    {
        $procedureComment = ProcedureComment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/procedure_comments/'.$procedureComment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/procedure_comments/'.$procedureComment->id
        );

        $this->response->assertStatus(404);
    }
}
