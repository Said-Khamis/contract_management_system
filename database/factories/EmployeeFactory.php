<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => $this->faker->randomDigitNotNull,
        'nin' => $this->faker->word,
        'employment_date' => $this->faker->$this->faker->date('Y-m-d'),
        'duty_station' => $this->faker->city,
        'designation_id' => 1,
        'department_id' => 1,
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
