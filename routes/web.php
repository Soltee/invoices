<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ClientController;
use App\Http\Controllers\Customer\ClientProjectController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ProjectController;
use App\Http\Controllers\Customer\InvoiceController;

use App\Http\Controllers\WelcomeController;

// Auth::routes();

Route::get('/', [WelcomeController::class, 'index'])
									->name('welcome');
Route::get('/contact-us', [WelcomeController::class, 'contact'])
									->name('contact');
Route::post('/new_contact', [WelcomeController::class, 'contact'])
									->name('contact.save');


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
	Route::get('/clients/projects/{client}/search', [ClientProjectController::class, 'index']);
	Route::get('/client_projects/{client}', [ClientProjectController::class, 'show']);

	//Invoices
	Route::get('/invoices', [InvoiceController::class, 'index'])
								->name('invoices');
	Route::get('/invoices/create', [InvoiceController::class, 'create'])
								->name('invoice.create');
	Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])
								->name('invoice.show');
	Route::get('/invoices/{invoice}/send', [InvoiceController::class, 'send'])
								->name('invoice.send');
	Route::post('/invoices', [InvoiceController::class, 'store'])
								->name('invoice.store');
	Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])
								->name('invoice.update');
	Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])
								->name('invoice.destroy');

	//Projects
	Route::get('/projects', [ProjectController::class, 'index'])
								->name('projects');	
	Route::get('/projects/{project}-{slug}', [ProjectController::class, 'show'])
								->name('project.show');
	Route::post('/projects', [ProjectController::class, 'store']);
	Route::put('/projects/{project}', [ProjectController::class, 'update']);
	Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);					

});
