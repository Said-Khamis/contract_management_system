<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Throwable;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $institution = DB::table('institutions')->select('id')->where('name','like', '%Ministry of Foreign Affairs and East Africa Cooperation%')->first();
            $data['password']=  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password;
            $data['email'] = 'helpdesk.fms@nje.go.tz';
            $data['first_name'] = 'Idrisa';
            $data['middle_name'] = 'Juma';
            $data['last_name'] = 'Ramadhan';
            $data['created_by'] = 1;
            $data['updated_by'] = 1;
            $data['institution_id'] = $institution->id;
            $data['email_verified_at'] = now();
            $data['remember_token'] = Str::random(10);
            User::create([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'email_verified_at' =>$data['email_verified_at'],
                'password' => $data['password'],
                'email' => strtolower($data['email']),
                'remember_token' => $data['remember_token'],
                'created_by' => $data['created_by'],
                'updated_by' => $data['updated_by'],
                'institution_id' => $data['institution_id'],
            ]);

            DB::commit();
        }catch (Throwable $e) {
            report($e);
            DB::rollback();
        }
    }

}
