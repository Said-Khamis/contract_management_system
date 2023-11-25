<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = config('data.categories');

        foreach ($categoryData as $category => $childCategory){
            $dbCategory = Category::create(['name' => ucfirst($category)]);
            if(isset($childCategory)){
                foreach ($childCategory as $value){
                    Category::create(['name' => ucfirst($value), 'category_id' => $dbCategory->id]);
                }
            }
        }
    }
}
