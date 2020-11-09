<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Auth;

use Inertia\Inertia;
use App\Http\Requests\ProjectValidation;
use App\Services\ProjectService;

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
                            ->latest()
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
            'clients'   => Auth::user()->clients()
                            ->latest()
                            ->paginate(0)
                            ->transform(function ($client) {
                                $name = $client->first_name . '' . $client->last_name;
                                return [
                                    'id'              => $client->id,
                                    'name'            => $name,
                                    'language'        => $name
                                ];
                            }),
            ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectValidation $request)
    {

        $data = $request->validated();

        ProjectService::create($data);

    	return response()->json(['project' => $data], 201);
    }

    /**
     * Update Project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectValidation $request, Project $project)
    {
       
        $data = $request->validated();

        ProjectService::update($data, $project);

        return response()->json(['project' => $data], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, $slug)
    {
        return Inertia::render('Projects/Show', [ 
            'project' => $project,
            'client'  => $project->client,
            'invoices'  => $project->invoices()
                                ->latest()
                                ->paginate(1)
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->invoices()->each(function($invoice){
            $invoice->delete();
        });

        $project->delete();

        return response()->json(['status' => 'Ok'], 204);
    }
}
