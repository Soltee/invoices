<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Invoice;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Client::factory(60)->create();
        Project::factory(100)->create();
        Invoice::factory(150)->create();

        $faker = \Faker\Factory::create();


        $user = User::create([
            'name'               => 'Example',
            'email'              => 'example@gmail.com',
            'password'           => bcrypt('11111111'),
            'email_verified_at'  => now()
        ]);

        for ($i=1; $i <= 30; $i++) { 

            $gender   = Arr::random(['MALE', 'FEMALE', 'OTHERS']);
            $client   = Client::create([
                    'user_id'      => $user->id,
                    'first_name'   => $faker->firstName,
                    'last_name'    => $faker->lastName,
                    'email'        => $faker->unique()->email,
                    'gender'       => $gender
                ]);


            $bool           = Arr::random([true, false]);
            $project        = Project::create([
                    'user_id'       => $user->id,
                    'client_id'     => $client->id,
                    'name'          => $faker->name,
                    'amount'        => $faker->numberBetween(1000, 5000),
                    'is_completed'  => $bool
                ]);


            $genId       = Str::random(11);
            $payment     = Arr::random(['stripe', 'paypal', 'braintree']);
            $due         = Arr::random([
                                now()->addDays(Arr::random([10, 15, 18, 20, 24, 32, 40, 50, 44])),
                                now()->subDays(Arr::random([10, 15, 18, 20, 24, 32, 40, 50, 44]))
                            ]);
            $created     = Arr::random([
                                now(),
                                now()->subDays(Arr::random([10, 15, 18, 20, 24, 32, 40, 50, 44]))
                            ]);

            $amount            = $project->amount;
            $discount          = $faker->numberBetween(0, 400);
            $grand             = $amount + $discount;

            if($bool){
                $feedback      = $faker->sentence(300);
            }

            Invoice::create([
                    'user_id'            => $user->id,
                    'client_id'          => $client->id,
                    'project_id'         => $project->id,
                    'generatedId'        => $genId,
                    'payment_type'       => $payment,
                    'is_paid'            => $bool,
                    'is_sent'            => $bool,
                    'due'                => $due,
                    'feedback'           => $feedback ?? '',
                    'sub_total'          => $amount,
                    'discount'           => $discount,
                    'grand_total'        => $grand,
                    'created_at'         => $created
                ]);

        }


    }
}
