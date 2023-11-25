<?php

namespace Services;

use App\Models\Institution;
use App\Services\InstitutionService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

Class InstitutionServiceTest extends TestCase
{
use ApiTestTrait, DatabaseTransactions;
protected InstitutionService $institutionService;

function setUp(): void
{
    parent::setUp();
    $this->institutionService = \App::make(InstitutionService::class);
}

public function test_find_all()
{
    $institution = Institution::factory()->create();

    $dbInstitution = $this->institutionService->findAll();

    $this->expectsDatabaseQueryCount(1);
    $this->assertDatabaseCount('institutions', 6);
}

public function test_create_institution()
{
    $institution = Institution::factory()->create()->toArray();
    $dbInstitution = $this->institutionService->createInstitution($institution);
    $this->assertArrayHasKey('id',$dbInstitution);
    $this->assertNotNull($dbInstitution['id'], 'Created Institution must have id specified');
    $this->assertModelExists($dbInstitution);
}

public function test_show_institution()
{
    $institution = Institution::factory()->create();
    $retrievedInstitution = $this->institutionService->getInstitution($institution->id);
    $this->assertEquals($institution->id, $retrievedInstitution->id);
    $this->assertEquals($institution->name, $retrievedInstitution->name);
}

public function test_update_institution()
{
    $institution = Institution::factory()->create();
    $fakeInstitution = Institution::factory()->make()->toArray();
    $updateInstitution = $this->institutionService->updateInstitution($fakeInstitution, $institution->id);
    $this->assertModelExists($updateInstitution);
    $dbInstitution = $this->institutionService->getInstitution($institution->id);
    $this->assertModelExists($dbInstitution);
}

    /**
     * @throws \Throwable
     */
    public function test_delete_institution()
{
    $institution = Institution::factory()->create();
    $response = $this->institutionService->deleteInstitution($institution->id);
    $this->assertTrue($response);
    $this->assertSoftDeleted($institution);
}

}
