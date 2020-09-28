<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user     = Arr::random(User::inRandomOrder()->pluck('id')->toArray());
        $client   = Arr::random(Client::inRandomOrder()->pluck('id')->toArray());
        $project  = Arr::random(Project::inRandomOrder()->pluck('id')->toArray());

        $project_for_price = Project::findOrfail($project);
        $price             = $project_for_price->price;
        $discount          = $this->faker->numberBetween(0, 400);
        $grand             = $price + $discount;
        return [
            'user_id'              => $user,
            'client_id'            => $client,
            'project_id'           => $project,
            'generatedId'          => function(){ 
                return Str::random(11);
            },
            'payment_type'         => function(){ 
                return Arr::random(['stripe', 'paypal', 'braintree']);
            },
            'is_paid'              => function(){ 
                return Arr::random([true, false]);
            },
            'due'                  => function(){
                return Arr::random([
                        now()->addDays(Arr::random([10, 15, 18, 20, 24, 32, 40, 50, 44])),
                        now()->subDays(Arr::random([10, 15, 18, 20, 24, 32, 40, 50, 44]))
                    ]);
            },
            'sub_total'            => $price,
            'discount'             => $discount,
            'grand_total'          => $grand,
            'created_at'           => function(){
                return Arr::random([
                        now(),
                        now()->subDays(Arr::random([10, 15, 18, 20, 24, 32, 40, 50, 44]))
                    ]);
            },
        ];
    }
}
