<?php
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // replace this with your own code
        // the user can be located with Auth facade
        
        // $home = Auth::user()->is_admin ? config('fortify.dashboard') : config('fortify.home');
            
        return $request->wantsJson()
                    ? new JsonResponse('', 201)
                    : redirect(config('fortify.home'))
                        ->with('success', 'Your account has been registered.');
    }

}