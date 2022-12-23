<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class APILoginRegisterController extends Controller
{
    public function doLogout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        cookie()->queue(cookie()->forget('loginToken'));

        return response()->json([
            'success' => true,
            'message' => "Berhasil logout!"
        ], 200);
    }

    public function doLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;

        $user = User::where('user_username', $username)->first();

        $success = true;
        $message = "";
        $token = "";
        $data = [];

        if($user){ // PEGAWAI TERDAFTAR DI DATABASE
            if(! Hash::check($password, $user->user_password)){ // PASSWORD SALAH
                $success = false;
                $message = "Password salah!";
            } else if($user->user_status == 0){ // USER DIPECAT
                $success = false;
                $message = "Anda telah dipecat!";
            } else {
                $message = "Hallo User!";
                $data = $user;

                $ability = "";

                if ($user->user_role == "0") {
                    $ability = "owner";
                } else if ($user->user_role == "1") {
                    $ability = "manajer";
                } else if ($user->user_role == "2") {
                    $ability = "teknisi";
                } else {
                    $ability = "kasir";
                }

                $token = $user->createToken('auth_token', [$ability])->plainTextToken;
                // Session::put('loginToken', $token);

                if ($remember) {
                    cookie()->queue(cookie()->forever('loginToken', $token));
                } else {
                    cookie()->queue(cookie('loginToken', $token, 60*12));
                }
            }
        } else {
            $success = false;
            $message = "User tidak ditemukan!";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'token' => $token,
            'data' => $data
        ], 200);
    }

    public function doRegister(Request $request)
    {
        // $fields = $request->validate([
        //     'name' => "required|max:50|bail",
        //     'username' => "required|unique:users,user_username|bail",
        //     'password' => "required|confirmed|bail",
        //     'dob' => "required",
        //     'address' => "required",
        //     'phone_number' => "required|digits_between:8,14|bail",
        //     'jk' => "required|in:L,P",
        //     'role' => "required|in:0,1,2,3"
        // ], [
        //     'name.required' => ':attribute tidak boleh kosong!',
        //     'name.max' => ":attribute maximal 50 karakter!",
        //     'username.required' => ':attribute tidak boleh kosong!',
        //     'username.unique' => ':attribute telah dipakai!',
        //     'password.required' => ':attribute tidak boleh kosong!',
        //     'password.confirmed' => ':attribute tidak sama!',
        //     'dob.required' => ':attribute tidak boleh kosong!',
        //     'address.required' => ':attribute tidak boleh kosong!',
        //     'phone_number.required' => ":attribute tidak boleh kosong!",
        //     'phone_number.digits_between' => ":attribute harus 8-14 digit!",
        //     'jk.required' => ":attribute harus dipilih!",
        //     'jk.in' => ":attribute tidak valid!",
        //     'role.required' => ":attribute harus dipilih!",
        //     'role.in' => ":attribute tidak valid!",
        // ], [
        //     'name' => 'Nama user',
        //     'username' => 'Username',
        //     'password' => 'Password',
        //     'dob' => 'Tanggal lahir',
        //     'address' => 'Alamat',
        //     'phone_number' => 'Nomor telepon',
        //     'jk' => 'Jenis kelamin',
        //     'role' => 'Role',
        // ]);

        $user = User::create([
            'user_name' => $request->name,
            'user_username' => $request->username,
            'user_password' => Hash::make($request->password),
            'user_dob' => DateTime::createFromFormat('d-m-Y', $request->dob),
            'user_address' => $request->address,
            'user_phone_number' => $request->phone_number,
            'user_jk' => $request->jk,
            'user_status' => 1,
            'user_role' => $request->role,
            'user_salary' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => "Berhasil registrasi user!",
            'data' => $user
        ], 200);
    }


}
