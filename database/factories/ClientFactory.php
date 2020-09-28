<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = Arr::random(User::inRandomOrder()->pluck('id')->toArray());
        return [
            'user_id'      => $user,
            'first_name'   => $this->faker->firstName,
            'last_name'    => $this->faker->lastName,
            'email'        => $this->faker->unique()->email,
            'gender'       => function(){
                return Arr::random(['MALE', 'FEMALE', 'OTHERS']);
            }
        ];
    }
}
