<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminResource extends Controller
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
        return $datatable->admins($request);
    }

    /**
     * Return Admin detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Admin::find($id));
    }

    /**
     * Store a newly created Admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'confirmed'],
            'name' => ['required'],
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        $data['password_crypt'] = Crypt::encryptString($request->password);
        Admin::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:admins,email,' . $id,
            // 'password' => ['required', 'confirmed'],
            'name' => ['required'],
        ]);

        $admin = Admin::find($id);

        $data = $request->all();

        // $data['password'] = Hash::make($request->password);
        // $data['password_crypt'] = Crypt::encryptString($request->password);

        $admin->update($data);
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $Admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
