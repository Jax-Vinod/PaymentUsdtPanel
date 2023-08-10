<?php

use App\Models\UsdtPurchase;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('UsdtOrder.{id}', function ($user, $id) {
//     return $user->id === UsdtPurchase::findOrNew($id)->admin_id;
//     // return true;
// }, ['guards' => ['admin']]);

// Broadcast::channel('UsdtOrder.{id}', function ($user, $id) {
//     return $user->id === UsdtPurchase::findOrNew($id)->agent_id;
// }, ['guards' => ['web']]);
