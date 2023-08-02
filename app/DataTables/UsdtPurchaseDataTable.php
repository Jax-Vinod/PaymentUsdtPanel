<?php

namespace App\DataTables;

use App\Models\UsdtPurchase;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UsdtPurchaseDataTable
{
    public function render(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = UsdtPurchase::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->addColumn('manager', function ($item) {
            return $item->admin->name;
        })
        ->addColumn('source_bank', function ($item) {
            return $item->bank->bank_name;
        })
        ->addColumn('action', function ($item) {
            return '';
        })
        ->removeColumn(['admin_id', 'bank_id'])
        ->rawColumns(['action']);

        return $datatable->make(true);
    }
}
