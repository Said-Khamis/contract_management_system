<?php

namespace Database\Factories;

use App\Models\ContractTermination;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractTerminationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractTermination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'date_of_termination' => $this->faker->date('Y-m-d H:i:s'),
            'reasons' => $this->faker->word,
            'attachment_id' => $this->faker->randomNumber(),
        ];
    }
}
