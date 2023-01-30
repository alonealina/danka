<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ItemCategory;
use App\Models\TextCategory;
use App\Models\EventDate;
use App\Models\EventBook;
use App\Models\Danka;
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
        $event_dates = DB::select('SELECT event_date.id as id, event_date.created_at as created_at, name, danka_count
        FROM event_date
        LEFT JOIN (
        SELECT date_id , COUNT(date_id) AS date_id_count
        FROM event_book
        GROUP BY date_id) as event_book
        ON id = event_book.date_id
        WHERE category_id = ?
        ORDER BY created_at DESC', [$category_id]);

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

    public function event_regist_search(Request $request)
    {
        $filter_array = $request->all();
        $meinichi_month = isset($filter_array['meinichi_month']) ? $filter_array['meinichi_month'] : null;
        $kaiki_before = isset($filter_array['kaiki_before']) ? $filter_array['kaiki_before'] : null;
        $kaiki_after = isset($filter_array['kaiki_after']) ? $filter_array['kaiki_after'] : null;
        $payment_before = isset($filter_array['payment_before']) ? $filter_array['payment_before'] : null;
        $payment_after = isset($filter_array['payment_after']) ? $filter_array['payment_after'] : null;
        $price_min = isset($filter_array['price_min']) ? $filter_array['price_min'] : null;
        $price_max = isset($filter_array['price_max']) ? $filter_array['price_max'] : null;
        $segaki_flg = isset($filter_array['segaki_flg']) ? $filter_array['segaki_flg'] : null;
        $star_flg = isset($filter_array['star_flg']) ? $filter_array['star_flg'] : null;
        $yakushiji_flg = isset($filter_array['yakushiji_flg']) ? $filter_array['yakushiji_flg'] : null;
        $kaiki_flg = isset($filter_array['kaiki_flg']) ? $filter_array['kaiki_flg'] : null;
        $freeword = isset($filter_array['freeword']) ? $filter_array['freeword'] : null;
        $item_category_id = isset($filter_array['item_category_id']) ? $filter_array['item_category_id'] : null;

        $category_id = $filter_array['category_id'];
        $event_name = $filter_array['event_name'];
        $category_name = TextCategory::find($category_id)->name;

        $item_categories = ItemCategory::get();

        $query = Danka::select('*')->select('hikuyousya.id as id')->selectRaw("
        TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki
        ")->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id');


        if (isset($meinichi_month)) {
            $meinichi_month = str_pad($meinichi_month, 2, 0, STR_PAD_LEFT);
            $query->whereRaw("DATE_FORMAT(meinichi, '%m') = ?", [$meinichi_month]);
        }

        if (isset($segaki_flg)) {
            $query->where('segaki_flg', '1');
        }

        if (isset($star_flg)) {
            $query->where('star_flg', '1');
        }

        if (isset($yakushiji_flg)) {
            $query->where('yakushiji_flg', '1');
        }

        if (isset($kaiki_flg)) {
            $query->where('kaiki_flg', '1');
        }

        if (!empty($kaiki_before)) {
            $kaiki_before_tmp = $kaiki_before == 1 ? 0 : $kaiki_before - 2;
            $query->having('kaiki', '>=', $kaiki_before_tmp);
        }
        if (!empty($kaiki_after)) {
            $kaiki_after_tmp = $kaiki_after == 1 ? 0 : $kaiki_after - 2;
            $query->having('kaiki', '<=', $kaiki_after_tmp);
        }

        $hikuyousya_ids = $query->get()->pluck('id');

        $query = Danka::select('danka.id as id', 'danka.name as name', 'common_name', 
            'posthumous', 'meinichi', 'item_category.name as category_name', 'payment_date', 'hikuyousya.id as hikuyousya_id', 'total')
            ->selectRaw("TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki")
        ->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')->leftJoin('deal_detail', 'hikuyousya.id', '=', 'hikuyousya_id')
        ->leftJoin('item', 'item.id', '=', 'deal_detail.item_id')->leftJoin('item_category', 'item_category.id', '=', 'item.category_id')
        ->whereIn('hikuyousya.id', $hikuyousya_ids);

        if (isset($item_category_id)) {
            $query->where('item.category_id', $item_category_id);
        }

        if (!empty($payment_before)) {
            $query->whereDate('payment_date', '>=', $payment_before);
        }
        if (!empty($payment_after)) {
            $query->whereDate('payment_date', '<=', $payment_after);
        }

        if (!empty($price_min)) {
            $query->where('total', '>=', $price_min);
        }
        if (!empty($price_max)) {
            $query->where('total', '<=', $price_max);
        }

        $hikuyousya_ids = $query->pluck('hikuyousya_id');
        $hikuyousya_count = count(array_unique($hikuyousya_ids->toArray()));

        $number = \Request::get('number');
        if (isset($number)) {
            $danka_list = $query->orderBy('danka_id')->paginate($number)
            ->appends(["number" => $number]);
        } else {
            $danka_list = $query->orderBy('danka_id')->paginate(10);
        }


        $danka_count = Danka::select('danka_id')->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')
        ->whereIn('hikuyousya.id', $hikuyousya_ids)->groupBy('danka_id')->get()->count();



        return view('event_regist_search', [
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'meinichi_month' => $meinichi_month,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'kaiki_flg' => $kaiki_flg,
            'freeword' => $freeword,
            'item_categories' => $item_categories,
            'item_category_id' => $item_category_id,
            'hikuyousya_count' => $hikuyousya_count,
            'danka_count' => $danka_count,
            'number' => $number,

            'danka_list' => $danka_list,
        ]);
    }

    public function event_store(Request $request)
    {
        $event_date = new EventDate;

        $request = $request->all();
        $fill_data = [
            'category_id' => $request['category_id'],
            'name' => $request['event_name'],
            'danka_count' => $request['danka_count'],
        ];

        DB::beginTransaction();
        try {
            $event_date->fill($fill_data)->save();
            DB::commit();
            return redirect()->route('event_show', $request['category_id'])->with('message', '行事の登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function event_book_show($date_id)
    {
        $event_date = EventDate::find($date_id);
        $category = TextCategory::find($event_date->category_id);
        $event_books = EventBook::where('date_id', $date_id)->get();

        return view('event_book_show', [
            'event_date' => $event_date,
            'category' => $category,
            'event_books' => $event_books,
        ]);
    }


    public function event_book_regist($id)
    {

        $event_date = EventDate::find($id);
        $category = TextCategory::find($event_date->category_id);

        return view('event_book_regist', [
            'event_date' => $event_date,
            'category' => $category,
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
            return redirect()->route('event_book_show', $request['date_id'])->with('message', '予約追加が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


}
