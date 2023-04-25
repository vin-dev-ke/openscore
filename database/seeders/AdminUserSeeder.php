<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::create([
            'name' => 'Admin',
            'email' => 'adminuser@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('adminuser@admin.com'),
        ]);

        $role = Role::firstOrCreate(['name'=>'admin']);
        $role->givePermissionTo(Permission::all());
        $user->assignRole($role->name);
    }
}
