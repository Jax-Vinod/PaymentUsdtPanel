<?php

namespace App\DataTables;

use App\Models\Trader;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class UserDataTable
{
    public function traders(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = Trader::all();
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

    public function agents(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = User::all();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($user) {
            return substr($user->created_at, 0, 10);
        })
        ->editColumn('password_crypt', function ($user) {
            return $user->password_crypt ? Crypt::decryptString($user->password_crypt) : '';
        })
        ->addColumn('action', function ($user) {
            return '';
        })
        ->rawColumns(['action'])
        ->removeColumn(['password']);

        return $datatable->make(true);
    }

    public function admins(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $data = Admin::where('role', Admin::ROLE[1])->get();
        $datatable = DataTables::of($data)
        ->editColumn('created_at', function ($user) {
            return substr($user->created_at, 0, 10);
        })
        ->editColumn('password_crypt', function ($user) {
            return $user->password_crypt ? Crypt::decryptString($user->password_crypt) : '';
        })
        ->addColumn('action', function ($user) {
            return '';
        })
        ->rawColumns(['action'])
        ->removeColumn(['password']);

        return $datatable->make(true);
    }
}
