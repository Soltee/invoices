<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ClientController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ProjectController;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	//Clients
	Route::get('/clients', [ClientController::class, 'index'])
								->name('clients');
	Route::get('/clients/create', [ClientController::class, 'create'])
								->name('client.create');
	Route::get('/clients/{client}-{name}', [ClientController::class, 'show'])
								->name('client.show');
	Route::post('/clients', [ClientController::class, 'store'])
								->name('client.store');
	Route::put('/clients/{client}', [ClientController::class, 'update'])
								->name('client.update');
	Route::delete('/clients/{client}', [ClientController::class, 'destroy'])
								->name('client.destroy');


    //Projects Api
	Route::get('/clients/projects/{client}/search', [ProjectController::class, 'index']);
	Route::post('/clients/project', [ProjectController::class, 'store']);
	Route::put('/clients/projects/{project}', [ProjectController::class, 'update']);
	Route::delete('/clients/project/{project}', [ProjectController::class, 'destroy']);

});
