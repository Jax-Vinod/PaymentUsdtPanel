<?php

use App\Http\Controllers\AdminResource;
use App\Http\Controllers\BankResource;
use App\Http\Controllers\BankWithdrawalResource;
use App\Http\Controllers\ChargebackResource;
use App\Http\Controllers\UserResource;
use App\Http\Controllers\TraderResource;
use App\Http\Controllers\TraderTopupResource;
use App\Http\Controllers\TraderWithdrawalResource;
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
    Route::get('transfers', 'ApiAdminController@transfers_list');
    Route::post('transfers', 'ApiAdminController@createTransfer');
    Route::get('usdt_purchases', 'ApiAdminController@usdt_purchases_list');
    Route::get('payouts', 'ApiAdminController@payouts_list');
    Route::get('notices', 'ApiAdminController@notices_list');

    Route::get('blocked_traders', 'TraderResource@blocked_traders_list');
    Route::get('blocked_banks', 'BankResource@blocked_banks_list');

    Route::resource('agents', UserResource::class);
    Route::resource('admins', AdminResource::class);
    Route::resource('traders', TraderResource::class);
    Route::resource('banks', BankResource::class);
    Route::resource('chargebacks', ChargebackResource::class);
    Route::resource('trader_topups', TraderTopupResource::class);
    Route::resource('trader_withdrawals', TraderWithdrawalResource::class);
    Route::resource('bank_withdrawals', BankWithdrawalResource::class);
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
