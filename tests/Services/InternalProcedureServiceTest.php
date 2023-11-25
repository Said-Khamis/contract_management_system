<?php

namespace Tests\Services;

use App\Models\InternalProcedure;
use App\Services\InternalProcedureService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;


Class InternalProcedureServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected InternalProcedureService $internalProcedureService;
    
    /**
     * @var InternalProcedureService
     */
    function setUp(): void
    {
        parent::setUp();
        $this->internalProcedureService = \App::make(InternalProcedureService::class);
    }

    /**
     * @test find
     */
    public function test_find_all()
    {
        $internalProcedure = InternalProcedure::factory()->create();
        $dbInternalProcedure = $this->internalProcedureService->findAll();
        $this->assertCount(1, $dbInternalProcedure);
        $this->assertModelData($internalProcedure->toArray(), $dbInternalProcedure->first()->toArray());
    }

    /**
     * @test create
     */
    public function test_create_internalProcedure()
    {
        $internalProcedure = InternalProcedure::factory()->create()->toArray();
        $dbInternalProcedure = $this->internalProcedureService->createInternalProcedure($internalProcedure);
        $this->assertArrayHasKey('id',$dbInternalProcedure);
        $this->assertNotNull($dbInternalProcedure['id'], 'Created InternalProcedure must have id specified');
        $this->assertModelData($internalProcedure, $dbInternalProcedure->first()->toArray());
    }

    /**
     * @test read
     */
    public function test_show_internalProcedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();
        $retrievedInternalProcedure = $this->internalProcedureService->getInternalProcedure($internalProcedure->id);
        $this->assertEquals($internalProcedure->id, $retrievedInternalProcedure->id);
        $this->assertEquals($internalProcedure->name, $retrievedInternalProcedure->name);
    }

    /**
     * @test update
     */
    public function test_update_internalProcedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();
        $fakeInternalProcedure = InternalProcedure::factory()->make()->toArray();
        $updateInternalProcedure = $this->internalProcedureService->updateInternalProcedure($fakeInternalProcedure, $internalProcedure->id);
        $this->assertModelData($fakeInternalProcedure, $updateInternalProcedure->toArray());
        $this->assertModelExists($updateInternalProcedure);
        $dbInternalProcedure = $this->internalProcedureService->getInternalProcedure($internalProcedure->id);
        $this->assertModelData($fakeInternalProcedure, $dbInternalProcedure->toArray());
        
    }

    /**
     * @test delete
     */
    public function test_delete_internalProcedure()
    {
        $internalProcedure = InternalProcedure::factory()->create();
        $deleteInternalProcedure = $this->internalProcedureService->deleteInternalProcedure($internalProcedure->id);
        $this->assertTrue($deleteInternalProcedure);
        $this->assertSoftDeleted($internalProcedure);
        $this->assertNull($this->internalProcedureService->getInternalProcedure($internalProcedure->id), 'InternalProcedure should not exist in DB');
    }

}