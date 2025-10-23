<?php

namespace App\Domains\Identity\Database\Seeders;

use App\Domains\Identity\Models\User;
use App\Domains\Tenancy\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default organization
        $organization = Organization::create([
            'name' => 'Default Organization',
            'is_active' => true,
        ]);

        // Create Superadmin
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@larament.test',
            'password' => Hash::make('password88'),
            'organization_id' => $organization->id,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $superadmin->assignRole('superadmin');

        // Create Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@larament.test',
            'password' => Hash::make('password66'),
            'organization_id' => $organization->id,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $admin->assignRole('admin');

        // Create User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@larament.test',
            'password' => Hash::make('password33'),
            'organization_id' => $organization->id,
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $user->assignRole('user');
    }
}
