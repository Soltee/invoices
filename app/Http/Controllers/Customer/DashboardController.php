<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\User;
use Auth;

use Inertia\Inertia;

class DashboardController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Dashboard', [
            'search'    => request()->search,
            'clients'   => Auth::user()->clients()
                            ->withCount('projects')
                            // ->orderByName()
                            ->filter(request()->only('search'))
                            ->paginate(2)
                            ->transform(function ($client) {
                                return [
                                    'id'        => $client->id,
                                    'name'      => $client->first_name . ' ' . $client->last_name,
                                    'email'     => $client->email,
                                    'projects'  => $client->projects->count()
                                ];
                            }),
            ]);
    }

}
