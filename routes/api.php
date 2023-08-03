<?php

use App\Http\Controllers\NoticeResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TraderResource;

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
    Route::get('usdt_orders', 'ApiAdminController@usdt_purchases_list');

    Route::post('notice/upload', 'UploadController@uploadNoticeDocument');
    Route::post('file/remove', 'UploadController@destroy');

    Route::resource('traders', TraderResource::class);
    Route::resource('notices', NoticeResource::class);
});
