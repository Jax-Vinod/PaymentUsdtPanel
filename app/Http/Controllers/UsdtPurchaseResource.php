<?php

namespace App\Http\Controllers;

use App\DataTables\UsdtPurchaseDataTable;
use App\Models\UsdtPurchase;
use App\Models\User;
use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class UsdtPurchaseResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @param UsdtPurchaseDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, UsdtPurchaseDataTable $datatable)
    {
        return $datatable->render($request);
    }

    /**
     * Return UsdtPurchase detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(UsdtPurchase::find($id));
    }

    /**
     * Store a newly created UsdtPurchase in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => ['required'],
            'agent_id' => 'required'
        ]);

        $data = $request->all();
        $data['admin_id'] = $request->user()->id;
        $data['status'] = 'Created';
        $data['order_no'] = 'UO '.time();

        $item = UsdtPurchase::create($data);
        try {
            $content = 'Requested USDT to you.';
            Notification::sendNow(User::find($request->agent_id), new TelegramNotification($content));
        } catch (\Throwable $th) {
            Log::error('telegram error '.$th->getMessage());
            //throw $th;
        }
        return response()->json(['id' => $item->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsdtPurchase  $UsdtPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsdtPurchase  $UsdtPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UsdtPurchase::find($id)->delete();
        return response()->json(true);
    }
}
