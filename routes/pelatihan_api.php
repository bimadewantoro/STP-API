<?php

use App\Http\Controllers\CreateMember;
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
    $api->group(['middleware' => 'role:admin', 'prefix' => 'pelatihan'], function ($api) {
        $api->post('add-pelatihan', 'App\Http\Controllers\PelatihanController@store');
        $api->get('get-pelatihan/{id}', 'App\Http\Controllers\PelatihanController@show');
        $api->put('edit-pelatihan/{id}', 'App\Http\Controllers\PelatihanController@update');
        $api->delete('del-pelatihan/{id}', 'App\Http\Controllers\PelatihanController@destroy');
    });

    $api->get('pelatihan/get-pelatihan', 'App\Http\Controllers\PelatihanController@index');
});