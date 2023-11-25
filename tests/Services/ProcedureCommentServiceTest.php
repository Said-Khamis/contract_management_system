<?php

namespace Tests\Services;

use App\Models\ProcedureComment;
use App\Services\ProcedureCommentService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;


Class ProcedureCommentServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected ProcedureCommentService $procedureCommentService;
    
    /**
     * @var ProcedureCommentService
     */
    function setUp(): void
    {
        parent::setUp();
        $this->procedureCommentService = \App::make(ProcedureCommentService::class);
    }

    /**
     * @test find
     */
    public function test_find_all()
    {
        $procedureComment = ProcedureComment::factory()->create();
        $dbProcedureComment = $this->procedureCommentService->findAll();
        $this->assertCount(1, $dbProcedureComment);
        $this->assertModelData($procedureComment->toArray(), $dbProcedureComment->first()->toArray());
    }

    /**
     * @test create
     */
    public function test_create_procedureComment()
    {
        $procedureComment = ProcedureComment::factory()->create()->toArray();
        $dbProcedureComment = $this->procedureCommentService->createProcedureComment($procedureComment);
        $this->assertArrayHasKey('id',$dbProcedureComment);
        $this->assertNotNull($dbProcedureComment['id'], 'Created ProcedureComment must have id specified');
        $this->assertModelData($procedureComment, $dbProcedureComment->first()->toArray());
    }

    /**
     * @test read
     */
    public function test_show_procedureComment()
    {
        $procedureComment = ProcedureComment::factory()->create();
        $retrievedProcedureComment = $this->procedureCommentService->getProcedureComment($procedureComment->id);
        $this->assertEquals($procedureComment->id, $retrievedProcedureComment->id);
        $this->assertEquals($procedureComment->name, $retrievedProcedureComment->name);
    }

    /**
     * @test update
     */
    public function test_update_procedureComment()
    {
        $procedureComment = ProcedureComment::factory()->create();
        $fakeProcedureComment = ProcedureComment::factory()->make()->toArray();
        $updateProcedureComment = $this->procedureCommentService->updateProcedureComment($fakeProcedureComment, $procedureComment->id);
        $this->assertModelData($fakeProcedureComment, $updateProcedureComment->toArray());
        $this->assertModelExists($updateProcedureComment);
        $dbProcedureComment = $this->procedureCommentService->getProcedureComment($procedureComment->id);
        $this->assertModelData($fakeProcedureComment, $dbProcedureComment->toArray());
        
    }

    /**
     * @test delete
     */
    public function test_delete_procedureComment()
    {
        $procedureComment = ProcedureComment::factory()->create();
        $deleteProcedureComment = $this->procedureCommentService->deleteProcedureComment($procedureComment->id);
        $this->assertTrue($deleteProcedureComment);
        $this->assertSoftDeleted($procedureComment);
        $this->assertNull($this->procedureCommentService->getProcedureComment($procedureComment->id), 'ProcedureComment should not exist in DB');
    }

}