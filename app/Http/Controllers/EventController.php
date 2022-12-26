<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Text;
use App\Models\TextCategory;
use App\Models\EventDate;
use App\Models\EventBook;
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

    public function event_regist($id)
    {
        $category = TextCategory::find($id);

        return view('event_regist', [
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

    public function event_book_regist($id)
    {

        $event_date = EventDate::find($id);
        $category = TextCategory::find($event_date->category_id);

        return view('event_book_regist', [
            'category' => $category,
            'event_date' => $event_date,
        ]);
    }

    public function event_book_store(Request $request)
    {
        $event_book = new EventBook();

        $request = $request->all();
        $fill_data = [
            'date_id' => $request['date_id'],
            'name' => $request['name'],
            'name_kana' => $request['name_kana'],
            'tel' => $request['tel'],
        ];

        DB::beginTransaction();
        try {
            $event_book->fill($fill_data)->save();
            DB::commit();
            // return redirect()->route('event_show', $request['category_id'])->with('message', '予約追加が完了いたしました。');
            return redirect()->route('event_show', $request['date_id'])->with('message', '予約追加が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


}
