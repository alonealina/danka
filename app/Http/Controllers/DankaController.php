<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Danka;
use App\Models\TextCategory;
use App\Models\DankaDate;
use App\Models\DankaBook;
use App\Rules\TextCategoryCheck;
use DB;

class DankaController extends Controller
{
    public function danka_list(Request $request)
    {
        $text_categories = TextCategory::get();

        return view('danka_list', [
            'text_categories' => $text_categories,
        ]);
    }

    public function danka_show($category_id)
    {
        $category = TextCategory::find($category_id);
        $danka_dates = DB::select('SELECT danka_date.id as id, date, max, date_id_count
        FROM danka_date
        LEFT JOIN (
        SELECT date_id , COUNT(date_id) AS date_id_count
        FROM danka_book
        GROUP BY date_id) as danka_book
        ON id = danka_book.date_id
        WHERE category_id = ?
        ORDER BY date DESC', [$category_id]);

        return view('danka_show', [
            'category' => $category,
            'danka_dates' => $danka_dates,
        ]);
    }

    public function danka_regist()
    {
        return view('danka_regist');
    }

    public function danka_store(Request $request)
    {
        $danka = new Danka;

        $request = $request->all();
        $fill_data = [
            'chart_no' => $request['chart_no'],
            'name' => $request['name'],
            'name_kana' => $request['name_kana'],
            'gender' => $request['gender'],
            'tel' => $request['tel'],
            'mobile' => $request['mobile'],
            'mail' => $request['mail'],
            'zip' => $request['zip'],
            'pref' => $request['pref'],
            'city' => $request['city'],
            'address' => $request['address'],
            'building' => $request['building'],
            'introducer' => $request['introducer'],
            'notices' => $request['notices'],
            'segaki_flg' => isset($request['segaki_flg']) ? $request['segaki_flg'] : 0,
            'star_flg' => isset($request['star_flg']) ? $request['star_flg'] : 0,
            'kaiki_flg' => isset($request['kaiki_flg']) ? $request['kaiki_flg'] : 0,
        ];

        DB::beginTransaction();
        try {
            $danka->fill($fill_data)->save();
            DB::commit();
            return redirect()->route('danka_regist')->with('message', '行事予定日の登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function danka_book_show($date_id)
    {
        $danka_date = DankaDate::find($date_id);
        $category = TextCategory::find($danka_date->category_id);
        $danka_books = DankaBook::where('date_id', $date_id)->get();

        return view('danka_book_show', [
            'danka_date' => $danka_date,
            'category' => $category,
            'danka_books' => $danka_books,
        ]);
    }


    public function danka_book_regist($id)
    {

        $danka_date = DankaDate::find($id);
        $category = TextCategory::find($danka_date->category_id);

        return view('danka_book_regist', [
            'danka_date' => $danka_date,
            'category' => $category,
        ]);
    }

    public function danka_book_store(Request $request)
    {
        $danka_book = new DankaBook();

        $request = $request->all();
        $fill_data = [
            'date_id' => $request['date_id'],
            'name' => $request['name'],
            'name_kana' => $request['name_kana'],
            'tel' => $request['tel'],
        ];

        DB::beginTransaction();
        try {
            $danka_book->fill($fill_data)->save();
            DB::commit();
            return redirect()->route('danka_book_show', $request['date_id'])->with('message', '予約追加が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


}
