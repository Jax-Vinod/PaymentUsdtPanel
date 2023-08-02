<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\Trader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class TraderResource extends Controller
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
     * @param UserDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, UserDataTable $datatable)
    {
        return $datatable->Traders($request);
    }

    /**
     * Return Trader detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Trader::find($id));
    }

    /**
     * Store a newly created Trader in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:traders,email'],
            'name' => ['required'],
            'phone' => ['required'],
            'upi' => ['required'],
        ]);

        $data = $request->all();

        Trader::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:traders,email,' . $id,
            'name' => ['required'],
            'phone' => ['required'],
            'upi' => ['required'],
        ]);

        $trader = Trader::find($id);

        $data = $request->all();

        $trader->update($data);
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trader  $Trader
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trader::find($id)->delete();
        return redirect('/#/admin/traders');
    }
}
