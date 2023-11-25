<?php namespace ;

use App\Models\ProcedureComment;
use App\Repositories\ProcedureCommentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProcedureCommentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProcedureCommentRepository
     */
    protected $procedureCommentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->procedureCommentRepo = \App::make(ProcedureCommentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_procedure_comment()
    {
        $procedureComment = ProcedureComment::factory()->make()->toArray();

        $createdProcedureComment = $this->procedureCommentRepo->create($procedureComment);

        $createdProcedureComment = $createdProcedureComment->toArray();
        $this->assertArrayHasKey('id', $createdProcedureComment);
        $this->assertNotNull($createdProcedureComment['id'], 'Created ProcedureComment must have id specified');
        $this->assertNotNull(ProcedureComment::find($createdProcedureComment['id']), 'ProcedureComment with given id must be in DB');
        $this->assertModelData($procedureComment, $createdProcedureComment);
    }

    /**
     * @test read
     */
    public function test_read_procedure_comment()
    {
        $procedureComment = ProcedureComment::factory()->create();

        $dbProcedureComment = $this->procedureCommentRepo->find($procedureComment->id);

        $dbProcedureComment = $dbProcedureComment->toArray();
        $this->assertModelData($procedureComment->toArray(), $dbProcedureComment);
    }

    /**
     * @test update
     */
    public function test_update_procedure_comment()
    {
        $procedureComment = ProcedureComment::factory()->create();
        $fakeProcedureComment = ProcedureComment::factory()->make()->toArray();

        $updatedProcedureComment = $this->procedureCommentRepo->update($fakeProcedureComment, $procedureComment->id);

        $this->assertModelData($fakeProcedureComment, $updatedProcedureComment->toArray());
        $dbProcedureComment = $this->procedureCommentRepo->find($procedureComment->id);
        $this->assertModelData($fakeProcedureComment, $dbProcedureComment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_procedure_comment()
    {
        $procedureComment = ProcedureComment::factory()->create();

        $resp = $this->procedureCommentRepo->delete($procedureComment->id);

        $this->assertTrue($resp);
        $this->assertNull(ProcedureComment::find($procedureComment->id), 'ProcedureComment should not exist in DB');
    }
}
