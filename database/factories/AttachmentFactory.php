<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

        'description' => $this->faker->text,
        'url' => $this->faker->url(),
        'contract_id' => Contract::factory()->create()->id,
        ];
    }
}
