<?php

namespace App\DataTables;

use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NoticeDataTable
{
    public function renderByAdmin(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = Notice::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            $datework = Carbon::createFromDate($item->created_at);
            $now = Carbon::now();
            $diffDays = $datework->diffForHumans($now);
            return $diffDays;
        })
        ->editColumn('document', function ($item) {
            $docs = explode(',', $item->document);
            $str = '<div class="d-flex">';
            foreach ($docs as $doc) {
                $str = $str . '<img src="'.$doc.'" width="100px" onclick="window.open(\''.$doc.'\', \'popup\', \'width=600,height=600,scrollbars=no,resizable=no\')" />';
            }
            return $str;
        })
        ->addColumn('agent', function ($item) {
            return $item->agent ? $item->agent->name : 'No agent';
        })
        ->addColumn('trader', function ($item) {
            return $item->trader ? $item->trader->name : 'No trader';
        })
        ->rawColumns(['document'])
        ->removeColumn(['trader_id', 'agent_id']);

        return $datatable->make(true);
    }

    public function render(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = Notice::where('agent_id', auth()->id())->get();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            $datework = Carbon::createFromDate($item->created_at);
            $now = Carbon::now();
            $diffDays = $datework->diffForHumans($now);
            return $diffDays;
        })
        ->editColumn('document', function ($item) {
            $docs = explode(',', $item->document);
            $str = '<div class="d-flex">';
            foreach ($docs as $doc) {
                $str = $str . '<img src="'.$doc.'" width="100px" onclick="window.open(\''.$doc.'\', \'popup\', \'width=600,height=600,scrollbars=no,resizable=no\')" />';
            }
            return $str;
        })
        ->addColumn('trader', function ($item) {
            return $item->trader ? $item->trader->name : 'No trader';
        })
        ->rawColumns(['document'])
        ->removeColumn(['trader_id', 'agent_id']);

        return $datatable->make(true);
    }
}
