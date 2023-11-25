<?php

namespace Tests\Services;

use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;


Class DepartmentServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected DepartmentService $departmentService;
    
    /**
     * @var DepartmentService
     */
    function setUp(): void
    {
        parent::setUp();
        $this->departmentService = \App::make(DepartmentService::class);
    }

    /**
     * @test find
     */
    public function test_find_all()
    {
        $department = Department::factory()->create();
        $dbDepartment = $this->departmentService->findAll();
        $this->assertCount(1, $dbDepartment);
        $this->assertModelData($department->toArray(), $dbDepartment->first()->toArray());
    }

    /**
     * @test create
     */
    public function test_create_department()
    {
        $department = Department::factory()->create()->toArray();
        $dbDepartment = $this->departmentService->createDepartment($department);
        $this->assertArrayHasKey('id',$dbDepartment);
        $this->assertNotNull($dbDepartment['id'], 'Created Department must have id specified');
        $this->assertModelData($department, $dbDepartment->first()->toArray());
    }

    /**
     * @test read
     */
    public function test_show_department()
    {
        $department = Department::factory()->create();
        $retrievedDepartment = $this->departmentService->getDepartment($department->id);
        $this->assertEquals($department->id, $retrievedDepartment->id);
        $this->assertEquals($department->name, $retrievedDepartment->name);
    }

    /**
     * @test update
     */
    public function test_update_department()
    {
        $department = Department::factory()->create();
        $fakeDepartment = Department::factory()->make()->toArray();
        $updateDepartment = $this->departmentService->updateDepartment($fakeDepartment, $department->id);
        $this->assertModelData($fakeDepartment, $updateDepartment->toArray());
        $this->assertModelExists($updateDepartment);
        $dbDepartment = $this->departmentService->getDepartment($department->id);
        $this->assertModelData($fakeDepartment, $dbDepartment->toArray());
        
    }

    /**
     * @test delete
     */
    public function test_delete_department()
    {
        $department = Department::factory()->create();
        $deleteDepartment = $this->departmentService->deleteDepartment($department->id);
        $this->assertTrue($deleteDepartment);
        $this->assertSoftDeleted($department);
        $this->assertNull($this->departmentService->getDepartment($department->id), 'Department should not exist in DB');
    }

}