<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIAdminUsersController extends Controller
{
    public function getAll(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => "success",
            'data' => User::all()
        ], 200);
    }

    public function get(Request $request)
    {
        $user = User::where('user_id', $request->user_id)->first();

        return response()->json([
            'success' => true,
            'message' => "success",
            'data' => $user
        ], 200);
    }

    public function update(Request $request){
        $user = User::where('user_id', $request->user_id)->first();

        $user->user_name = $request->name;
        $user->user_username = $request->username;
        $user->user_role = $request->role;
        $user->user_dob = date('Y-m-d', strtotime($request->dob));
        $user->user_phone_number = $request->phone_number;
        $user->user_address = $request->address;
        $user->user_jk = $request->jk;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => "success",
            'data' => $user
        ], 200);
    }

    public function changePassword(Request $request){
        $user = User::where('user_id', $request->user_id)->first();

        $user->user_password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'success' => true,
            'message' => "success",
            'data' => $user
        ], 200);
    }

    public function insert(Request $request)
    {
        $user = User::create([
            'user_name' => $request->name,
            'user_username' => $request->username,
            'user_password' => Hash::make($request->password),
            'user_dob' => date('Y-m-d', strtotime($request->dob)),
            'user_address' => $request->address,
            'user_phone_number' => $request->phone_number,
            'user_jk' => $request->jk,
            'user_status' => 1,
            'user_role' => $request->role
        ]);

        return response()->json([
            'success' => true,
            'message' => "Berhasil registrasi user!",
            'data' => $user
        ], 200);
    }

    public function delete(Request $request)
    {
        $user = User::where('user_id', $request->user_id)->first();

        $user->user_status = 1 - $user->user_status;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus user!",
            'data' => $user
        ], 200);
    }
}
