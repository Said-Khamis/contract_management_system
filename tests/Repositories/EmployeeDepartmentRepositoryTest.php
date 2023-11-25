<?php namespace Tests\Repositories;

use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Repositories\DesignationRepository;
use App\Repositories\EmployeeDepartmentRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EmployeeDepartmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmployeeDepartmentRepository
     */
    protected EmployeeDepartmentRepository $employeeDepartmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->employeeDepartmentRepo = \App::make(EmployeeDepartmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_employee_department()
    {
        $employeeDepartment = EmployeeDepartment::factory()->make()->toArray();

        $createdEmployeeDepartment = $this->employeeDepartmentRepo->create($employeeDepartment);

        $createdEmployeeDepartment = $createdEmployeeDepartment->toArray();
        $this->assertArrayHasKey('id', $createdEmployeeDepartment);
        $this->assertNotNull($createdEmployeeDepartment['id'], 'Created EmployeeDepartment must have id specified');
        $this->assertNotNull(EmployeeDepartment::find($createdEmployeeDepartment['id']), 'EmployeeDepartment with given id must be in DB');
        $this->assertModelExists($this->employeeDepartmentRepo->create($employeeDepartment));
    }

    /**
     * @test read
     */
    public function test_read_employee_department()
    {
        $employeeDepartment = EmployeeDepartment::factory()->create();

        $dbEmployeeDepartment = $this->employeeDepartmentRepo->find($employeeDepartment->id);

        $dbEmployeeDepartment = $dbEmployeeDepartment->toArray();
        $this->assertModelData($employeeDepartment->toArray(), $dbEmployeeDepartment);
    }

    /**
     * @test update
     */
    public function test_update_employee_department()
    {
        $employeeDepartment = EmployeeDepartment::factory()->create();
        $fakeEmployeeDepartment = EmployeeDepartment::factory()->make()->toArray();

        $updatedEmployeeDepartment = $this->employeeDepartmentRepo->update($fakeEmployeeDepartment, $employeeDepartment->id);

        $this->assertModelData($fakeEmployeeDepartment, $updatedEmployeeDepartment->toArray());
        $dbEmployeeDepartment = $this->employeeDepartmentRepo->find($employeeDepartment->id);
        $this->assertModelData($fakeEmployeeDepartment, $dbEmployeeDepartment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_employee_department()
    {
        $employeeDepartment = EmployeeDepartment::factory()->create();

        $resp = $this->employeeDepartmentRepo->delete($employeeDepartment->id);

        $this->assertTrue($resp);
        $this->assertNull(EmployeeDepartment::find($employeeDepartment->id), 'EmployeeDepartment should not exist in DB');
    }
}
