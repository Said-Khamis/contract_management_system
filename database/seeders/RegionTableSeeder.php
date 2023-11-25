<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'id' => 1,
                'country_id'=> 216,
                'name' => 'Arusha',
                'created_by' => 1,
                'updated_by' => 1,

            ],

            [
                'id' => 2,
                'country_id'=> 216,
                'name' => 'Dar-es-salaam',
                'created_by' => 1,
                'updated_by' => 1,

            ],

            [
                'id' => 3,
                'country_id'=>216,
                'name' => 'Dodoma',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 4,
                'country_id'=>216,
                'name' => 'Geita',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 5,
                'country_id'=>216,
                'name' => 'Iringa',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 6,
                'country_id'=>216,
                'name' => 'Kagera',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 7,
                'country_id'=>216,
                'name' => 'Kaskazini Pemba',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 8,
                'country_id'=>216,
                'name' => 'Kaskazini Unguja',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 9,
                'country_id'=>216,
                'name' => 'Katavi',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 10,
                'country_id'=>216,
                'name' => 'Kigoma',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 11,
                'country_id'=>216,
                'name' => 'Kilimanjaro',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 12,
                'country_id'=>216,
                'name' => 'Kusini Pemba',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 13,
                'country_id'=>216,
                'name' => 'Kusini Unguja',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 14,
                'country_id'=>216,
                'name' => 'Lindi',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 15,
                'country_id'=>216,
                'name' => 'Manyara',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 16,
                'country_id'=>216,
                'name' => 'Mara',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 17,
                'country_id'=>216,
                'name' => 'Mbeya',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 18,
                'country_id'=>216,
                'name' => 'Mjini Magharibi',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 19,
                'country_id'=>216,
                'name' => 'Morogoro',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 20,
                'country_id'=>216,
                'name' => 'Mtwara',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 21,
                'country_id'=>216,
                'name' => 'Mwanza',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 22,
                'country_id'=>216,
                'name' => 'Njombe',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 23,
                'country_id'=>216,
                'name' => 'Pwani',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 24,
                'country_id'=>216,
                'name' => 'Rukwa',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 25,
                'country_id'=>216,
                'name' => 'Ruvuma',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 26,
                'country_id'=>216,
                'name' => 'Shinyanga',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 27,
                'country_id'=>216,
                'name' => 'Simiyu',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 28,
                'country_id'=>216,
                'name' => 'Singida',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 29,
                'country_id'=>216,
                'name' => 'Songwe',
                'created_by' => 1,
                'updated_by' => 1,

            ],
            [
                'id' => 30,
                'country_id'=>216 ,
                'name' => 'Tabora',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => 31,
                'country_id'=>216,
                'name' => 'Tanga',
                'created_by' => 1,
                'updated_by' => 1,

            ],


        ];

        Region::insert($regions);
    }
}
