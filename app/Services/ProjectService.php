<?php
namespace App\Services;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Auth;

class ProjectService 
{

	static public function findClient($client){

        return Client::findOrfail($client);

	}


	static public function SetIsCompletedAsAnArrayIfSet(array $data){

        return  ['is_completed' => $data['is_completed']];

	}


	/* Create Project */
	static public function create(array $data){

		$client          = self::findClient($data['client']);
		$completedArray  = self::SetIsCompletedAsAnArrayIfSet($data);

		$client->projects()->create(array_merge(
			[
    			'user_id'            => Auth::user()->id,
                'name'               => $data['project_name'],
                'description'        => $data['description'],
    			'amount'             => $data['amount']
    		],
    		$completedArray ?? []
    	));

	}

	/* Update Project */
	static public function update(array $data, $project){

		$completedArray  = self::SetIsCompletedAsAnArrayIfSet($data);

		$project->update(array_merge(
	            [
	                'name'               => $data['project_name'],
	                'amount'             => $data['amount'],
	                'description'        => $data['description']
	            ], 
	            $completedArray ?? []
	        ));

	}

}