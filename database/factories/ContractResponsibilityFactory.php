<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\ContractParty;
use App\Models\ContractResponsibility;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractResponsibilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractResponsibility::class;

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
            'details' => $this->faker->word,
            'contract_id' => Contract::factory()->create()->id,
            'contract_party_id' => ContractParty::factory()->create()->id,
            'start_time' => $this->faker->date('Y-m-d H:i:s'),
            'end_time' => $this->faker->date('Y-m-d H:i:s'),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber()
        ];
    }
}
