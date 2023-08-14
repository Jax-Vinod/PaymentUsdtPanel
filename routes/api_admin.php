<?php

use App\Http\Controllers\AdminResource;
use App\Http\Controllers\BankResource;
use App\Http\Controllers\BankWithdrawalResource;
use App\Http\Controllers\ChargebackResource;
use App\Http\Controllers\PayoutResource;
use App\Http\Controllers\UserResource;
use App\Http\Controllers\TraderResource;
use App\Http\Controllers\TraderTopupResource;
use App\Http\Controllers\TraderWithdrawalResource;
use App\Http\Controllers\UsdtOrderController;
use App\Http\Controllers\UsdtPurchaseResource;
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


Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthAdminController@login')->name('admin.login');

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('password_reset', 'App\Http\Controllers\AuthController@passwordReset');
    Route::post('password_save', 'App\Http\Controllers\AuthController@passwordSave');

    Route::get('transfers', 'App\Http\Controllers\ApiAdminController@transfers_list');
    Route::post('transfers', 'App\Http\Controllers\ApiAdminController@createTransfer');
    Route::get('notices', 'App\Http\Controllers\ApiAdminController@notices_list');

    Route::get('blocked_traders', 'App\Http\Controllers\TraderResource@blocked_traders_list');
    Route::get('blocked_banks', 'App\Http\Controllers\BankResource@blocked_banks_list');

    Route::post('usdt_purchases/step2', [UsdtOrderController::class, 'step2']);
    Route::post('usdt_purchases/approve', [UsdtOrderController::class, 'approve']);

    Route::get('usdt_agents', [UserResource::class, 'usdtAgents']);

    Route::resource('agents', UserResource::class);
    Route::resource('admins', AdminResource::class);
    Route::resource('traders', TraderResource::class);
    Route::resource('banks', BankResource::class);
    Route::resource('chargebacks', ChargebackResource::class);
    Route::resource('trader_topups', TraderTopupResource::class);
    Route::resource('trader_withdrawals', TraderWithdrawalResource::class);
    Route::resource('bank_withdrawals', BankWithdrawalResource::class);
    Route::resource('usdt_purchases', UsdtPurchaseResource::class);
    Route::resource('payouts', PayoutResource::class);

    Route::post('file/upload', 'App\Http\Controllers\UploadController@uploadFile');
    Route::post('file/remove', 'App\Http\Controllers\UploadController@destroy');

});
