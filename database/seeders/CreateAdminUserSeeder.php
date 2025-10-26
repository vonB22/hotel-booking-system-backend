<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CreateAdminUserSeeder
     */
    public function run(): void
    {
        // Ensure required roles exist
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        $permissionIds = Permission::pluck('id')->all();
        if (!empty($permissionIds)) {
            $adminRole->syncPermissions($permissionIds);
        }

        $user = User::firstOrNew(['email' => 'admin@gmail.com']);
        $user->name = 'Admin';

        if (empty($user->password)) {
            $user->password = Hash::make('admin123');
        }

        if (empty($user->email_verified_at)) {
            $user->email_verified_at = now();
        }
        $user->save();

        if (! $user->hasRole($adminRole->name)) {
            $user->assignRole($adminRole->name);
        }
    }
}