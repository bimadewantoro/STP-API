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
    $api->group(['middleware' => ['role:tenant|super-admin'], 'prefix' => 'tenant'], function ($api) {
        $api->resource('member', MemberController::class);
        $api->get('member/search/{name}', 'App\Http\Controllers\MemberController@search')->name('member.search');
    });
    
});