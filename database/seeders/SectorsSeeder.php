<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectors = config('data.sectors');
        foreach ($sectors as $sector ){
           Sector::create($sector);
        }
    }
}
