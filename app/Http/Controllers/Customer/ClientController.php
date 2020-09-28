<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Auth;

use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Clients/Index', [
            'search'    => request()->search,
            'clients'   => Auth::user()->clients()
                            ->withCount('projects')
                            ->withCount('invoices')
                            // ->orderByName()
                            ->filter(request()->only('search'))
                            ->paginate(2)
                            ->transform(function ($client) {
                                return [
                                    'id'        => $client->id,
                                    'name'      => $client->first_name . ' ' . $client->last_name,
                                    'email'     => $client->email,
                                    'projects'  => $client->projects_count,
                                    'invoices'   => $client->invoices_count,
                                    'created'   => $client->created_at
                                ];
                            }),
                // 'create_url' => URL::route('users.create'),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	// dd($request->all());
    	$data = $request->validate([
    			'first_name'       => 'required|string|min:3|unique:clients',
    			'last_name'        => 'required|string|min:3',
    			'email'            => 'required|string|email|unique:clients',
    			'gender'           => 'required|string',
    			'project_name'     => 'required|string|min:3',
    			'amount'           => 'required|numeric',
    		]);


    	//Create a client;
    	$client   = new Client();
    	$client->user_id         = Auth::user()->id;
    	$client->first_name      = $data['first_name'];
    	$client->last_name       = $data['last_name'];
    	$client->email           = $data['email'];
    	$client->gender          = $data['gender'];
    	$client->save();

    	//Create Project
    	$client->projects()->create([
    			'user_id'            => Auth::user()->id,
    			'name'       => $data['project_name'],
    			'amount'             => $data['amount']
    		]);

    	return redirect()->route('client.create')->with('success', 'Client added to the list.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
