<?php

namespace App\Http\Controllers\web\Admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebUserController extends Controller
{
    public function index(Request $request)
    {
        $req = Request::create('api/users/getall', 'GET');

        $response = ApiHelper::getResponse($req);
        $users = $response->data;

        return view('pages.master.users.master_user', compact('users'));
    }

    public function add(Request $request){
        return view('pages.master.users.add_user');
    }

    public function doinsert(Request $request)
    {
        $request->validate([
            'name' => "required|max:50|bail",
            'username' => "required|unique:users,user_username|max:18|bail",
            'password' => "required|confirmed|bail",
            'dob' => "required",
            'address' => "required",
            'phone_number' => "required|digits_between:8,14|bail",
            'jk' => "required|in:L,P",
            'role' => "required|in:0,1,2,3"
        ], [
            'name.required' => ':attribute tidak boleh kosong!',
            'name.max' => ":attribute maximal 50 karakter!",
            'username.required' => ':attribute tidak boleh kosong!',
            'username.unique' => ':attribute telah dipakai!',
            'username.max' => ':attribute maximal 18 karakter!',
            'password.required' => ':attribute tidak boleh kosong!',
            'password.confirmed' => ':attribute tidak sama!',
            'dob.required' => ':attribute tidak boleh kosong!',
            'address.required' => ':attribute tidak boleh kosong!',
            'phone_number.required' => ":attribute tidak boleh kosong!",
            'phone_number.digits_between' => ":attribute harus 8-14 digit!",
            'jk.required' => ":attribute harus dipilih!",
            'jk.in' => ":attribute tidak valid!",
            'role.required' => ":attribute harus dipilih!",
            'role.in' => ":attribute tidak valid!",
        ], [
            'name' => 'Nama user',
            'username' => 'Username',
            'password' => 'Password',
            'dob' => 'Tanggal lahir',
            'address' => 'Alamat',
            'phone_number' => 'Nomor telepon',
            'jk' => 'Jenis kelamin',
            'role' => 'Role',
        ]);

        $req = Request::create('api/users/insert', 'POST', [
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'dob' => $request->dob,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'jk' => $request->jk,
            'role' => $request->role
        ]);

        $response = ApiHelper::getResponse($req);

        alert()->success('Yayyy!!', 'User berhasil ditambahkan!');
        return redirect()->route('master_user')->with('success', $response->message);
    }

    public function edit(Request $request)
    {
        $url = 'api/users/get/' . $request->user_id;
        $req = Request::create($url, 'GET');

        $response = ApiHelper::getResponse($req);

        $user = $response->data;

        return view('pages.master.users.edit_user', compact('user'));
    }

    public function doedit(Request $request)
    {
        // dd($request->all());
        if($request->has('fired')){
            $url = 'api/users/delete/' . $request->user_id;
            $req = Request::create($url, 'GET');

            ApiHelper::getResponse($req);

            alert()->success('Yayyy!!', 'Status user berhasil diupdate!');
            return redirect()->route('master_user');
        }

        $request->validate([
            'name' => "required|max:50|bail",
            'username' => "required|unique:users,user_username,$request->old_username,user_username|max:18|bail",
            'dob' => "required",
            'address' => "required",
            'phone_number' => "required|digits_between:8,14|bail",
            'jk' => "required|in:L,P",
            'role' => "required|in:0,1,2,3"
        ], [
            'name.required' => ':attribute tidak boleh kosong!',
            'name.max' => ":attribute maximal 50 karakter!",
            'username.required' => ':attribute tidak boleh kosong!',
            'username.unique' => ':attribute telah dipakai!',
            'username.max' => ':attribute maximal 18 karakter!',
            'dob.required' => ':attribute tidak boleh kosong!',
            'address.required' => ':attribute tidak boleh kosong!',
            'phone_number.required' => ":attribute tidak boleh kosong!",
            'phone_number.digits_between' => ":attribute harus 8-14 digit!",
            'jk.required' => ":attribute harus dipilih!",
            'jk.in' => ":attribute tidak valid!",
            'role.required' => ":attribute harus dipilih!",
            'role.in' => ":attribute tidak valid!",
        ], [
            'name' => 'Nama user',
            'username' => 'Username',
            'password' => 'Password',
            'dob' => 'Tanggal lahir',
            'address' => 'Alamat',
            'phone_number' => 'Nomor telepon',
            'jk' => 'Jenis kelamin',
            'role' => 'Role',
        ]);

        if ($request->password != "") {
            $request->validate([
                'password' => "required|confirmed|bail",
            ], [
                'password.required' => ':attribute tidak boleh kosong!',
                'password.confirmed' => ':attribute tidak sama!',
            ], [
                'password' => 'Password',
            ]);

            $req = Request::create('api/users/changePassword', 'POST', [
                'user_id' => $request->user_id,
                'password' => $request->password,
            ]);

            ApiHelper::getResponse($req);
        }

        $req = Request::create('api/users/update', 'POST', [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'username' => $request->username,
            'dob' => $request->dob,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'jk' => $request->jk,
            'role' => $request->role
        ]);

        $response = ApiHelper::getResponse($req);

        alert()->success('Yayyy!!', 'User berhasil diupdate!');
        return redirect()->route('master_user')->with('success', $response->message);
    }
}
