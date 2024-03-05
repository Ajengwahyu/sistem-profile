<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Role10ApiController;
use App\Http\Controllers\Api\Admin10ApiController;
use App\Http\Controllers\Api\Agama10ApiController;
use App\Http\Controllers\Api\DetailData10ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register10', [Role10ApiController::class, 'store10']);
Route::post('/password10', [Role10ApiController::class, 'update_Pass10']);
Route::post('/foto10', [Role10ApiController::class, 'update_Foto10']);

Route::get('/agama10', [Agama10ApiController::class, 'index10']);
Route::post('/agama10', [Agama10ApiController::class, 'store10']);
Route::get('/agama10/{id}', [Agama10ApiController::class, 'show10']);
Route::put('/agama10/{id}', [Agama10ApiController::class, 'update10']);
Route::delete('/agama10/{id}', [Agama10ApiController::class, 'destroy10']);

Route::get('/detail10/{id}', [DetailData10ApiController::class, 'index10']);
Route::post('/detail10', [DetailData10ApiController::class, 'store10']);
Route::get('/detail10/{id}/show', [DetailData10ApiController::class, 'show10']);
Route::post('/detail10/{id}/edit', [DetailData10ApiController::class, 'update10']);
Route::delete('/detail10/{id}', [DetailData10ApiController::class, 'destroy10']);

Route::get('/status10', [Admin10ApiController::class, 'status10']);
Route::post('/status10', [Admin10ApiController::class, 'store10']);
Route::get('/admindetail10', [Admin10ApiController::class, 'index10']);
Route::get('/admindetail10/{id}', [Admin10ApiController::class, 'show10']);


