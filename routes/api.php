<?php

use App\Http\Controllers\NoticeResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TraderResource;
use App\Http\Controllers\UsdtPurchaseResource;

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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login')->name('login');

Route::middleware('auth:sanctum')->group(function() {

    Route::post('broadcasting/auth', function () {
        return true;
    });

    Route::post('notice/upload', 'UploadController@uploadNoticeDocument');
    Route::post('file/remove', 'UploadController@destroy');

    Route::post('usdt_order/step1', 'UsdtOrderController@step1');
    Route::post('usdt_order/step3', 'UsdtOrderController@step3');

    Route::resource('traders', TraderResource::class);
    Route::resource('notices', NoticeResource::class);
    Route::resource('usdt_orders', UsdtPurchaseResource::class);
});
