<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\WorkplaceController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\GmvvRequestsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
	------------------------Home Controller Routes---------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('root_path');

/*
	------------------------Sessions Controller Routes---------------------
*/

Route::middleware(['guest'])->group(function() {
	Route::get('login', [SessionsController::class, 'new'])
		->name('login_path');

	Route::post('login', [SessionsController::class, 'create'])
		->name('create_session_path');
});

Route::get('logout', [SessionsController::class, 'destroy'])
	->name('logout_path');

/**
 * Workplace
 */

Route::prefix('workplace')->middleware(['auth'])->group(function() {

	Route::get('', [WorkplaceController::class, 'index'])
	->name('workplace_path');

});

Route::prefix('workplace')->group(function() {

	/**
	 * Controlador de Usuario
	 */
	Route::middleware(['auth', 'role:admin|coordinator'])->group(function() {
		Route::get('/create_user', [UsersController::class, 'new'])
			->name('new_user_path');

		Route::post('/create_user', [UsersController::class, 'create'])
			->name('create_user_path');

		Route::delete('/delete_user', [UsersController::class, 'destroy'])
			->name('destroy_user_path');

	});

	Route::middleware(['auth'])->group(function() {
		Route::get('/update_user', [UsersController::class, 'edit'])
			->name('edit_user_path');

		Route::put('/update_user', [UsersController::class, 'update'])
			->name('update_user_path');
	});

	/**
	 * Controlador de Peticion GMVV
	 */	
	Route::middleware(['auth', 'departament:Redes Populares'])->group(function() {

		Route::get('/tasks/reports/gmvv_request', [GmvvRequestsController::class, 'index'])
			->name('index_gmvv_request_path');

		Route::get('/tasks/gmvv_request', [GmvvRequestsController::class, 'new'])
			->name('new_gmvv_request_path');

		Route::post('/tasks/gmvv_request', [GmvvRequestsController::class, 'create'])
			->name('create_gmvv_request_path');

		Route::delete('/tasks/gmvv_request/delete/{id}', [GmvvRequestsController::class, 'destroy'])
			->name('destroy_gmvv_request_path');

		Route::get('/tasks/gmvv_request/download/{id}', [GmvvRequestsController::class, 'download'])
			->name('download_gmvv_request_path');

		Route::get('/tasks/gmvv_request/search', [GmvvRequestsController::class, 'search'])
			->name('search_gmvv_request_path');

	});

});
