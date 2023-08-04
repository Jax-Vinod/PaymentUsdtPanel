<?php

namespace App\Http\Controllers;

use App\DataTables\ChargebackDataTable;
use App\Models\Chargeback;
use Illuminate\Http\Request;

class ChargebackResource extends Controller
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
     * @param ChargebackDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, ChargebackDataTable $datatable)
    {
        return $datatable->render($request);
    }

    /**
     * Return Chargeback detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Chargeback::find($id));
    }

    /**
     * Store a newly created Chargeback in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'trader_id' => ['required'],
            'amount' => ['required'],
        ]);

        $data = $request->all();
        $data['admin_id'] = $request->user()->id;

        Chargeback::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chargeback  $Chargeback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chargeback  $Chargeback
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chargeback::find($id)->delete();
        return redirect('/#/chargebacks');
    }
}
