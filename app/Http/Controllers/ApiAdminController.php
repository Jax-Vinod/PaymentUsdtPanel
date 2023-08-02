<?php

namespace App\Http\Controllers;

use App\DataTables\TraderTransferDataTable;
use App\DataTables\UserDataTable;
use App\DataTables\UsdtPurchaseDataTable;
use App\DataTables\PayoutDataTable;
use App\DataTables\NoticeDataTable;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAdminController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function trader_transfers_list(Request $request, TraderTransferDataTable $table)
    {
        return $table->render($request);
    }

    public function traders_list(Request $request, UserDataTable $table)
    {
        return $table->traders($request);
    }

    public function agents_list(Request $request, UserDataTable $table)
    {
        return $table->agents($request);
    }

    public function admins_list(Request $request, UserDataTable $table)
    {
        return $table->admins($request);
    }

    public function usdt_purchases_list(Request $request, UsdtPurchaseDataTable $table)
    {
        return $table->render($request);
    }

    public function payouts_list(Request $request, PayoutDataTable $table)
    {
        return $table->render($request);
    }

    public function notices_list(Request $request, NoticeDataTable $table)
    {
        return $table->render($request);
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
        return Auth::guard('admin');
    }
}
