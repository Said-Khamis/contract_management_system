<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistrictFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = District::class;

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
        'name' => $this->faker->word,
        'created_by' => $this->faker->randomDigit(),
        'updated_by' => $this->faker->randomDigit(),
        'region_id' => Region::factory()->create([
                'country_id'=>Country::factory()->create()->id,]
        )->id,
        ];
    }
}
