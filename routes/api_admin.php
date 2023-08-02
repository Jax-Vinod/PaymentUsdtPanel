<?php

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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('trader_transfers_list', 'ApiAdminController@trader_transfers_list');
    Route::get('traders_list', 'ApiAdminController@traders_list');
    Route::get('usdt_purchases_list', 'ApiAdminController@usdt_purchases_list');
    Route::get('payouts_list', 'ApiAdminController@payouts_list');
    Route::get('notices_list', 'ApiAdminController@notices_list');
    Route::get('agents_list', 'ApiAdminController@agents_list');
    Route::get('admins_list', 'ApiAdminController@admins_list');
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthAdminController@login')->name('admin.login');

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('password_reset', 'AuthController@passwordReset');
    Route::get('user_list', 'AuthController@user_list');
    Route::post('password_save', 'AuthController@passwordSave');
    Route::post('add_user', 'AuthController@addUser');
    Route::get('get_user/{user_id}', 'AuthController@getUser');
    Route::post('edit_user', 'AuthController@editUser');
    Route::get('delete_user/{user_id}', 'AuthController@deleteUser');
});
