<?php

namespace Database\Factories;

use App\Models\Designation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DesignationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Designation::class;

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
        'title' => $this->faker->word,
        'description' => $this->faker->text,
        'created_by' => $this->faker->randomNumber(),
        'updated_by' =>$this->faker->randomNumber()
        ];
    }
}
