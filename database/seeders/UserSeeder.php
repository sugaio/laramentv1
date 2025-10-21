<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@larament.test',
            'password' => Hash::make('password88'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Tetapkan role 'superadmin' ke user ini
        // Role ini harus sudah dibuat oleh RolesAndPermissionsSeeder
        $superadmin->assignRole('superadmin');


        // (Opsional) Buat user 'admin'
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@larament.test',
            'password' => Hash::make('password66'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');


        // (Opsional) Buat user 'user' biasa
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@larament.test',
            'password' => Hash::make('password33'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('user');
    }
}
