<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(InstitutionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(RegionTableSeeder::class);
//        $this->call(LocationTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(PermissionsListSeeder::class);
        $this->call(SectorsSeeder::class);
    }
}
