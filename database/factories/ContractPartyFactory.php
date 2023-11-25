<?php

namespace Database\Factories;

use App\Models\ContractParty;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractPartyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractParty::class;

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
            'contract_id' => $this->faker->randomNumber(),
            'is_main' => $this->faker->boolean,
            'is_local' => $this->faker->boolean,
            'partable_id' => $this->faker->randomNumber(),
            'partable_type' => $this->faker->randomNumber(),
            'location_id' => $this->faker->randomNumber(),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber()
        ];
    }
}
