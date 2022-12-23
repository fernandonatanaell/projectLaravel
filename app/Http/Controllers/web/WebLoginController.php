<?php

namespace App\Http\Controllers\web;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebLoginController extends Controller
{
    public function indexLogin(Request $request)
    {
        return view('pages.login');
    }

    public function doLogin(Request $request)
    {
        // dd($request->all());
        $username = $request->username;
        $password = $request->password;
        $remember = false;

        if (isset($request->remember))
            $remember = true;

        $req = Request::create('/api/dologin', 'POST', [
            'username' => $username,
            'password' => $password,
            'remember' => $remember
        ]);

        $response = ApiHelper::getResponse($req);

        if ($response->success == true) {
            return redirect('/');
        } else {
            alert()->error('Ooppss!!', $response->message);
            return redirect()->route('login')->with('error', $response->message);
        }
    }

    public function doLogout(Request $request)
    {
        $req = Request::create('/api/dologout', 'GET');

        ApiHelper::getResponse($req);

        return redirect()->route('login');
    }
}
