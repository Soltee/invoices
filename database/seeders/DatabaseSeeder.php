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
        \App\Models\User::factory(40)->create();
        \App\Models\User::create([
        	'name'               => 'Example',
        	'email'              => 'example@gmail.com',
        	'password'           => bcrypt('11111111'),
        	'email_verified_at'  => now()
        ]);
        \App\Models\Client::factory(200)->create();
        \App\Models\Project::factory(300)->create();
        \App\Models\Invoice::factory(200)->create();
    }
}
