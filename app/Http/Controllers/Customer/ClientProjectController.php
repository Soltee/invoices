<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;

class ClientProjectController extends Controller
{
    /**
     * Return searched client's projects to client show inertia view.
     */
    public function index(Client $client)
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
		* Show Client Projects for Add or Updating
    */
    public function show($id)
    {
        $client  = Client::findOrfail($id);

        return response()->json([
            'projects' => $client->projects
                                ->where('is_completed', true)
                                ->map(function($p){
                                    return [
                                        'id'          => $p->id, 
                                        'name'        => $p->name, 
                                        'amount'      => $p->amount
                                    ];
                                })
        ], 200);
    }

}
