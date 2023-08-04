<?php

namespace App\Http\Controllers;

use App\DataTables\TraderWithdrawalDataTable;
use App\Models\TraderWithdrawal;
use Illuminate\Http\Request;

class TraderWithdrawalResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @param TraderWithdrawalDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, TraderWithdrawalDataTable $datatable)
    {
        return $datatable->render($request);
    }

    /**
     * Return TraderWithdrawal detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(TraderWithdrawal::find($id));
    }

    /**
     * Store a newly created TraderWithdrawal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'trader_id' => ['required'],
            'amount' => ['required'],
            'note' => ['required'],
        ]);

        $data = $request->all();
        $data['admin_id'] = auth('admin')->id();

        TraderWithdrawal::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TraderWithdrawal  $TraderWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TraderWithdrawal  $TraderWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TraderWithdrawal::find($id)->delete();
        return redirect('/#/TraderWithdrawals');
    }
}
