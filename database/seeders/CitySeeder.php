<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->delete();

        DB::table('cities')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Dodoma',
                'country_id' => 216,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Dar es Salaam',
                'country_id' => 216,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Mwanza',
                'country_id' => 216,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Mbeya',
                'country_id' => 216,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Tanga',
                'country_id' => 216,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Nairobi',
                'country_id' => 113,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Mombasa',
                'country_id' => 113,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Kisumu',
                'country_id' => 113,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Kampala',
                'country_id' => 227,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Mbarara',
                'country_id' => 227,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Jinja',
                'country_id' => 227,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Kigali',
                'country_id' => 182,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Muhanga',
                'country_id' => 182,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Bujumbura',
                'country_id' => 35,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Gitega',
                'country_id' => 35,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Muyinga',
                'country_id' => 35,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Ngozi',
                'country_id' => 35,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'Blantyre',
                'country_id' => 131,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'Lilongwe',
                'country_id' => 131,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'Lusaka',
                'country_id' => 245,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'Kitwe',
                'country_id' => 245,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Harare',
                'country_id' => 246,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'Bulawayo',
                'country_id' => 246,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'Kinshasa',
                'country_id' => 49,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'Kisangani',
                'country_id' => 49,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'Maputo',
                'country_id' => 149,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'Nampula',
                'country_id' => 149,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'Beira',
                'country_id' => 149,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'Pretoria',
                'country_id' => 202,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            29 =>
            array (
                'id' => 30,
                'name' => 'Johannesburg',
                'country_id' => 202,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            30 =>
            array (
                'id' => 31,
                'name' => 'Durban',
                'country_id' => 165,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            31 =>
            array (
                'id' => 32,
                'name' => 'Dubai',
                'country_id' => 165,
                'created_by' => 1,
                'updated_by' => 1,
            ),
            32 =>
            array (
                'id' => 33,
                'name' => 'Cape Town',
                'country_id' => 202,
                'created_by' => 1,
                'updated_by' => 1,
            ),

        ));
    }
}
