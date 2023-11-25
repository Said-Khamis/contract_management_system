<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;

class WardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ward::class;

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
        'district_id' => District::factory()->create([
            'region_id'=>Region::factory()->create([
                'country_id'=>Country::factory()->create()->id,
            ])->id,
        ])->id,
        'created_by' => $this->faker->randomDigit(),
        'updated_by' => $this->faker->randomDigit()
        ];
    }
}
