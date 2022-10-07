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
    $api->get('/', function () {
        return 'Hello STP-API';
    });
    
    $api->group(['prefix' => 'auth', 'verify' => true], function ($api) {
        $api->post('/signup', 'App\Http\Controllers\UserController@store');
        $api->post('/login', 'App\Http\Controllers\Auth\AuthController@login');
        $api->get('email/verify/{id}', 'App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify');
        $api->get('email/resend', 'App\Http\Controllers\Auth\VerificationController@resend')->name('verification.resend');
        $api->post('member', 'App\Http\Controllers\CreateMember@store')->name('member');
        $api->group(['middleware' => 'auth:api'], function ($api) {
            $api->post('/refresh', 'App\Http\Controllers\Auth\AuthController@refresh');
            $api->post('/logout', 'App\Http\Controllers\Auth\AuthController@logout');
            $api->get('/userprofile', 'App\Http\Controllers\Auth\AuthController@me');
            $api->put('/update', 'App\Http\Controllers\Auth\AuthController@update');
            $api->post('change-password', 'App\Http\Controllers\ChangePasswordController@changePassword')->name('change.password');    
        });

    });
    

    $api->group(['middleware' => ['role:super-admin|admin'], 'prefix' => 'admin'], function ($api) {
        $api->get('/users', 'App\Http\Controllers\Admin\AdminUserController@index');
    });
});