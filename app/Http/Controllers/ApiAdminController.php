<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class ApiAdminController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * user list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user_list()
    {
        $users = Admin::all();
        return response()->json(['users' => $users]);
    }

    /**
     * Make new user
     */
    public function addUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        Admin::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);
        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Get user info
     */
    public function getUser($user_id)
    {
        $user = Admin::findOrFail($user_id);
        return response()->json($user, 200);
    }

    /**
     * Edit user info
     */
    public function editUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->get('user_id'),
            'user_id' => 'required',
        ]);
        $user = Admin::findOrFail($request->get('user_id'));
        $user->update([
            'email' => $request->get('email'),
            'name' => $request->get('name')
        ]);
        return response()->json(['success' => 'success'], 200);
    }
    /**
     * Delete user
     */
    public function deleteUser($user_id)
    {
        Admin::findOrFail($user_id)->delete();
        return redirect('/#/users_list');
    }


    public function guard()
    {
        return \Auth::Guard('api');
    }
}
