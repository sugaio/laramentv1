<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Role Super Admin (Hak akses penuh)
        Role::create(['name' => 'superadmin']);

        // Role Admin (Bisa mengakses panel, tapi mungkin terbatas)
        Role::create(['name' => 'admin']);

        // Role User (Pengguna biasa, tidak bisa akses panel)
        Role::create(['name' => 'user']);

    }
}
