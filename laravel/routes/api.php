<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;

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

//Ниже роуты из урока "Создание RESTful API на Laravel"
//Route::get('/country', [App\Http\Controllers\Api\Country\CountryController::class, 'country']);
//Route::get('/country/{id}', [App\Http\Controllers\Api\Country\CountryController::class, 'countryById']);
//Route::post('/country', [App\Http\Controllers\Api\Country\CountryController::class, 'countrySave']);
//Route::put('/country/{country}', [App\Http\Controllers\Api\Country\CountryController::class, 'countryEdit']);
//Route::delete('/country/{country}', [App\Http\Controllers\Api\Country\CountryController::class, 'countryDelete']);
//Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

//роуты из статьи JWT
Route::controller(LoginController::class)->group(function () {
	Route::post('login', 'login');
	Route::post('register', 'register');
	Route::post('logout', 'logout');
	Route::post('refresh', 'refresh');
	Route::get('me', 'me');
});
