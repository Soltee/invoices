<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(50)->create();
        \App\Models\Client::factory(80)->create();
        \App\Models\Project::factory(100)->create();
        \App\Models\Invoice::factory(50)->create();
    }
}
