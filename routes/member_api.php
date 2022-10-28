<?php

use App\Http\Controllers\MemberController;
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
    $api->get('/', function () {
        return 'Hello STP-API';
    });
    
    $api->group(['middleware' => ['role:tenant|super-admin'], 'prefix' => 'tenant'], function ($api) {
        $api->get('member', 'App\Http\Controllers\MemberController@index');
        $api->post('member', 'App\Http\Controllers\MemberController@store')->name('member.store');
        $api->get('member/{id}', 'App\Http\Controllers\MemberController@show')->name('member.me');
        $api->put('member/{id}', 'App\Http\Controllers\MemberController@update')->name('member.update');
        $api->delete('member/{id}', 'App\Http\Controllers\MemberController@destroy')->name('member.delete');

    });
    
});