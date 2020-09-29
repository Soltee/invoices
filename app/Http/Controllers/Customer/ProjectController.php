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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
    	// echo ($client->id);
    	$search  = request()->keyword;
    	$query   = $client->projects()->latest();

    	if($search){
    		$query  = $query->where('name', 'LIKE', '%'.$search.'%');
    	}

    	return $query->paginate(3);
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
