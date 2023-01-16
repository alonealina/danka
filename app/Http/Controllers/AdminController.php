<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminUser;
use App\Models\LoginLog;
use App\Rules\LoginIdCheck;
use DB;

class AdminController extends Controller
{
    public function admin_regist(Request $request)
    {
        return view('admin_regist');
    }

    public function admin_store(Request $request)
    {
        $rules = [
            'login_id' => ['required', new LoginIdCheck()],
        ];

        $messages = [
            'login_id.required' => 'IDを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

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
        $admin_users = DB::select("SELECT user.id AS user_id, user.login_id AS login_id, name, 
        DATE_FORMAT(user.created_at, '%Y/%m/%d') AS created_at, DATE_FORMAT(max_time, '%Y/%m/%d') AS max_time FROM admin_users user
        LEFT JOIN (
          SELECT login_id, MAX(login_time) AS max_time
          FROM login_log
          GROUP BY login_id) AS log
          ON user.login_id = log.login_id
          ORDER BY user_id;");

        $login_logs = LoginLog::orderBy("login_time", "desc")->get();

        return view('admin_list', [
            'admin_users' => $admin_users,
            'login_logs' => $login_logs,
        ]);
    }

    public function admin_delete($id)
    {
        DB::beginTransaction();
        try {
            $user = AdminUser::find($id);
            AdminUser::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin_list')->with('message', $user->login_id .' '. $user->name . ' を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
