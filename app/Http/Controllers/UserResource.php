<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserResource extends Controller
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
        return $datatable->agents($request);
    }

    /**
     * Return user detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'name' => ['required'],
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        $data['password_crypt'] = Crypt::encryptString($request->password);
        User::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,' . $id,
            // 'password' => ['required', 'confirmed'],
            'name' => ['required'],
        ]);

        $user = User::find($id);
        // if ($user->email != $request->email) {
        //     $this->validate($request, [
        //         'email' => ['required', 'email', 'unique:users,email'],
        //     ]);
        // }

        $data = $request->all();

        $user->update($data);
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('/#/admin/agents');
    }
}
