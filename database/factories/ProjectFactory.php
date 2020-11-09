<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user    = Arr::random(User::inRandomOrder()->pluck('id')->toArray());
        $client  = Arr::random(Client::inRandomOrder()->pluck('id')->toArray());
        return [
            'user_id'       => $user,
            'client_id'     => $client,
            'name'          => $this->faker->name,
            'description'   => $this->faker->sentence(100),
            'amount'        => $this->faker->numberBetween(1000, 5000),
            'is_completed'  => function(){
                return Arr::random([true, false]);
            }
        ];
    }
}
