<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdateGuardNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::where('guard_name', 'web')->get();

        foreach($permissions as $permission) {
            $permission->guard_name = 'sanctum';
            $permission->save();
        };

        $roles = Role::where('guard_name', 'web')->get();

        foreach($roles as $role) {
            $role->guard_name = 'sanctum';
            $role->save();
        }
    }
}
