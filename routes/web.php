<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ClientController;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	//Clients
	Route::get('/clients', [ClientController::class, 'index'])
								->name('clients');
	Route::get('/clients/create', [ClientController::class, 'create'])
								->name('client.create');
	Route::get('/clients/{client}', [ClientController::class, 'show'])
								->name('client.show');
	Route::post('/clients', [ClientController::class, 'store'])
								->name('client.store');

});
