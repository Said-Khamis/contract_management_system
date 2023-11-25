<?php

namespace Database\Factories;

use App\Models\Amendment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AmendmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Amendment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'date_of_amendment' => $this->faker->date('Y-m-d H:i:s'),
            'reasons' => $this->faker->word,
            'attachment_id' => $this->faker->randomNumber(),
        ];
    }
}
