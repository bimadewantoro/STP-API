<?php

use Dingo\Api\Auth\Auth;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

$api =  app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'auth', 'verify' => true], function ($api) {
        $api->post('/signup', 'App\Http\Controllers\AuthController@signup');
        $api->post('/login', 'App\Http\Controllers\AuthController@login');
        $api->group(['middleware' => 'auth:api'], function ($api) {
            $api->post('/refresh', 'App\Http\Controllers\AuthController@refresh');
            $api->post('/logout', 'App\Http\Controllers\AuthController@logout');
            $api->get('/me', 'App\Http\Controllers\AuthController@me');
            $api->put('/changepassword', 'App\Http\Controllers\AuthController@changePassword')->name('change.password');
            $api->put('/changename', 'App\Http\Controllers\AuthController@changeName')->name('change.name');
        });
    });   
});