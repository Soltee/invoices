<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Auth;

use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a list of projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Projects/Index', [
            'search'     => request()->search,
            'filter'     => request()->filter,
            'projects'   => Auth::user()->projects()
                            ->with('client')
                            ->withCount('invoices')
                            ->filter(request()->only('search', 'filter'))
                            ->paginate(10)
                            ->transform(function ($client) {
                                return [
                                    'id'              => $client->id,
                                    'name'            => $client->name,
                                    'is_completed'    => $client->is_completed,
                                    'amount'          => $client->amount,
                                    'invoices'        => $client->invoices_count,
                                    'created'         => $client->created_at
                                ];
                            }),
            ]);
    }

    /**
     * Return client's projects to client show inertia view.
     */
    public function client_projects(Client $client)
    {
        // echo ($client->id);
        $search  = request()->keyword;
        $query   = $client->projects()->latest();

        if($search){
            $query  = $query->where('name', 'LIKE', '%'.$search.'%');
        }

        return $query->paginate(5);
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
    			'client'           => 'required|numeric',
    			'project_name'     => 'required|string|min:3|unique:projects',
    			'amount'           => 'required|numeric',
    		]);

    	// dd($data);
    	$client = Client::findOrfail($data['client']);

    	//Create Project
    	$client->projects()->create([
    			'user_id'            => Auth::user()->id,
    			'name'               => $data['project_name'],
    			'amount'             => $data['amount']
    		]);

    	return response()->json(['project' => $data], 201);
    }

    /**
     * Update Project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // dd($request->all());
        $data = $request->validate([
                'client'           => 'required|numeric',
                'project_name'     => 'required|string|min:3|unique:projects',
                'amount'           => 'required|numeric',
            ]);

        // dd($data);
        $client = Client::findOrfail($data['client']);

        //Create Project
        $project->update([
                'user_id'            => Auth::user()->id,
                'name'               => $data['project_name'],
                'amount'             => $data['amount']
            ]);

        return response()->json(['project' => $data], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client  = Client::findOrfail($id);

        return response()->json([
            'projects' => $client->projects
                                ->map(function($p){
                                    return [
                                        'id'          => $p->id, 
                                        'name'        => $p->name, 
                                        'amount'      => $p->amount
                                    ];
                                })
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        $project->delete();

        return response()->json(['status' => 'Ok'], 204);
    }
}
