<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LoginLog;
use App\Rules\LoginCheck;
use DB;

class LoginController extends Controller
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
        $rules = [
            'login_id' => ['required', new LoginCheck($request['password'])],
        ];
        $messages = [
            'login_id.required' => 'IDを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

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
            return redirect(route('danka_search'));
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
