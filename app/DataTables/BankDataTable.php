<?php

namespace App\DataTables;

use App\Models\Bank;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BankDataTable
{
    public function render(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = Bank::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->addColumn('action', function ($user) {
            return '';
        })
        ->rawColumns(['action']);
        return $datatable->make(true);
    }
}
