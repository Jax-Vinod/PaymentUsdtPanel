<?php

namespace App\Http\Controllers;

use App\DataTables\BankDataTable;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankResource extends Controller
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
     * @param BankDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, BankDataTable $datatable)
    {
        return $datatable->render($request);
    }

    public function blocked_banks_list(Request $request, BankDataTable $datatable)
    {
        return $datatable->renderForBlocked($request);
    }

    /**
     * Return Bank detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Bank::find($id));
    }

    /**
     * Store a newly created Bank in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'beneficiary_name' => ['required'],
            'bank_name' => ['required'],
            'ifsc' => ['required'],
            'balance' => ['required'],
        ]);

        $data = $request->all();

        Bank::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $Bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'beneficiary_name' => ['required'],
            'bank_name' => ['required'],
            'balance' => ['required'],
            'ifsc' => ['required'],
        ]);

        $bank = Bank::find($id);

        $data = $request->all();

        $bank->update($data);
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $Bank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::find($id)->delete();
        return response()->json(true);
    }
}
