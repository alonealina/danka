<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\LoginLog;
use DB;

class AdminController extends Controller
{
    public function admin_regist(Request $request)
    {
        return view('admin_regist');
    }

    public function admin_store(Request $request)
    {
        $admin_user = new AdminUser;

        $request = $request->all();
        $fill_data = [
            'login_id' => $request['login_id'],
            'password' => $request['password'],
            'name' => $request['name'],
        ];

        DB::beginTransaction();
        try {
            $admin_user->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('admin_regist')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function admin_list(Request $request)
    {
        return view('add_acount_complete')->with(BFF::outputDetail($request));
    }

}
