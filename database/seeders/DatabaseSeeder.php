<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Esto le dice a Laravel que ejecute el otro archivo que creamos
        $this->call(RoleSeeder::class);
    }
}
