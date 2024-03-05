<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Role10Controller;
// use App\Http\Controllers\Admin10Controller;
// use App\Http\Controllers\Agama10Controller;
// use App\Http\Controllers\DetailData10Controller;
use App\Http\Controllers\Client\Role10ClientController;
use App\Http\Controllers\Client\Admin10ClientController;
use App\Http\Controllers\Client\Agama10ClientController;
use App\Http\Controllers\Client\DetailData10ClientController;



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

//home
// Route::get('/', [Role10Controller::class, 'login10']);

Route::get('/', [Role10ClientController::class, 'login10']);

//role 
// Route::get('/register10', [Role10Controller::class, 'register10']);
// Route::post('/register10', [Role10Controller::class, 'prosesregister10']);
// Route::get('/login10', [Role10Controller::class, 'login10']);
// Route::post('/login10', [Role10Controller::class, 'proseslogin10']);
// Route::get('/profil10', [Role10Controller::class, 'profil10']);
// Route::get('/foto10', [Role10Controller::class, 'editfoto10']);
// Route::post('/foto10', [Role10Controller::class, 'updatefoto10']);
// Route::get('/password10', [Role10Controller::class, 'editPass10']);
// Route::post('/password10', [Role10Controller::class, 'updatePass10']);
// Route::get('/logout10', [Role10Controller::class, 'logout10']);

Route::get('/register10', [Role10ClientController::class, 'register10']);
Route::post('/register10', [Role10ClientController::class, 'prosesregister10']);
Route::get('/login10', [Role10ClientController::class, 'login10']);
Route::post('/login10', [Role10ClientController::class, 'proseslogin10']);
Route::get('/profil10', [Role10ClientController::class, 'profil10']);
Route::get('/foto10', [Role10ClientController::class, 'editfoto10']);
Route::post('/foto10', [Role10ClientController::class, 'updatefoto10']);
Route::get('/password10', [Role10ClientController::class, 'editPass10']);
Route::post('/password10', [Role10ClientController::class, 'updatePass10']);
Route::get('/logout10', [Role10ClientController::class, 'logout10']);

//agama
// Route::get('/agama10', [Agama10Controller::class, 'index10']);
// Route::get('/agama10/create', [Agama10Controller::class, 'create10']);
// Route::post('/agama10', [Agama10Controller::class, 'store10']);
// Route::get('/agama10/{id}/edit', [Agama10Controller::class, 'edit10']);
// Route::post('/agama10/{id}', [Agama10Controller::class, 'update10']);
// Route::post('/agama10/{id}/delete', [Agama10Controller::class, 'destroy10']);

Route::get('/agama10', [Agama10ClientController::class, 'index10']);
Route::get('/agama10/create', [Agama10ClientController::class, 'create10']);
Route::post('/agama10', [Agama10ClientController::class, 'store10']);
Route::get('/agama10/{id}/edit', [Agama10ClientController::class, 'edit10']);
Route::post('/agama10/{id}', [Agama10ClientController::class, 'update10']);
Route::post('/agama10/{id}/delete', [Agama10ClientController::class, 'destroy10']);

//detail_data
// Route::get('/detail10', [DetailData10Controller::class, 'index10']);
// Route::get('/detail10/create', [DetailData10Controller::class, 'create10']);
// Route::post('/detail10', [DetailData10Controller::class, 'store10']);
// Route::get('/detail10/{id}', [DetailData10Controller::class, 'edit10']);
// Route::post('/detail10/{id}', [DetailData10Controller::class, 'update10']);
// Route::post('/detail10/{id}/delete', [DetailData10Controller::class, 'destroy10']);

Route::get('/detail10', [DetailData10ClientController::class, 'index10']);
Route::get('/detail10/create', [DetailData10ClientController::class, 'create10']);
Route::post('/detail10', [DetailData10ClientController::class, 'store10']);
Route::get('/detail10/{id}', [DetailData10ClientController::class, 'edit10']);
Route::post('/detail10/{id}', [DetailData10ClientController::class, 'update10']);
Route::post('/detail10/{id}/delete', [DetailData10ClientController::class, 'destroy10']);

 //admin
// Route::get('/status10', [Admin10Controller::class, 'status10']);
// Route::post('/status10', [Admin10Controller::class, 'store10']);
// Route::get('/details10', [Admin10Controller::class, 'index10']);
// Route::get('/details10/{id}', [Admin10Controller::class, 'show10']);

Route::get('/status10', [Admin10ClientController::class, 'status10']);
Route::post('/status10', [Admin10ClientController::class, 'store10']);
Route::get('/admindetail10', [Admin10ClientController::class, 'index10']);
Route::get('/admindetail10/{id}', [Admin10ClientController::class, 'show10']);
