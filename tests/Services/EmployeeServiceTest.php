<?php

namespace Tests\Services;

use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;


Class EmployeeServiceTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;
    protected EmployeeService $employeeService;
    
    /**
     * @var EmployeeService
     */
    function setUp(): void
    {
        parent::setUp();
        $this->employeeService = \App::make(EmployeeService::class);
    }

    /**
     * @test find
     */
    public function test_find_all()
    {
        $employee = Employee::factory()->create();
        $dbEmployee = $this->employeeService->findAll();
        $this->assertCount(1, $dbEmployee);
        $this->assertModelData($employee->toArray(), $dbEmployee->first()->toArray());
    }

    /**
     * @test create
     */
    public function test_create_employee()
    {
        $employee = Employee::factory()->create()->toArray();
        $dbEmployee = $this->employeeService->createEmployee($employee);
        $this->assertArrayHasKey('id',$dbEmployee);
        $this->assertNotNull($dbEmployee['id'], 'Created Employee must have id specified');
        $this->assertModelData($employee, $dbEmployee->first()->toArray());
    }

    /**
     * @test read
     */
    public function test_show_employee()
    {
        $employee = Employee::factory()->create();
        $retrievedEmployee = $this->employeeService->getEmployee($employee->id);
        $this->assertEquals($employee->id, $retrievedEmployee->id);
        $this->assertEquals($employee->name, $retrievedEmployee->name);
    }

    /**
     * @test update
     */
    public function test_update_employee()
    {
        $employee = Employee::factory()->create();
        $fakeEmployee = Employee::factory()->make()->toArray();
        $updateEmployee = $this->employeeService->updateEmployee($fakeEmployee, $employee->id);
        $this->assertModelData($fakeEmployee, $updateEmployee->toArray());
        $this->assertModelExists($updateEmployee);
        $dbEmployee = $this->employeeService->getEmployee($employee->id);
        $this->assertModelData($fakeEmployee, $dbEmployee->toArray());
        
    }

    /**
     * @test delete
     */
    public function test_delete_employee()
    {
        $employee = Employee::factory()->create();
        $deleteEmployee = $this->employeeService->deleteEmployee($employee->id);
        $this->assertTrue($deleteEmployee);
        $this->assertSoftDeleted($employee);
        $this->assertNull($this->employeeService->getEmployee($employee->id), 'Employee should not exist in DB');
    }

}