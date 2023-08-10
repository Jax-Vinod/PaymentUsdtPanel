<?php

use App\Http\Controllers\NoticeResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TraderResource;
use App\Http\Controllers\UsdtPurchaseResource;
use Illuminate\Support\Facades\Broadcast;

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
Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');

Route::middleware('auth:sanctum')->group(function() {

    Route::post('broadcasting/auth', function () {
        return auth()->user();
    });

    Route::post('notice/upload', 'App\Http\Controllers\UploadController@uploadNoticeDocument');
    Route::post('file/remove', 'App\Http\Controllers\UploadController@destroy');

    Route::post('usdt_order/step1', 'App\Http\Controllers\UsdtOrderController@step1');
    Route::post('usdt_order/step3', 'App\Http\Controllers\UsdtOrderController@step3');

    Route::resource('traders', TraderResource::class);
    Route::resource('notices', NoticeResource::class);
    Route::resource('usdt_orders', UsdtPurchaseResource::class);
});

// Broadcast::routes(['middleware' => ['auth:sanctum']]);
