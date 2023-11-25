<?php

namespace Database\Factories;

use App\Models\ContractResponsibility;
use App\Models\ContractResponsibilityStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractResponsibilityStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractResponsibilityStatus::class;

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
            'contract_responsibility_id' => ContractResponsibility::factory()->create()->id,
            'status' => $this->faker->randomDigitNotNull,
            'comment' => $this->faker->word,
            'status_updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber()
        ];
    }
}
