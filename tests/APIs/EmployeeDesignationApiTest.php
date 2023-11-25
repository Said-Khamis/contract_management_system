<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\EmployeeDesignation;

class EmployeeDesignationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_employee_designation()
    {
        $employeeDesignation = EmployeeDesignation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/employee_designations', $employeeDesignation
        );

        $this->assertApiResponse($employeeDesignation);
    }

    /**
     * @test
     */
    public function test_read_employee_designation()
    {
        $employeeDesignation = EmployeeDesignation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/employee_designations/'.$employeeDesignation->id
        );

        $this->assertApiResponse($employeeDesignation->toArray());
    }

    /**
     * @test
     */
    public function test_update_employee_designation()
    {
        $employeeDesignation = EmployeeDesignation::factory()->create();
        $editedEmployeeDesignation = EmployeeDesignation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/employee_designations/'.$employeeDesignation->id,
            $editedEmployeeDesignation
        );

        $this->assertApiResponse($editedEmployeeDesignation);
    }

    /**
     * @test
     */
    public function test_delete_employee_designation()
    {
        $employeeDesignation = EmployeeDesignation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/employee_designations/'.$employeeDesignation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/employee_designations/'.$employeeDesignation->id
        );

        $this->response->assertStatus(404);
    }
}
