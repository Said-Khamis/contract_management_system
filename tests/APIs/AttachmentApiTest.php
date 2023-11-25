<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Attachment;

class AttachmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_attachment()
    {
        $attachment = Attachment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/attachments', $attachment
        );

        $this->assertApiResponse($attachment);
    }

    /**
     * @test
     */
    public function test_read_attachment()
    {
        $attachment = Attachment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/attachments/'.$attachment->id
        );

        $this->assertApiResponse($attachment->toArray());
    }

    /**
     * @test
     */
    public function test_update_attachment()
    {
        $attachment = Attachment::factory()->create();
        $editedAttachment = Attachment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/attachments/'.$attachment->id,
            $editedAttachment
        );

        $this->assertApiResponse($editedAttachment);
    }

    /**
     * @test
     */
    public function test_delete_attachment()
    {
        $attachment = Attachment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/attachments/'.$attachment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/attachments/'.$attachment->id
        );

        $this->response->assertStatus(404);
    }
}
