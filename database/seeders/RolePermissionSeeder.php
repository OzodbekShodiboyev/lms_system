<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);

        $permissions = [
            // Students
            'view_students',
            'create_students',
            'edit_students',
            'delete_students',

            // Teachers
            'view_teachers',
            'create_teachers',
            'edit_teachers',
            'delete_teachers',

            // Groups
            'view_groups',
            'create_groups',
            'edit_groups',
            'delete_groups',

            // Courses
            'view_courses',
            'create_courses',
            'edit_courses',
            'delete_courses',

            // Payments
            'view_payments',
            'create_payments',
            'edit_payments',
            'delete_payments',

            // System
            'manage_roles',
            'manage_users',
            'view_dashboard',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo([
            'view_students', 'create_students', 'edit_students',
            'view_teachers', 'create_teachers',
            'view_groups', 'create_groups',
            'view_courses',
            'view_payments', 'create_payments',
            'view_dashboard',
        ]);

        $user = User::find(1);
        if ($user) {
            $user->assignRole($superAdmin);
        }
    }
}
