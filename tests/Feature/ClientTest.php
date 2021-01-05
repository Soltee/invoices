<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoggedInUserCanCreateAClient()
    {
        // $this->without
        //A USer
        $user = User::factory()->create();

        //Client
        $client  = [
                'user_id'     => $user->id,
                'first_name'  => 'Helina',
                'last_name'   => 'ryo',
                'email'       => 'helina@gmail.com',
                'gender'      => 'FEMALE',
            ];

        //Project    
        $project = [
                'project_name'    => 'TestProject',
                'amount'           => 2000
            ];

        //POst to /clients with  first_name, last_name, email, gender
        $response = $this->actingAs($user)->post('/clients', array_merge($client, $project));

        //Database - A CLient and a project of it.
        $this->assertDatabaseCount('clients', 1);
        $this->assertDatabaseHas('clients', [
            'user_id'          => $user->id,
            'first_name'  => 'Helina',
            'last_name'   => 'ryo',
            'email'       => 'helina@gmail.com',
            'gender'      => 'FEMALE',
        ]);

        $this->assertDatabaseCount('projects', 1);
        $this->assertDatabaseHas('projects', [
            'user_id'          => $user->id,
            'client_id'        => 1,
            'name'             => 'TestProject',
            'amount'           => 2000
        ]);

    }



    /**
     * 
        @test
     */
    public function notLoggedInUserReturnUnauthenticatedWhenCreateingAClient()
    {
        // Data - client & project details
        //Client
        $client  = [
                'first_name'  => 'Helina',
                'last_name'   => 'ryo',
                'email'       => 'helina@gmail.com',
                'gender'      => 'FEMALE',
            ];

        //Project    
        $project = [
                'project_name'    => 'TestProject',
                'amount'           => 2000
            ];

        //POst to /clients with  first_name, last_name, email, gender
        $response = $this->post('/clients', array_merge($client, $project));

        //Return 401 Unauthenticated Error
        $response->assertStatus(302);

        //Database Assert to 0 in clients & projects table
        $this->assertDatabaseCount('clients', 0);
        $this->assertDatabaseCount('projects', 0);

    }

}
