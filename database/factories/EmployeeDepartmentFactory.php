<?php

namespace Database\Factories;

use App\Models\Department;

use App\Models\Designation;

use App\Models\Employee;
use App\Models\EmployeeDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeDepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeDepartment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'department_id' => Department::factory()->create()->id,
        'employee_id' => Employee::factory()->create()->id,
        'created_by' => $this->faker->randomDigit(),
        'updated_by' => $this->faker->randomDigit()
        ];
    }
}
