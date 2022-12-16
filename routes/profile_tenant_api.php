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
    $api->group(['middleware' => 'role:tenant', 'prefix' => 'profile-tenant'], function ($api) {
        $api->post('add-profile', 'App\Http\Controllers\ProfilTenantController@store');
        $api->get('get-profile/{id}', 'App\Http\Controllers\ProfilTenantController@show');
        $api->put('edit-profile/{id}', 'App\Http\Controllers\ProfilTenantController@update');
        $api->delete('del-profile/{id}', 'App\Http\Controllers\ProfilTenantController@destroy');
    });
});