<?php

namespace App\Http\Controllers;

use App\DataTables\TraderTransferDataTable;
use App\DataTables\UserDataTable;
use App\DataTables\UsdtPurchaseDataTable;
use App\DataTables\PayoutDataTable;
use App\DataTables\NoticeDataTable;
use App\Models\Admin;
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

    public function trader_transfers_list(Request $request, TraderTransferDataTable $table)
    {
        return $table->render($request);
    }

    public function usdt_purchases_list(Request $request, UsdtPurchaseDataTable $table)
    {
        return $table->render($request);
    }

    public function payouts_list(Request $request, PayoutDataTable $table)
    {
        return $table->render($request);
    }

    public function notices_list(Request $request, NoticeDataTable $table)
    {
        return $table->render($request);
    }

    public function guard()
    {
        return Auth::guard('admin');
    }
}
