<?php

namespace Database\Seeders;

use App\Domains\Identity\Database\Seeders\RolesAndPermissionsSeeder;
use App\Domains\Identity\Database\Seeders\UserSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
        ]);
    }
}
