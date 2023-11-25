<?php

namespace Database\Factories;

use App\Models\ContractOperationArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractOperationAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractOperationArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'details' => $this->faker->word,
            'area' => $this->faker->word,
        ];
    }
}
