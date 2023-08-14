<?php

namespace App\DataTables;

use App\Models\Payout;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PayoutDataTable
{
    public function render(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = Payout::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->addColumn('admin', function ($item) {
            return $item->admin ? $item->admin->name : 'N/A';
        })
        ->addColumn('bank', function ($item) {
            return $item->bank ? $item->bank->bank_name : 'N/A';
        })
        ->removeColumn(['admin_id', 'bank_id']);

        return $datatable->make(true);
    }
}
