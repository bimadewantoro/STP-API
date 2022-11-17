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
    $api->group(['middleware' => ['role:admin|super-admin'], 'prefix' => 'mentor'], function ($api) {
        $api->post('/add-mentor', 'App\Http\Controllers\MentorController@store');
        $api->get('/get-mentor', 'App\Http\Controllers\MentorController@index');
        $api->get('/get-mentor/{id}', 'App\Http\Controllers\MentorController@show');
        $api->put('/update-mentor/{id}', 'App\Http\Controllers\MentorController@update');
        $api->delete('/delete-mentor/{id}', 'App\Http\Controllers\MentorController@destroy');
    });
    
});