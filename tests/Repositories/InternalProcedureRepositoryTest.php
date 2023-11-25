<?php namespace ;

use App\Models\InternalProcedure;
use App\Repositories\InternalProcedureRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InternalProcedureRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InternalProcedureRepository
     */
    protected $internalProcedureRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->internalProcedureRepo = \App::make(InternalProcedureRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_internal_procedure()
    {
        $internalProcedure = InternalProcedure::factory()->make()->toArray();

        $createdInternalProcedure = $this->internalProcedureRepo->create($internalProcedure);

        $createdInternalProcedure = $createdInternalProcedure->toArray();
        $this->assertArrayHasKey('id', $createdInternalProcedure);
        $this->assertNotNull($createdInternalProcedure['id'], 'Created InternalProcedure must have id specified');
        $this->assertNotNull(InternalProcedure::find($createdInternalProcedure['id']), 'InternalProcedure with given id must be in DB');
        $this->assertModelData($internalProcedure, $createdInternalProcedure);
    }

    /**
     * @test read
     */
    public function test_read_internal_procedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();

        $dbInternalProcedure = $this->internalProcedureRepo->find($internalProcedure->id);

        $dbInternalProcedure = $dbInternalProcedure->toArray();
        $this->assertModelData($internalProcedure->toArray(), $dbInternalProcedure);
    }

    /**
     * @test update
     */
    public function test_update_internal_procedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();
        $fakeInternalProcedure = InternalProcedure::factory()->make()->toArray();

        $updatedInternalProcedure = $this->internalProcedureRepo->update($fakeInternalProcedure, $internalProcedure->id);

        $this->assertModelData($fakeInternalProcedure, $updatedInternalProcedure->toArray());
        $dbInternalProcedure = $this->internalProcedureRepo->find($internalProcedure->id);
        $this->assertModelData($fakeInternalProcedure, $dbInternalProcedure->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_internal_procedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();

        $resp = $this->internalProcedureRepo->delete($internalProcedure->id);

        $this->assertTrue($resp);
        $this->assertNull(InternalProcedure::find($internalProcedure->id), 'InternalProcedure should not exist in DB');
    }
}
