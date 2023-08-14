<?php

namespace App\DataTables;

use App\Models\TraderTransfer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TraderTransferDataTable
{
    public function render(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = TraderTransfer::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->addColumn('bank', function ($item) {
            return $item->bank ? $item->bank->bank_name: 'N/A';
        })
        ->addColumn('trader', function ($item) {
            return $item->trader ? $item->trader->name : 'N/A';
        })
        ->removeColumn(['trader_id', 'bank_id']);

        return $datatable->make(true);
    }
}
