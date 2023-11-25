<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $allInstitutions = config('data.institutions');
        $localInstitutions = $allInstitutions['local'];

        $i = 0;
        foreach($localInstitutions as $institution)
        {
            $i++; //for tanzania
            $name = $institution['name'];
            $abbreviation = $institution['abbreviation'];

            $parent = Institution::firstOrCreate(['name' => $name], [
                'abbreviation' => $abbreviation,
                'is_local' => true,
                'institution_id' => NULL,
            ]);

            if (isset($institution['child'])) {
                foreach ($institution['child'] as $childInstitution)
                {
                    $name = $childInstitution['name'];
                    $abbreviation = $childInstitution['abbreviation'];

                    $model = Institution::firstOrCreate(['name' => $name], [
                        'abbreviation' => $abbreviation,
                        'is_local' => true,
                        'institution_id' => $parent->id,
                    ]);
                }
            }
        }


        $foreignInstitutions = $allInstitutions['foreign'];

        foreach($foreignInstitutions as $institution)
        {
            $name = $institution['name'];
            $abbreviation = $institution['abbreviation'];

            $parent = Institution::firstOrCreate(['name' => $name], [
                'abbreviation' => $abbreviation,
                'is_local' => false,
                'institution_id' => NULL,
            ]);

            if (isset($institution['child'])) {
                foreach ($institution['child'] as $childInstitution)
                {
                    $name = $childInstitution['name'];
                    $abbreviation = $childInstitution['abbreviation'];

                    $model = Institution::firstOrCreate(['name' => $name], [
                        'abbreviation' => $abbreviation,
                        'is_local' => false,
                        'institution_id' => $parent->id,
                    ]);
                }
            }
        }
    }
}
