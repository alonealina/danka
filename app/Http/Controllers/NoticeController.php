<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Notice;
use App\Models\TextCategory;
use App\Rules\TextCategoryCheck;
use DB;

class NoticeController extends Controller
{
    public function notice_list(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('notice_list', [
            'text_categories' => $text_categories,
        ]);
    }

    public function notice_show($category_id)
    {
        $category = TextCategory::find($category_id);
        $text_list = Notice::where('category_id', $category_id)->get();

        return view('notice_show', [
            'category' => $category,
            'text_list' => $text_list,

        ]);
    }
    public function notice_regist(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('notice_regist', [
            'text_categories' => $text_categories,
        ]);
    }

    public function notice_store(Request $request)
    {
        $text = new Notice;

        $request = $request->all();
        $fill_data = [
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'content' => $request['content'],
        ];

        DB::beginTransaction();
        try {
            $text->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('notice_list')->with('message', 'お知らせの登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function notice_edit($id)
    {
        $text_categories = TextCategory::get();
        $text = Notice::find($id);

        return view('notice_edit', [
            'text_categories' => $text_categories,
            'text' => $text,
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

    public function notice_delete($id)
    {
        DB::beginTransaction();
        try {
            Notice::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('notice_list')->with('message', 'お知らせを削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }



}
