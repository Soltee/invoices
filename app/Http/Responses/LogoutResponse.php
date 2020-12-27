<?php
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        
        return $request->wantsJson()
                    ? new JsonResponse('', 204)
                    : redirect('/')
                        ->with('success', 'You are logged out.');
    }

}