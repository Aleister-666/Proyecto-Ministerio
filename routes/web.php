<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\WorkplaceController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\GmvvRequests;


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
	------------------------Users Controller Routes---------------------
*/

Route::get('workplace/create_user', [UsersController::class, 'new'])
	->middleware('auth', 'role:admin|coordinator')
	->name('new_user_path');

Route::post('workplace/create_user', [UsersController::class, 'create'])
	->middleware('auth', 'role:admin|coordinator')
	->name('create_user_path');

Route::get('workplace/update_user', [UsersController::class, 'edit'])
	->middleware('auth')
	->name('edit_user_path');

Route::put('workplace/update_user', [UsersController::class, 'update'])
	->middleware('auth')
	->name('update_user_path');

Route::delete('workplace/user/delete', [UsersController::class, 'destroy'])
	->middleware('auth')
	->name('delete_user');

/*
	------------------------Sessions Controller Routes---------------------
*/

Route::get('login', [SessionsController::class, 'new'])
	->middleware('guest')
	->name('login_path');

Route::post('login', [SessionsController::class, 'create'])
	->middleware('guest')
	->name('create_session_path');

Route::get('logout', [SessionsController::class, 'destroy'])->name('logout_path');


/*
	------------------------Workplace Controller Routes---------------------
*/

Route::get('workplace', [WorkplaceController::class, 'index'])
	->middleware('auth')
	->name('workplace_path');

Route::get('workplace/list_documents', [WorkplaceController::class, 'list_documents'])
	->middleware('auth')
	->name('list_documents_path');
/*
	------------------------Documents Controller Routes---------------------
*/

// Route::get('workplace/upload_document', [WorkplaceController::class, 'up_document'])
// 	->middleware('auth')
// 	->name('new_document_path');

// Route::post('workplace/upload_document', [DocumentsController::class, 'create'])
// 	->middleware('auth')
// 	->name('create_document_path');

// Route::get('workplace/edit_document/{id}', [WorkplaceController::class, 'edit_document'])
// 	->middleware('auth')
// 	->name('edit_document_path');

// Route::put('workplace/edit_document/{id}', [DocumentsController::class, 'update'])
// 	->middleware('auth')
// 	->name('update_document_path');

// Route::delete('workplace/destroy_document/{id}', [DocumentsController::class, 'destroy'])
// 	->middleware('auth')
// 	->name('destroy_document_path');

// Route::get('workplace/download_document/{id}', [DocumentsController::class, 'download'])
// 	->middleware('auth')
// 	->name('download_document_path');


/*
	------------------------GmvvRequests Controller Routes---------------------
*/

Route::get('workplace/gmvv_request', [GmvvRequests::class, 'new'])
	->middleware('auth')
	->name('new_gmvvrequest_path');

Route::post('workplace/gmvv_request', [GmvvRequests::class, 'create'])
	->middleware('auth')
	->name('create_gmvvrequest_path');