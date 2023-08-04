<?php

namespace App\Http\Controllers;

use App\DataTables\BankWithdrawalDataTable;
use App\Models\BankWithdrawal;
use Illuminate\Http\Request;

class BankWithdrawalResource extends Controller
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
     * @param BankWithdrawalDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, BankWithdrawalDataTable $datatable)
    {
        return $datatable->render($request);
    }

    /**
     * Return BankWithdrawal detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(BankWithdrawal::find($id));
    }

    /**
     * Store a newly created BankWithdrawal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bank_id' => ['required'],
            'amount' => ['required'],
            'note' => ['required'],
        ]);

        $data = $request->all();
        $data['admin_id'] = $request->user()->id;

        BankWithdrawal::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankWithdrawal  $BankWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankWithdrawal  $BankWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BankWithdrawal::find($id)->delete();
        return redirect('/#/BankWithdrawals');
    }
}
