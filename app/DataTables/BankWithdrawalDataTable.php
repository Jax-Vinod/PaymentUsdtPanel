<?php

namespace App\DataTables;

use App\Models\BankWithdrawal;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BankWithdrawalDataTable
{
    public function render(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = BankWithdrawal::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->addColumn('bank', function ($item) {
            return $item->Bank->name;
        })
        ->removeColumn(['bank_id']);

        return $datatable->make(true);
    }
}
