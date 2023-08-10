<?php

namespace App\Http\Controllers;

use App\Events\UsdtOrderEvent;
use App\Models\UsdtPurchase;
use Illuminate\Http\Request;

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
        $order->dest_bank_detail = 'Account Number: '.$request->account_number." \r\n"
                                    .'Bank Name: '.$request->bank_name." \r\n"
                                    .'IFSC Code: '.$request->ifsc." \r\n"
                                    .'Amount: '.$request->amount." \r\n"
                                    .'Min. : '.$request->min." \r\n"
                                    .'Max. : '.$request->max;
        $order->amount = $request->amount;
        $order->agent_id = $request->user()->id;
        $order->status = 'In Progress';
        $order->step = 1;
        $order->save();
        broadcast(new UsdtOrderEvent($order));


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


        return response()->json(true);
    }
}
