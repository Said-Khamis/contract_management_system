<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = config('data.countries');
        $countryCodes = ['tz','ke','ug','rw','bi','zm','mw','zm','cd','mz','za'];
        $counter = 0;
        foreach ($countries as $country => $countryData) {
            $countryModel = Country::create([
                'name' => $country,
                'code' => $countryCodes[$counter]]
            );

            if (isset($countryData['regions'])) {
                foreach ($countryData['regions'] as $region => $regionData) {
                    $regionModel = new Region(['name' => $region]);
                    $countryModel->regions()->save($regionModel);

                    if (isset($regionData['districts'])) {
                        foreach ($regionData['districts'] as $districtName => $district) {
                            $districtModel = new District(['name' => $districtName]);
                            $regionModel->districts()->save($districtModel);

                            if (isset($district['wards'])) {
                                foreach ($district['wards'] as $ward) {
                                    $wardModel = new Ward(['name' => $ward]);
                                    $districtModel->wards()->save($wardModel);
                                }
                            }
                        }
                    }
                }
            }
            $counter++;
        }
    }
}
