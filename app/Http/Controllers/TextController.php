<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Text;
use App\Models\TextCategory;
use App\Rules\TextCategoryCheck;
use DB;

class TextController extends Controller
{
    public function text_regist(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('text_regist', [
            'text_categories' => $text_categories,
        ]);
    }

    public function text_store(Request $request)
    {
        $text = new Text;

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
            return redirect()->to('text_list')->with('message', '文章の登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


    public function text_list(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('text_list', [
            'text_categories' => $text_categories,
        ]);
    }

    public function text_show($category_id)
    {
        $category = TextCategory::find($category_id);
        $text_list = Text::where('category_id', $category_id)->get();

        return view('text_show', [
            'category' => $category,
            'text_list' => $text_list,

        ]);
    }


    public function text_category_list(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('text_category_list', [
            'text_categories' => $text_categories,
        ]);
    }

    public function text_category_store(Request $request)
    {
        $rules = [
            'name' => ['required', new TextCategoryCheck()],
        ];

        $messages = [
            'name.required' => 'IDを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $text_category = new TextCategory;

        $request = $request->all();
        $fill_data = [
            'name' => $request['name'],
        ];

        DB::beginTransaction();
        try {
            $text_category->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('text_category_list')->with('message', 'カテゴリの登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function text_category_delete($id)
    {
        DB::beginTransaction();
        try {
            TextCategory::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('text_category_list')->with('message', 'カテゴリを削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
