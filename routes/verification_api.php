<?php

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
    $api->group(['prefix' => 'auth', 'verify' => true], function ($api) {
        $api->get('/email/verify/{token}', 'App\Http\Controllers\VerificationController@verifyUser')->name('verify.mail');
        $api->get('/email/resend', 'App\Http\Controllers\VerificationController@resend')->name('resend.mail');
    });   
});