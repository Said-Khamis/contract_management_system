<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $permission_groups = config('data.permissions');

        $user = User::find(1);
        $super_admin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $user->assignRole($super_admin);

        // create permissions
        foreach ($permission_groups as $group => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission, 'group' => $group]);
            }
            $admin->givePermissionTo($permissions);
        }
    }
}
