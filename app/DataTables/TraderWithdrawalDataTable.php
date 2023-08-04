<?php

namespace App\DataTables;

use App\Models\TraderWithdrawal;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TraderWithdrawalDataTable
{
    public function render(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = TraderWithdrawal::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->addColumn('trader', function ($item) {
            return $item->trader->name;
        })
        ->removeColumn(['trader_id']);

        return $datatable->make(true);
    }
}
