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
        ->editColumn('document', function ($item) {
            // $docs = explode(',', $item->document);
            $docs = json_decode($item->document, true);
            if (isset($docs)) {
                $str = '<div class="d-flex">';
                foreach ($docs as $doc) {
                    $str = $str . '<img src="'.$doc.'" width="100px" />';
                }
                return $str;
            } else return '';
        })
        ->addColumn('admin', function ($item) {
            return $item->admin ? $item->admin->name: 'N/A';
        })
        ->addColumn('source_bank', function ($item) {
            return $item->bank ? $item->bank->bank_name: '';
        })
        ->addColumn('action', function ($item) {
            return '';
        })
        ->removeColumn(['admin_id', 'bank_id'])
        ->rawColumns(['action', 'document']);

        return $datatable->make(true);
    }

    public function renderNews(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = UsdtPurchase::where('step', 0)->get();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->editColumn('document', function ($item) {
            // $docs = explode(',', $item->document);
            $docs = json_decode($item->document, true);
            if (isset($docs)) {
                $str = '<div class="d-flex">';
                foreach ($docs as $doc) {
                    $str = $str . '<img src="'.$doc.'" width="100px" />';
                }
                return $str;
            } else return '';
        })
        ->addColumn('admin', function ($item) {
            return $item->admin ? $item->admin->name: 'N/A';
        })
        ->addColumn('source_bank', function ($item) {
            return $item->bank ? $item->bank->bank_name: '';
        })
        ->addColumn('action', function ($item) {
            return '';
        })
        ->removeColumn(['admin_id', 'bank_id'])
        ->rawColumns(['action', 'document']);

        return $datatable->make(true);
    }

    public function renderByAgent(Request $request, $agentId)
    {
        $start = $request->start;
        $length = $request->length;
        $data = UsdtPurchase::where('agent_id', $agentId)->get();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($item) {
            return substr($item->created_at, 0, 10);
        })
        ->editColumn('document', function ($item) {
            // $docs = explode(',', $item->document);
            $docs = json_decode($item->document, true);
            if (isset($docs)) {
                $str = '<div class="d-flex">';
                foreach ($docs as $doc) {
                    $str = $str . '<img src="'.$doc.'" width="100px" />';
                }
                return $str;
            } else return '';
        })
        ->addColumn('admin', function ($item) {
            return $item->admin ? $item->admin->name: 'N/A';
        })
        ->addColumn('source_bank', function ($item) {
            return $item->bank ? $item->bank->bank_name: '';
        })
        ->addColumn('action', function ($item) {
            return '';
        })
        ->removeColumn(['admin_id', 'bank_id'])
        ->rawColumns(['action', 'document']);

        return $datatable->make(true);
    }
}
