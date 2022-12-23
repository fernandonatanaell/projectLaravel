<?php

namespace App\Http\Controllers\web\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
            'name' => "required|max:50|bail",
            'email' => "required|email|bail",
            'address' => "required",
            'phone_number' => "required|digits_between:8,14|bail",
            'jk' => "required|in:L,P"
        ], [
            'name.required' => ':attribute tidak boleh kosong!',
            'name.max' => ":attribute maximal 50 karakter!",
            'email.required' => ':attribute tidak boleh kosong!',
            'email.email' => ':attribute harus dalam format email!',
            'address.required' => ':attribute tidak boleh kosong!',
            'phone_number.required' => ":attribute tidak boleh kosong!",
            'phone_number.digits_between' => ":attribute harus 8-14 digit!",
            'jk.required' => ":attribute harus dipilih!",
            'jk.in' => ":attribute tidak valid!",
        ], [
            'name' => 'Nama user',
            'email' => 'Email',
            'address' => 'Alamat',
            'phone_number' => 'Nomor telepon',
            'jk' => 'Jenis kelamin',
        ]);

        $customer = Customer::create([
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_address' => $request->address,
            'customer_phone_number' => $request->phone_number,
            'customer_jk' => $request->jk,
        ]);

        alert()->success('Yayyy!!', 'Customer berhasil ditambahkan!');
        return redirect()->route('master_customer')->with('success');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => "required|max:50|bail",
            'email' => "required|email|bail",
            'address' => "required",
            'phone_number' => "required|digits_between:8,14|bail",
            'jk' => "required|in:L,P"
        ], [
            'name.required' => ':attribute tidak boleh kosong!',
            'name.max' => ":attribute maximal 50 karakter!",
            'email.required' => ':attribute tidak boleh kosong!',
            'email.email' => ':attribute harus dalam format email!',
            'address.required' => ':attribute tidak boleh kosong!',
            'phone_number.required' => ":attribute tidak boleh kosong!",
            'phone_number.digits_between' => ":attribute harus 8-14 digit!",
            'jk.required' => ":attribute harus dipilih!",
            'jk.in' => ":attribute tidak valid!",
        ], [
            'name' => 'Nama user',
            'email' => 'Email',
            'address' => 'Alamat',
            'phone_number' => 'Nomor telepon',
            'jk' => 'Jenis kelamin',
        ]);

        $customer = Customer::where('customer_id', $request->customer_id)->first();

        $customer->customer_name = $request->name;
        $customer->customer_email = $request->email;
        $customer->customer_address = $request->address;
        $customer->customer_phone_number = $request->phone_number;
        $customer->customer_jk = $request->jk;

        $customer->save();

        alert()->success('Yayyy!!', 'Customer berhasil diupdate!');
        return redirect()->route('master_customer')->with('success');
    }

    public function delete(Request $request)
    {
        $customer = Customer::where('customer_id', $request->customer_id)->first();
        $customer->deleted_at = Carbon::now();
        $customer->save();

        alert()->success('Yayyy!!', $customer["customer_name"] . ' berhasil dihapus!');
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $customer = Customer::withTrashed()->where('customer_id', $request->customer_id)->first();
        $customer->deleted_at = null;
        $customer->save();

        alert()->success('Yayyy!!', $customer["customer_name"] . ' berhasil direstore!');
        return redirect()->back();
    }
}
