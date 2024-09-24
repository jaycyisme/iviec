<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard-access',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'users-list',
            'users-edit',
            'users-delete'
        ];

        $employerPermissions = [
            'employer-access',
            'recruitment-management-list',
            'recruitment-management-create',
            'recruitment-management-edit',
            'recruitment-management-delete',
            'job-new-list',
            'job-new-create',
            'job-new-edit',
            'job-new-delete',
            'candidate-repository-list',
            'candidate-repository-create',
            'candidate-repository-edit',
            'candidate-repository-delete',
            'company-list',
            'company-create',
            'company-edit',
            'company-delete',
        ];

        $candidatePermissions = [
            'candidate-access'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($employerPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($candidatePermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create([
            'name' => 'Quản trị viên'
        ]);
        $role->syncPermissions($permissions);

        $employer_role = Role::create([
            'name' => 'Nhà tuyển dụng'
        ]);
        $employer_role->syncPermissions($employerPermissions);

        $candidate_role = Role::create([
            'name' => 'Ứng viên'
        ]);
        $candidate_role->syncPermissions($candidatePermissions);
    }
}
