<?php

namespace App\Http\Controllers;

use App\Events\UsdtOrderEvent;
use App\Models\Admin;
use App\Models\UsdtPurchase;
use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class UsdtOrderController extends Controller
{
    public function step1(Request $request)
    {
        $this->validate($request, [
            'id' => ['required'],
            'account_number' => ['required'],
            'bank_name' => ['required'],
            'ifsc' => ['required'],
            'amount' => ['required'],
            'min' => ['required'],
            'max' => ['required'],
        ]);

        $order = UsdtPurchase::find($request->id);
        $order->dest_bank_detail = "Account Number: ".$request->account_number." \n"
                                    ."Bank Name: ".$request->bank_name." \n"
                                    ."IFSC Code: ".$request->ifsc." \n"
                                    ."Amount: ".$request->amount." \n"
                                    ."Min. : ".$request->min." \n"
                                    ."Max. : ".$request->max;
        $order->amount = $request->amount;
        $order->agent_id = $request->user()->id;
        $order->status = 'In Progress';
        $order->step = 1;
        $order->save();
        broadcast(new UsdtOrderEvent($order));

        try {
            $content = '';
            Notification::sendNow(Admin::first(), new TelegramNotification($content));
        } catch (\Throwable $th) {
            Log::error('telegram error '.$th->getMessage());
            //throw $th;
        }


        return response()->json(true);
    }

    public function step2(Request $request)
    {
        $this->validate($request, [
            'id' => ['required'],
            'bank_id' => ['required'],
            // 'documents' => ['required'],
        ]);

        $order = UsdtPurchase::find($request->id);
        $order->bank_id = $request->bank_id;
        $order->document = $request->documents;
        $order->wallet_address = $request->wallet_address;
        $order->step = 2;
        $order->save();
        broadcast(new UsdtOrderEvent($order));

        try {
            $content = '';
            Notification::sendNow(Admin::first(), new TelegramNotification($content));
        } catch (\Throwable $th) {
            Log::error('telegram error '.$th->getMessage());
            //throw $th;
        }


        return response()->json(true);
    }

    public function step3(Request $request)
    {
        $this->validate($request, [
            'id' => ['required'],
            'txn_hash' => ['required'],
        ]);

        $order = UsdtPurchase::find($request->id);
        $order->txn_hash = $request->txn_hash;
        $order->step = 3;
        $order->save();
        broadcast(new UsdtOrderEvent($order));

        try {
            $content = '';
            Notification::sendNow(Admin::first(), new TelegramNotification($content));
        } catch (\Throwable $th) {
            Log::error('telegram error '.$th->getMessage());
            //throw $th;
        }


        return response()->json(true);
    }

    public function approve(Request $request)
    {
        $this->validate($request, [
            'id' => ['required'],
        ]);

        $order = UsdtPurchase::find($request->id);
        $order->status = 'Approved';
        $order->step = 4;
        $order->save();
        broadcast(new UsdtOrderEvent($order));

        try {
            $content = 'Approved the order';
            Notification::sendNow(Admin::first(), new TelegramNotification($content));
        } catch (\Throwable $th) {
            Log::error('telegram error '.$th->getMessage());
            //throw $th;
        }


        return response()->json(true);
    }
}
