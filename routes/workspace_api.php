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
    $api->group(['middleware' => ['role:admin|super-admin'], 'prefix' => 'cowork'], function ($api) {
        $api->post('/add-cowork', 'App\Http\Controllers\CoWorkSpaceController@store');
        $api->get('/get-cowork', 'App\Http\Controllers\CoWorkSpaceController@index');
        $api->get('/get-cowork/{id}', 'App\Http\Controllers\CoWorkSpaceController@show');
        $api->put('/update-cowork/{id}', 'App\Http\Controllers\CoWorkSpaceController@update');
        $api->delete('/delete-cowork/{id}', 'App\Http\Controllers\CoWorkSpaceController@destroy');
    });
});