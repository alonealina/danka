<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Notice;
use App\Models\TextCategory;
use App\Rules\TextCategoryCheck;
use DB;

class PaymentController extends Controller
{
    public function unclaimed_list(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('unclaimed_list', [
            'text_categories' => $text_categories,
        ]);
    }

    public function unpaid_list(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('unpaid_list', [
            'text_categories' => $text_categories,
        ]);
    }

    public function paid_list(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('paid_list', [
            'text_categories' => $text_categories,
        ]);
    }

    public function notice_update(Request $request)
    {
        $request = $request->all();
        $text = Notice::find($request['id']);

        $fill_data = [
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'content' => $request['content'],
        ];

        DB::beginTransaction();
        try {
            $text->update($fill_data);
            DB::commit();
            return redirect()->to('notice_list')->with('message', 'お知らせの編集が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }




}
