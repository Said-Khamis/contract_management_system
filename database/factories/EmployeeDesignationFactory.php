<?php

namespace Database\Factories;

use App\Models\EmployeeDesignation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeDesignationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeDesignation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'active' => $this->faker->boolean,
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
