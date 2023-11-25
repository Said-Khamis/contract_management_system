<?php

namespace Database\Factories;

use App\Models\ActionPlan;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActionPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'name' => $this->faker->text,
        'complete' => $this->faker->boolean(),
        'status' => $this->faker->text,
        ];
    }
}
