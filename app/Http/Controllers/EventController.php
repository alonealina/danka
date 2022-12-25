<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Text;
use App\Models\TextCategory;
use App\Models\EventDate;
use App\Rules\TextCategoryCheck;
use DB;

class EventController extends Controller
{
    public function event_list(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('event_list', [
            'text_categories' => $text_categories,
        ]);
    }

    public function event_show($category_id)
    {
        $category = TextCategory::find($category_id);
        $event_dates = EventDate::where('category_id', $category_id)->get();

        return view('event_show', [
            'category' => $category,
            'event_dates' => $event_dates,

        ]);
    }

    public function event_add($id)
    {
        $category = TextCategory::find($id);

        return view('event_add', [
            'category' => $category,

        ]);
    }

    public function event_store(Request $request)
    {
        $event_date = new EventDate;

        $request = $request->all();
        $fill_data = [
            'category_id' => $request['category_id'],
            'date' => $request['date'],
            'place' => $request['place'],
            'max' => $request['max'],
        ];

        DB::beginTransaction();
        try {
            $event_date->fill($fill_data)->save();
            DB::commit();
            return redirect()->route('event_show', $request['category_id'])->with('message', '行事予定日の登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


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

    public function text_edit($id)
    {
        $text_categories = TextCategory::get();
        $text = Text::find($id);

        return view('text_edit', [
            'text_categories' => $text_categories,
            'text' => $text,
        ]);
    }

    public function text_update(Request $request)
    {
        $request = $request->all();
        $text = Text::find($request['id']);

        $fill_data = [
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'content' => $request['content'],
        ];

        DB::beginTransaction();
        try {
            $text->update($fill_data);
            DB::commit();
            return redirect()->to('text_list')->with('message', '文章の編集が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function text_delete($id)
    {
        DB::beginTransaction();
        try {
            Text::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('text_list')->with('message', '文章を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
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
