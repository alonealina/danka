<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class V2LoginController extends Controller
{
    public function login()
    {
        if(session()->has('login_id')){
            return redirect(route('summary'));
        }
        return view('login');
    }

    public function login2()
    {
        return view('login2');
    }

    public function login_function(Request $request)
    {
        session(['login_id' => 1]);
        return redirect(route('summary'));
    }

    public function login_function2(Request $request)
    {
        session(['login_id' => 1]);
        return redirect(route("v2_summary"));
    }

    public function logout(Request $request)
    {
        session()->forget('login_id');
        return redirect(route('login'));
    }

}
