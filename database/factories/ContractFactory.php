<?php

namespace Database\Factories;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

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
            'auto_renewal' => $this->faker->boolean(),
            'title' => $this->faker->word,
            'reference_no' => $this->faker->word,
            'signed_at' => $this->faker->date('Y-m-d H:i:s'),
            'signed_place' => $this->faker->randomNumber(),
            'ratification_at' => $this->faker->date('Y-m-d H:i:s'),
            'duration' => $this->faker->randomDigitNotNull,
            'amended' => $this->faker->boolean,
            'start_date' => $this->faker->date('Y-m-d H:i:s'),
            'end_date' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
