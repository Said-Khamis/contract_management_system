<?php

namespace Database\Factories;

use App\Models\ProcedureComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcedureCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProcedureComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'internal_procedure_id' => $this->faker->word,
        'from_user_id' => $this->faker->word,
        'to_user_id' => $this->faker->word,
        'comment' => $this->faker->text,
        'created_by' => $this->faker->word,
        'updated_by' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
