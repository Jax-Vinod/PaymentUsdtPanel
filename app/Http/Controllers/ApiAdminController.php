<?php

namespace App\Http\Controllers;

use App\DataTables\TraderTransferDataTable;
use App\DataTables\UsdtPurchaseDataTable;
use App\DataTables\PayoutDataTable;
use App\DataTables\NoticeDataTable;
use App\Models\TraderTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAdminController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function transfers_list(Request $request, TraderTransferDataTable $table)
    {
        return $table->render($request);
    }

    public function createTransfer(Request $request)
    {
        $this->validate($request, [
            'amount' => ['required'],
            'trader_id' => ['required'],
            'bank_id' => ['required'],
        ]);

        $data = $request->all();
        $data['admin_id'] = $request->user()->id;

        TraderTransfer::create($data);

        // return response()->json(['message' => 'Created successfully']);
        return redirect('/#/admin/transfer/new');

    }

    public function payouts_list(Request $request, PayoutDataTable $table)
    {
        return $table->render($request);
    }

    public function notices_list(Request $request, NoticeDataTable $table)
    {
        return $table->renderByAdmin($request);
    }

    public function guard()
    {
        return Auth::guard('admin');
    }
}
