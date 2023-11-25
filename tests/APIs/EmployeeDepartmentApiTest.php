<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\EmployeeDepartment;

class EmployeeDepartmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_employee_department()
    {
        $employeeDepartment = EmployeeDepartment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/employee_departments', $employeeDepartment
        );

        $this->assertApiResponse($employeeDepartment);
    }

    /**
     * @test
     */
    public function test_read_employee_department()
    {
        $employeeDepartment = EmployeeDepartment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/employee_departments/'.$employeeDepartment->id
        );

        $this->assertApiResponse($employeeDepartment->toArray());
    }

    /**
     * @test
     */
    public function test_update_employee_department()
    {
        $employeeDepartment = EmployeeDepartment::factory()->create();
        $editedEmployeeDepartment = EmployeeDepartment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/employee_departments/'.$employeeDepartment->id,
            $editedEmployeeDepartment
        );

        $this->assertApiResponse($editedEmployeeDepartment);
    }

    /**
     * @test
     */
    public function test_delete_employee_department()
    {
        $employeeDepartment = EmployeeDepartment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/employee_departments/'.$employeeDepartment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/employee_departments/'.$employeeDepartment->id
        );

        $this->response->assertStatus(404);
    }
}
