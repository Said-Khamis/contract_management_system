<?php

namespace Database\Factories;

use App\Models\InternalProcedure;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternalProcedureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InternalProcedure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'procedurable_type' => $this->faker->word,
        'procedurable_id' => $this->faker->word,
        'from_institution_id' => $this->faker->word,
        'to_institution_id' => $this->faker->word,
        'status' => $this->faker->text,
        'created_by' => $this->faker->word,
        'updated_by' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
