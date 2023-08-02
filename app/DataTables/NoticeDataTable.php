<?php

namespace App\DataTables;

use App\Models\Notice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NoticeDataTable
{
    public function render(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = Notice::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->addColumn('agent', function ($item) {
            return $item->agent->name;
        })
        ->addColumn('trader', function ($item) {
            return $item->trader->name;
        })
        ->removeColumn(['trader_id', 'agent_id']);

        return $datatable->make(true);
    }
}
