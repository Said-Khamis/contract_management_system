<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            //United States
            ['id' => 1, 'country_id' => 231, 'name' => 'Alabama', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 2, 'country_id' => 231, 'name' => 'Alaska', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 3, 'country_id' => 231, 'name' => 'Arizona', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 4, 'country_id' => 231, 'name' => 'Arkansas', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 5, 'country_id' => 231, 'name' => 'California', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 6, 'country_id' => 231, 'name' => 'Colorado', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 7, 'country_id' => 231, 'name' => 'Connecticut', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 8, 'country_id' => 231, 'name' => 'Delaware', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 9, 'country_id' => 231, 'name' => 'Florida', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 10, 'country_id' => 231, 'name' => 'Georgia', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 11, 'country_id' => 231, 'name' => 'Hawaii', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 12, 'country_id' => 231, 'name' => 'Idaho', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 13, 'country_id' => 231, 'name' => 'Illinois', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 14, 'country_id' => 231, 'name' => 'Indiana', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 15, 'country_id' => 231, 'name' => 'Iowa', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 16, 'country_id' => 231, 'name' => 'Kansas', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 17, 'country_id' => 231, 'name' => 'Kentucky', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 18, 'country_id' => 231, 'name' => 'Louisiana', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 19, 'country_id' => 231, 'name' => 'Maine', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 20, 'country_id' => 231, 'name' => 'Maryland', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 21, 'country_id' => 231, 'name' => 'Massachusetts', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 22, 'country_id' => 231, 'name' => 'Michigan', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 23, 'country_id' => 231, 'name' => 'Minnesota', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 24, 'country_id' => 231, 'name' => 'Mississippi', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 25, 'country_id' => 231, 'name' => 'Missouri', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 26, 'country_id' => 231, 'name' => 'Montana', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 27, 'country_id' => 231, 'name' => 'Nebraska', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 28, 'country_id' => 231, 'name' => 'Nevada', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 29, 'country_id' => 231, 'name' => 'New Hampshire', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 30, 'country_id' => 231, 'name' => 'New Jersey', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 31, 'country_id' => 231, 'name' => 'New Mexico', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 32, 'country_id' => 231, 'name' => 'New York', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 33, 'country_id' => 231, 'name' => 'North Carolina', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 34, 'country_id' => 231, 'name' => 'North Dakota', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 35, 'country_id' => 231, 'name' => 'Ohio', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 36, 'country_id' => 231, 'name' => 'Oklahoma', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 37, 'country_id' => 231, 'name' => 'Oregon', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 38, 'country_id' => 231, 'name' => 'Pennsylvania', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 39, 'country_id' => 231, 'name' => 'Rhode Island', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 40, 'country_id' => 231, 'name' => 'South Carolina', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 41, 'country_id' => 231, 'name' => 'South Dakota', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 42, 'country_id' => 231, 'name' => 'Tennessee', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 43, 'country_id' => 231, 'name' => 'Texas', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 44, 'country_id' => 231, 'name' => 'Utah', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 45, 'country_id' => 231, 'name' => 'Vermont', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 46, 'country_id' => 231, 'name' => 'Virginia', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 47, 'country_id' => 231, 'name' => 'Washington', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 48, 'country_id' => 231, 'name' => 'West Virginia', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 49, 'country_id' => 231, 'name' => 'Wisconsin', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 50, 'country_id' => 231, 'name' => 'Wyoming', 'created_by' => 1, 'updated_by' => 1],

          //India
            ['id' => 51, 'country_id'=>101, 'name' => 'Andhra Pradesh', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 52, 'country_id'=>101 , 'name' => 'Arunachal Pradesh ', 'created_by' => 1, 'updated_by' => 1,],
            ['id' => 53, 'country_id'=>101, 'name' => 'Assam', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 54, 'country_id'=>101, 'name' => 'Bihar', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 55, 'country_id'=>101, 'name' => 'Chhattisgarh', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 56, 'country_id'=>101, 'name' => 'Goa', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 57, 'country_id'=>101, 'name' => 'Gujarat', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 58, 'country_id'=>101, 'name' => 'Haryana', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 59, 'country_id'=>101, 'name' => 'Himachal Pradesh', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 60, 'country_id'=>101, 'name' => 'Jharkhand', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 61, 'country_id'=>101, 'name' => 'Karnataka', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 62, 'country_id'=>101, 'name' => 'Kerala ', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 63, 'country_id'=>101, 'name' => 'Madhya Pradesh', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 64, 'country_id'=>101, 'name' => 'Maharashtra', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 65, 'country_id'=>101, 'name' => 'Manipur', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 66, 'country_id'=>101, 'name' => 'Meghalaya', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 67, 'country_id'=>101, 'name' => 'Mizoram', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 68, 'country_id'=>101, 'name' => 'Nagaland', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 69, 'country_id'=>101, 'name' => 'Odisha', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 70, 'country_id'=>101, 'name' => 'Punjab', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 71, 'country_id'=>101, 'name' => 'Rajasthan', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 72, 'country_id'=>101, 'name' => 'Sikkim', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 73, 'country_id'=>101, 'name' => 'Tamil Nadu', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 74, 'country_id'=>101, 'name' => 'Telangana ', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 75, 'country_id'=>101, 'name' => 'Tripura ', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 76, 'country_id'=>101, 'name' => 'Uttar Pradesh', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 77, 'country_id'=>101, 'name' => 'Uttarakhand', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 78, 'country_id'=>101, 'name' => 'West Bengal ', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 79, 'country_id'=>101, 'name' => ' Andaman and Nicobar Islands ', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 80, 'country_id'=>101, 'name' => 'Chandigarh', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 81, 'country_id'=>101, 'name' => 'Dadra and Nagar Haveli and Daman and Diu (DNHDD)', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 82, 'country_id'=>101, 'name' => 'Delhi', 'created_by' => 1, 'updated_by' => 1,],
            ['id' => 83, 'country_id'=>101, 'name' => 'Jammu and Kashmir ', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 84, 'country_id'=>101, 'name' => 'Ladakh ', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 85, 'country_id'=>101, 'name' => 'Lakshadweep', 'created_by' => 1, 'updated_by' => 1],
            ['id' => 86, 'country_id'=>101, 'name' => 'Puducherry', 'created_by' => 1, 'updated_by' => 1],


          ];
        State::insert($states);

    }
}
