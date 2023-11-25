<?php

namespace Services;

use App\Models\Attachment;
use App\Services\AttachmentService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

Class AttachmentServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected AttachmentService $attachmentService;

    function setUp():void{
        parent::setUp();
        $this->attachmentService = \App::make(AttachmentService::class);
    }

    public function test_find_all(){
        $attachment = Attachment::factory()->create();

        $dbAttachment = $this->attachmentService->findAll();

        $this->assertCount(1, $dbAttachment);
        $this->assertModelData($attachment->toArray(), $dbAttachment->first()->toArray());
    }

    public function test_create_attachment(){
        $attachment = Attachment::factory()->create()->toArray();
        $dbAttachment = $this->attachmentService->createAttachment($attachment);
        $this->assertArrayHasKey('id', $dbAttachment);
        $this->assertNotNull($dbAttachment['id'], 'Created Attachment must have id specified');
        $this->assertModelData($attachment, $dbAttachment->first()->toArray());
    }

    public function test_show_attachment(){
        $attachment = Attachment::factory()->create();
        $retrievedAttachment = $this->attachmentService->getAttachment($attachment->id);
        $this->assertEquals($attachment->id, $retrievedAttachment->id);
        $this->assertEquals($attachment->name, $retrievedAttachment->name);
    }

    public function test_update_attachment(){
        $attachment = Attachment::factory()->create();
        $fakeAttachment = Attachment::factory()->make()->toArray();
        $updateAttachment = $this->attachmentService->updateAttachment($fakeAttachment, $attachment->id);
        $this->assertModelData($fakeAttachment, $updateAttachment->toArray());
        $dbAttachment = $this->attachmentService->getAttachment($attachment->id);
        $this->assertModelData($fakeAttachment, $dbAttachment->toArray());
    }

    public function test_delete_attachment(){
        $attachment = Attachment::factory()->create();
        $deleteAttachment = $this->attachmentService->deleteAttachment(($attachment->id));
        $this->assertTrue($deleteAttachment);
        $this->assertSoftDeleted($attachment);
        $this->assertNull($this->attachmentService->getAttachment($attachment->id), 'Attachment should not exist in DB');
    }
}