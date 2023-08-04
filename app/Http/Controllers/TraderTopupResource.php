<?php

namespace App\Http\Controllers;

use App\DataTables\TraderTopupDataTable;
use App\Models\TraderTopup;
use Illuminate\Http\Request;

class TraderTopupResource extends Controller
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
     * @param TraderTopupDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, TraderTopupDataTable $datatable)
    {
        return $datatable->render($request);
    }

    /**
     * Return TraderTopup detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(TraderTopup::find($id));
    }

    /**
     * Store a newly created TraderTopup in storage.
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
        $data['admin_id'] = $request->user()->id;

        TraderTopup::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TraderTopup  $TraderTopup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TraderTopup  $TraderTopup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TraderTopup::find($id)->delete();
        return redirect('/#/TraderTopups');
    }
}
