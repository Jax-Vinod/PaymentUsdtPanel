<?php

namespace App\Http\Controllers;

use App\DataTables\PayoutDataTable;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutResource extends Controller
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
     * @param PayoutDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, PayoutDataTable $datatable)
    {
        return $datatable->render($request);
    }

    /**
     * Return Payout detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Payout::find($id));
    }

    /**
     * Store a newly created Payout in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'bank_id' => ['required'],
            'amount' => ['required'],
            'document' => ['required'],
        ]);

        $data = $request->all();
        $data['admin_id'] = $request->user()->id;

        Payout::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payout  $Payout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payout  $Payout
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payout::find($id)->delete();
        return response()->json(true);
    }
}
