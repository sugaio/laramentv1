<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil Seeder Roles & Permissions terlebih dahulu (Kritis)
        $this->call(RolesAndPermissionsSeeder::class);

        // Panggil Seeder User setelah Roles ada
        $this->call(UserSeeder::class);

        // (Opsional) Gunakan UserFactory jika perlu data dummy
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
