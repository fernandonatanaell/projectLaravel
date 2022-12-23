<?php

namespace App\Http\Controllers\web\Service;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

class WebServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();
        $customers = Customer::all();
        $teknisis = User::where('user_role', '2')->get();

        return view('pages.master.services.master_service', compact('services', 'customers', 'teknisis'));
    }

    public function insert(Request $request){

        $request->validate([
            'customer' => "required",
            'description' => "required",
            'date' => "required",
            'firstTech' => "required",
            'secondTech' => "required",
            'cost' => "required|numeric|min:1000|bail",
        ], [
            'customer.required' => ':attribute tidak boleh kosong!',
            'description.required' => ':attribute tidak boleh kosong!',
            'date.required' => ':attribute tidak boleh kosong!',
            'firstTech.required' => ':attribute tidak boleh kosong!',
            'secondTech.required' => ':attribute tidak boleh kosong!',
            'cost.required' => ':attribute tidak boleh kosong!',
            'cost.numeric' => ':attribute harus berupa angka!',
            'cost.min' => ':attribute minimal Rp 1.000!',
        ], [
            'customer' => 'Customer',
            'description' => 'Deskripsi',
            'date' => 'Tanggal',
            'firstTech' => 'First Technician',
            'secondTech' => 'Second Technician',
            'cost' => 'Biaya'
        ]);

        $service = Service::create([
            'service_description' => $request->description,
            'service_date' => $request->date,
            'customer_id' => $request->customer,
            'service_cost' => $request->cost,
            'service_status' => '0',
            'service_payment_status' => '0'
        ]);

        $service->Users()->attach($request->firstTech);
        $service->Users()->attach($request->secondTech);

        alert()->success('Yayyy!!', 'Servis berhasil ditambahkan!');
        return redirect()->route('master_service')->with('success');
    }

    public function update(Request $request)
    {
        $request->validate([
            'customer' => "required",
            'description' => "required",
            'date' => "required",
            'firstTech' => "required",
            'secondTech' => "required",
            'cost' => "required|numeric|min:1000|bail",
        ], [
            'customer.required' => ':attribute tidak boleh kosong!',
            'description.required' => ':attribute tidak boleh kosong!',
            'date.required' => ':attribute tidak boleh kosong!',
            'firstTech.required' => ':attribute tidak boleh kosong!',
            'secondTech.required' => ':attribute tidak boleh kosong!',
            'cost.required' => ':attribute tidak boleh kosong!',
            'cost.numeric' => ':attribute harus berupa angka!',
            'cost.min' => ':attribute minimal Rp 1.000!',
        ], [
            'customer' => 'Customer',
            'description' => 'Deskripsi',
            'date' => 'Tanggal',
            'firstTech' => 'First Technician',
            'secondTech' => 'Second Technician',
            'cost' => 'Biaya'
        ]);

        $service = Service::find($request->service_id);
        $service->service_description = $request->description;
        $service->service_date = $request->date;
        $service->customer_id = $request->customer;
        $service->service_cost = $request->cost;

        $service->Users()->detach();
        $service->Users()->attach($request->firstTech);
        $service->Users()->attach($request->secondTech);

        $service->save();

        alert()->success('Yayyy!!', 'Servis berhasil diupdate!');
        return redirect()->route('master_service')->with('success');
    }
    public function sendmail(Request $request) {
        // kirim email ke customer
        $data['username']  = "bonboncantik";
        $data['nama']  = "bonbon";
        $data['alamat']  = "ngagel jaya selatan 12";
        $data['status']  = "selesai";
        $data['notaorder']  = "1234";

        $request->email    = "jonathan.aureliusg@gmail.com";
        Mail::send('mail.MailNotify',['data'=>$data],
            function ($message) use ($request)
            {
                $message->subject("your order");
                $message->from("jonathan_a20@mhs.istts.ac.id", "jonathan_a20@mhs.istts.ac.id");
                $message->to($request->email);
            }
        );
        echo "<h1>sukses Kirim</h1>";
    }

    public function done(Request $request){
        $service = Service::find($request->service_id);
        $service->service_status = 1 - $service->service_status;
        $service->save();

        alert()->success('Yayyy!!', 'Status servis #' . $request->service_id . ' berhasil diupdate!');
        return redirect()->route('master_service')->with('success');
    }

    public function paid(Request $request){
        $service = Service::find($request->service_id);
        $service->service_payment_status = 1 - $service->service_payment_status;
        $service->save();

        alert()->success('Yayyy!!', 'Status pembayaran servis #' . $request->service_id . ' berhasil diupdate!');
        return redirect()->route('master_service')->with('success');
    }
}
