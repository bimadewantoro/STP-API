<?php

use Dingo\Api\Auth;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarMentorController;

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
    $api->group(['middleware' => ['role:admin|super-admin'], 'prefix' => 'daftar_mentor'], function ($api) {
        $api->post('/add-daftar_mentor', 'App\Http\Controllers\DaftarMentorController@store');
        $api->get('/get-daftar_mentor/{id}', 'App\Http\Controllers\DaftarMentorController@show');
        $api->put('/update-daftar_mentor/{id}', 'App\Http\Controllers\DaftarMentorController@update');
        $api->delete('/delete-daftar_mentor/{id}', 'App\Http\Controllers\DaftarMentorController@destroy');
    });

    $api->get('/daftar_mentor/get-daftar_mentor', 'App\Http\Controllers\DaftarMentorController@index');
});