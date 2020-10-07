<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class WelcomeController extends Controller
{
    /* Welcome Page */
    public function index(){
	    return view('welcome');
    }

    /* Contact Page */
    public function contact(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->validate([
    				'name'        => 'required|string',
    				'email'       => 'required|string|email|unique:contacts',
    				'message'     => 'required',
    			]);

    		Contact::create([
    				'name'        => $data['name'],
    				'email'       => $data['email'],
    				'message'     => $data['message'],
    			]);

    		return redirect()->back()->with('success', 'Thankyou for you message.We will get to you shortly.');
    	}

	    return view('contact');
    }
}
