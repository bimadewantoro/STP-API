<?php

use App\Http\Controllers\UserDetailsController;
use Dingo\Api\Auth;
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
    $api->group(['middleware' => ['role:tenant|admin'], 'prefix' => 'user_details'], function ($api) {
        $api->post('/add-user_details', 'App\Http\Controllers\UserDetailsController@store');
        $api->get('/get-user_details', 'App\Http\Controllers\UserDetailsController@index');
        $api->get('/get-user_details/{id}', 'App\Http\Controllers\UserDetailsController@show');
        $api->put('/update-user_details/{id}', 'App\Http\Controllers\UserDetailsController@update');
        $api->delete('/delete-user_details/{id}', 'App\Http\Controllers\UserDetailsController@destroy');
    });
});