<?php

namespace Services;

use App\Models\Designation;
use App\Services\DesignationService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

Class DesignationServiceTest extends TestCase
{
    Use ApiTestTrait, DatabaseTransactions;

    protected DesignationService $designationService;

    function SetUp(): void
    {
        parent::setUp();
        $this->designationService = \App::make(DesignationService::class);
    }

    public function test_find_all()
    {
        //Required that country exist
        $country = Designation::factory()->create();

        //when country are fetched
        $dbCountry = $this->designationService->findAll();
        //test if array fetched has a key
        $this->assertArrayHasKey('id', $country);
        $this->assertNotNull($country['id'], 'Created Country must have id specified');
    }

    public function test_create_designation()
    {
        $designation = Designation::factory()->create()->toArray();
        $dbDesignation = $this->designationService->createDesignation($designation);
        $this->assertArrayHasKey('id', $dbDesignation);
        $this->assertNotNull($dbDesignation['id'], 'Created Designation must have id specified');
        $this->assertModelExists($dbDesignation);
    }

    public function test_show_designatiion()
    {
        $designation = Designation::factory()->create();
        $retrievedDesignation = $this->designationService->getDesignation($designation->id);
        $this->assertEquals($designation->id, $retrievedDesignation->id);
        $this->assertEquals($designation->name, $retrievedDesignation->name);
    }

    public function test_update_designation()
    {
        $designation = Designation::factory()->create();
        $fakeDesignation = Designation::factory()->make()->toArray();
        $updateDesignation = $this->designationService->updateDesignation($fakeDesignation, $designation->id);
        $this->assertModelData($fakeDesignation, $updateDesignation->toArray());
        $dbDesignation = $this->designationService->getDesignation($designation->id);
        $this->assertModelData($fakeDesignation, $dbDesignation->toArray());
    }

    public function test_delete_designation()
    {
        $designation = Designation::factory()->create();
        $deleteDesignation = $this->designationService->deleteDesignation($designation->id);
        $this->assertTrue($deleteDesignation);
        $this->assertSoftDeleted($designation);
        $this->assertNull($this->designationService->getDesignation($designation->id), 'Designation should not exist in DB');
    }
}
