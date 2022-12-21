<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginLog;
use DB;

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
        $login_log = new LoginLog;

        $request = $request->all();
        $fill_data = [
            'login_id' => $request['login_id'],
        ];

        DB::beginTransaction();
        try {
            $login_log->fill($fill_data)->save();
            DB::commit();
            session(['login_id' => 1]);
            return redirect(route('summary'));
        } catch (\Exception $e) {
            DB::rollback();
        }

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
