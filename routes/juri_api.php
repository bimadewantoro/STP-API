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
    $api->group(['middleware' => ['role:admin|super-admin'], 'prefix' => 'juri'], function ($api) {
        $api->post('/add-juri', 'App\Http\Controllers\JuriController@store');
        $api->get('/get-juri', 'App\Http\Controllers\JuriController@index');
        $api->get('/get-juri/{id}', 'App\Http\Controllers\JuriController@show');
        $api->put('/update-juri/{id}', 'App\Http\Controllers\JuriController@update');
        $api->delete('/delete-juri/{id}', 'App\Http\Controllers\JuriController@destroy');
    });
    
});