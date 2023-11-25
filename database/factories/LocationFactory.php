<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\District;
use App\Models\Location;
use App\Models\Region;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

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
        'settlement' => $this->faker->text,
        'ward_id' => $this->faker->word,
        'district_id' => District::factory()->create()->id,
        'city_id' => City::factory()->create()->id,
        'region_id' => Region::factory()->create()->id,
        'state_id' => State::factory()->create()->id,
        'created_by' => $this->faker->randomDigitNotNull,
        'updated_by' => $this->faker->randomDigitNotNull,
        ];
    }
}
