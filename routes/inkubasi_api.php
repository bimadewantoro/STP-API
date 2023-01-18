<?php

use App\Http\Controllers\InkubasiController;
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
    $api->group(['middleware' => ['role:admin|super-admin'], 'prefix' => 'inkubasi'], function ($api) {
        $api->post('/add-inkubasi', 'App\Http\Controllers\InkubasiController@store');
        $api->get('/get-inkubasi/{id}', 'App\Http\Controllers\InkubasiController@show');
        $api->put('/update-inkubasi/{id}', 'App\Http\Controllers\InkubasiController@update');
        $api->delete('/delete-inkubasi/{id}', 'App\Http\Controllers\InkubasiController@destroy');
    });

    $api->get('/inkubasi/get-inkubasi', 'App\Http\Controllers\InkubasiController@index');
});