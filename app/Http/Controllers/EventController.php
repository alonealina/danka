<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ItemCategory;
use App\Models\TextCategory;
use App\Models\EventDate;
use App\Models\EventBook;
use App\Models\EventSendList;
use App\Models\EventSearchLog;
use App\Models\Danka;
use App\Rules\TextCategoryCheck;
use Symfony\Component\HttpFoundation\StreamedResponse;
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
        $event_dates = DB::select('SELECT event_date.id as id, event_date.created_at as created_at, name, send_flg, danka_count
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

    public function event_send_update($id)
    {
        $event_date = EventDate::find($id);
        $category_id = $event_date->category_id;

        DB::beginTransaction();
        try {
            $fill_data = [
                'send_flg' => 1,
            ];

            $event_date->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('event_show', $category_id)->with('message', 'ステータスの変更が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function event_wait_update($id)
    {
        $event_date = EventDate::find($id);
        $category_id = $event_date->category_id;

        DB::beginTransaction();
        try {
            $fill_data = [
                'send_flg' => 0,
            ];

            $event_date->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('event_show', $category_id)->with('message', 'ステータスの変更が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function event_date_delete($id)
    {
        DB::beginTransaction();
        try {
            $event_date = EventDate::find($id);
            $category_id = $event_date->category_id;
            $event_date->delete();
            DB::commit();
            return redirect()->route('event_show', $category_id)->with('message', '行事リストを削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
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
        $category_id = $filter_array['category_id'];

        if ($category_id == 1) {
            $meinichi_month = isset($filter_array['meinichi_month']) ? $filter_array['meinichi_month'] : null;
            $meinichi_day = isset($filter_array['meinichi_day']) ? $filter_array['meinichi_day'] : null;
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
            $sort_item = isset($filter_array['sort_item']) ? $filter_array['sort_item'] : null;
            $sort_type = isset($filter_array['sort_type']) ? $filter_array['sort_type'] : null;
    
            $event_name = isset($filter_array['event_name']) ? $filter_array['event_name'] : null;
            $category_name = TextCategory::find($category_id)->name;

            $item_categories = ItemCategory::get();

            $query = Danka::select('*')->select('hikuyousya.id as id')->selectRaw("
            TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki
            ")->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id');


            if (isset($meinichi_month)) {
                $month = str_pad($meinichi_month, 2, 0, STR_PAD_LEFT);
                if (isset($meinichi_day)) {
                    $day = str_pad($meinichi_day, 2, 0, STR_PAD_LEFT);
                    $md = $month . $day;
                    $query->whereRaw("DATE_FORMAT(meinichi, '%m%d') = ?", [$md]);

                } else {
                    $query->whereRaw("DATE_FORMAT(meinichi, '%m') = ?", [$month]);
                }
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
                'posthumous', 'meinichi', 'item_category.name as category_name', 'hikuyousya.id as hikuyousya_id', 'total', 'payment_date', 'kaiki_flg')
                ->selectRaw("TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki")
            ->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')->leftJoin('deal_detail', 'hikuyousya.id', '=', 'hikuyousya_id')
            ->leftJoin('deal', 'deal.id', '=', 'deal_detail.deal_id')
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

            if (!empty($freeword)) {
                $freeword = mb_convert_kana($freeword, 's');
                $word_list = explode(" ", $freeword);
                $query->where(function ($query) use ($word_list) {
                    foreach ($word_list as $word) {
                        if (!empty($word)) {
                            $query->orwhere('pref', 'like', "%$word%");
                        }
                    }
                });
            }
    
            $hikuyousya_ids = $query->pluck('hikuyousya_id');
            $hikuyousya_count = count(array_unique($hikuyousya_ids->toArray()));

            if (!empty($sort_item)) {
                $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
            }
        
            $number = \Request::get('number');
            if (isset($number)) {
                $danka_list = $query->orderBy('danka.id')->paginate($number)
                ->appends(["number" => $number]);
            } else {
                $danka_list = $query->orderBy('danka.id')->paginate(10);
            }

            $danka_id_list = Danka::select('danka_id')->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')
            ->whereIn('hikuyousya.id', $hikuyousya_ids)->groupBy('danka_id')->get();
            $danka_count = $danka_id_list->count();
            $danka_id_list = array_unique($danka_id_list->pluck('danka_id')->toArray());
            $danka_id_list = implode(",", array_unique($danka_id_list));

            $hikuyousya_id_list = array_unique($hikuyousya_ids->toArray());
            $hikuyousya_id_list = implode(",", array_unique($hikuyousya_id_list));

            return view('event_regist_search', [
                'category_id' => $category_id,
                'event_name' => $event_name,
                'category_name' => $category_name,
                'meinichi_month' => $meinichi_month,
                'meinichi_day' => $meinichi_day,
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
                'sort_item' => $sort_item,
                'sort_type' => $sort_type,
                'danka_list' => $danka_list,
                'danka_id_list' => $danka_id_list,
                'hikuyousya_id_list' => $hikuyousya_id_list,
            ]);
        } elseif ($category_id == 5) {
            $nokotsubi_before = isset($filter_array['nokotsubi_before']) ? $filter_array['nokotsubi_before'] : null;
            $nokotsubi_after = isset($filter_array['nokotsubi_after']) ? $filter_array['nokotsubi_after'] : null;
            $freeword = isset($filter_array['freeword']) ? $filter_array['freeword'] : null;
            $sort_item = isset($filter_array['sort_item']) ? $filter_array['sort_item'] : null;
            $sort_type = isset($filter_array['sort_type']) ? $filter_array['sort_type'] : null;
    
            $event_name = isset($filter_array['event_name']) ? $filter_array['event_name'] : null;
            $category_name = TextCategory::find($category_id)->name;

            $query = Danka::select('danka.id as id', 'hikuyousya.id as hikuyousya_id', 'name', 'common_name', 'posthumous', 'nokotsubi',
             'nokotsuidobi', 'column', 'nokotsu_no', 'ihai_no')->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')
            ->whereNotNull('nokotsubi');


            if (!empty($nokotsubi_before)) {
                $query->whereDate('nokotsubi', '>=', $nokotsubi_before);
            }
            if (!empty($nokotsubi_after)) {
                $query->whereDate('nokotsubi', '<=', $nokotsubi_after);
            }

            if (!empty($freeword)) {
                $freeword = mb_convert_kana($freeword, 's');
                $word_list = explode(" ", $freeword);
                $query->where(function ($query) use ($word_list) {
                    foreach ($word_list as $word) {
                        if (!empty($word)) {
                            $query->orwhere('pref', 'notices', "%$word%")->orwhere('column', 'like', "%$word%");
                        }
                    }
                });
            }
    
            $hikuyousya_ids = $query->pluck('hikuyousya_id');
            $hikuyousya_count = count(array_unique($hikuyousya_ids->toArray()));

            if (!empty($sort_item)) {
                $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
            }

            $number = \Request::get('number');
            if (isset($number)) {
                $danka_list = $query->orderBy('danka_id')->paginate($number)
                ->appends(["number" => $number]);
            } else {
                $danka_list = $query->orderBy('danka_id')->paginate(10);
            }

            $danka_id_list = Danka::select('danka_id')->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')
            ->whereIn('hikuyousya.id', $hikuyousya_ids)->groupBy('danka_id')->get();
            $danka_count = $danka_id_list->count();
            $danka_id_list = array_unique($danka_id_list->pluck('danka_id')->toArray());
            $danka_id_list = implode(",", array_unique($danka_id_list));

            $hikuyousya_id_list = array_unique($hikuyousya_ids->toArray());
            $hikuyousya_id_list = implode(",", array_unique($hikuyousya_id_list));

            return view('event_regist_search', [
                'category_id' => $category_id,
                'event_name' => $event_name,
                'category_name' => $category_name,
                'nokotsubi_before' => $nokotsubi_before,
                'nokotsubi_after' => $nokotsubi_after,
                'freeword' => $freeword,
                'hikuyousya_count' => $hikuyousya_count,
                'danka_count' => $danka_count,
                'sort_item' => $sort_item,
                'sort_type' => $sort_type,
                'number' => $number,
                'danka_list' => $danka_list,
                'danka_id_list' => $danka_id_list,
                'hikuyousya_id_list' => $hikuyousya_id_list,
            ]);
        } else {
            $payment_before = isset($filter_array['payment_before']) ? $filter_array['payment_before'] : null;
            $payment_after = isset($filter_array['payment_after']) ? $filter_array['payment_after'] : null;
            $payment_flg = isset($filter_array['payment_flg']) ? $filter_array['payment_flg'] : null;
            $price_min = isset($filter_array['price_min']) ? $filter_array['price_min'] : null;
            $price_max = isset($filter_array['price_max']) ? $filter_array['price_max'] : null;
            $segaki_flg = isset($filter_array['segaki_flg']) ? $filter_array['segaki_flg'] : null;
            $star_flg = isset($filter_array['star_flg']) ? $filter_array['star_flg'] : null;
            $yakushiji_flg = isset($filter_array['yakushiji_flg']) ? $filter_array['yakushiji_flg'] : null;
            $kaiki_flg = isset($filter_array['kaiki_flg']) ? $filter_array['kaiki_flg'] : null;
            $freeword = isset($filter_array['freeword']) ? $filter_array['freeword'] : null;
            $item_category_id = isset($filter_array['item_category_id']) ? $filter_array['item_category_id'] : null;
            $event_date_id = isset($filter_array['event_date_id']) ? $filter_array['event_date_id'] : null;
            $event_date_flg = isset($filter_array['event_date_flg']) ? $filter_array['event_date_flg'] : null;
            $sort_item = isset($filter_array['sort_item']) ? $filter_array['sort_item'] : null;
            $sort_type = isset($filter_array['sort_type']) ? $filter_array['sort_type'] : null;    

            $event_name = isset($filter_array['event_name']) ? $filter_array['event_name'] : null;
            $category_name = TextCategory::find($category_id)->name;

            $item_categories = ItemCategory::get();

            // 檀家情報・取引・商品結合
            $query = Danka::select('danka.id as id', 'danka.name as name', 'tel', 
                'pref', 'city', 'address', 'building', 'payment_date', 'deal.created_at as created_at')
                ->selectRaw('SUM(total) AS total')
            ->join('deal', 'danka.id', '=', 'deal.danka_id')->leftJoin('deal_detail', 'deal.id', '=', 'deal_detail.deal_id')
            ->leftJoin('item', 'item.id', '=', 'deal_detail.item_id')->leftJoin('item_category', 'item_category.id', '=', 'item.category_id')
            ->groupBy('danka.id', 'danka.name', 'tel', 
            'pref', 'city', 'address', 'building', 'payment_date', 'deal.created_at', 'deal.id');

            if ($category_id != 3 && isset($item_category_id)) {
                $query->where('item.category_id', $item_category_id);
            }

            //星祭り処理
            if (isset($payment_flg) && $payment_flg == 'off') {
                $query_tmp = Danka::select('danka.id as id')
                    ->join('deal', 'danka.id', '=', 'deal.danka_id')->leftJoin('deal_detail', 'deal.id', '=', 'deal_detail.deal_id')
                    ->leftJoin('item', 'item.id', '=', 'deal_detail.item_id');
                if (!empty($payment_before)) {
                    $query_tmp->whereDate('payment_date', '>=', $payment_before);
                    $query->whereDate('payment_date', '>=', $payment_before);
                }
                if (!empty($payment_after)) {
                    $query_tmp->whereDate('payment_date', '<=', $payment_after);
                    $query->whereDate('payment_date', '<=', $payment_after);
                }
                $query_tmp->where('item.category_id', 3);
                $not_danka_ids = array_unique($query_tmp->get()->pluck('id')->toArray());

                $query->whereNotIn('danka.id', $not_danka_ids);
            } else {
                if (!empty($payment_before)) {
                    $query->whereDate('payment_date', '>=', $payment_before);
                }
                if (!empty($payment_after)) {
                    $query->whereDate('payment_date', '<=', $payment_after);
                }
                if ($category_id == 3) {
                    $query->where('item.category_id', 3);
                }
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

            if (!empty($event_date_id)) {
                $list_query = Danka::select('danka.id as danka_id')
                    ->leftJoin('event_send_list', 'event_send_list.danka_id', '=', 'danka.id')
                    ->leftJoin('event_date', 'event_send_list.event_date_id', '=', 'event_date.id')
                    ->where('event_date.category_id', 3)->where('event_date.id', $event_date_id);
                $event_date_danka_ids = array_unique($list_query->get()->pluck('danka_id')->toArray());

                $event_date = EventDate::find($event_date_id)->toArray();
                $list_created_at = substr($event_date['created_at'], 0, 10);

                $list_query = Danka::select('danka.id as danka_id')
                    ->leftJoin('deal', 'deal.danka_id', '=', 'danka.id')
                    ->leftJoin('deal_detail', 'deal_detail.deal_id', '=', 'deal.id')
                    ->leftJoin('item', 'deal_detail.item_id', '=', 'item.id')
                    ->where('item.category_id', 3)->whereDate('deal_detail.created_at', '>=', $list_created_at)
                    ->whereIn('danka.id', $event_date_danka_ids);
                $payment_danka_ids = array_unique($list_query->get()->pluck('danka_id')->toArray());

                if ($event_date_flg == 'off') {
                    $payment_danka_ids = array_diff($event_date_danka_ids, $payment_danka_ids);
                }
                $query->whereIn('danka.id', $payment_danka_ids);

            }

            if (!empty($price_min)) {

                $query->where('total', '>=', $price_min);
            }
            if (!empty($price_max)) {
                $query->where('total', '<=', $price_max);
            }

            if (!empty($freeword)) {
                $freeword = mb_convert_kana($freeword, 's');
                $word_list = explode(" ", $freeword);
                $query->where(function ($query) use ($word_list) {
                    foreach ($word_list as $word) {
                        if (!empty($word)) {
                            $query->orwhere('pref', 'like', "%$word%");
                        }
                    }
                });
            }

            $danka_id_list = $query->pluck('danka.id');
            $danka_count = count(array_unique($danka_id_list->toArray()));

            if (!empty($sort_item)) {
                if ($sort_item == 'created_at') {
                    $query->orderByRaw('deal.' . $sort_item . ' is null asc')->orderBy('deal.' . $sort_item, $sort_type);
                } else {
                    $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
                }
            }
    
            $number = \Request::get('number');
            if (isset($number)) {
                $danka_list = $query->orderBy('danka_id')->paginate($number)
                ->appends(["number" => $number]);
            } else {
                $danka_list = $query->orderBy('danka_id')->paginate(10);
            }

            $danka_id_list = implode(",", array_unique($danka_id_list->toArray()));
            $event_date_list = EventDate::where('category_id', 3)->get();

            return view('event_regist_search', [
                'category_id' => $category_id,
                'event_name' => $event_name,
                'category_name' => $category_name,
                'payment_before' => $payment_before,
                'payment_after' => $payment_after,
                'payment_flg' => $payment_flg,
                'event_date_id' => $event_date_id,
                'event_date_flg' => $event_date_flg,
                'price_min' => $price_min,
                'price_max' => $price_max,
                'segaki_flg' => $segaki_flg,
                'star_flg' => $star_flg,
                'yakushiji_flg' => $yakushiji_flg,
                'kaiki_flg' => $kaiki_flg,
                'freeword' => $freeword,
                'item_categories' => $item_categories,
                'item_category_id' => $item_category_id,
                'danka_count' => $danka_count,
                'sort_item' => $sort_item,
                'sort_type' => $sort_type,
                'number' => $number,
                'danka_list' => $danka_list,
                'danka_id_list' => $danka_id_list,
                'event_date_list' => $event_date_list,
            ]);



        }
    }

    public function event_store(Request $request)
    {
        $event_date = new EventDate;

        $request = $request->all();

        $meinichi_month = isset($request['meinichi_month']) ? $request['meinichi_month'] : null;
        $meinichi_day = isset($request['meinichi_day']) ? $request['meinichi_day'] : null;
        $kaiki_before = isset($request['kaiki_before']) ? $request['kaiki_before'] : null;
        $kaiki_after = isset($request['kaiki_after']) ? $request['kaiki_after'] : null;
        $payment_before = isset($request['payment_before']) ? $request['payment_before'] : null;
        $payment_after = isset($request['payment_after']) ? $request['payment_after'] : null;
        $price_min = isset($request['price_min']) ? $request['price_min'] : null;
        $price_max = isset($request['price_max']) ? $request['price_max'] : null;
        $segaki_flg = isset($request['segaki_flg']) ? $request['segaki_flg'] : null;
        $star_flg = isset($request['star_flg']) ? $request['star_flg'] : null;
        $yakushiji_flg = isset($request['yakushiji_flg']) ? $request['yakushiji_flg'] : null;
        $kaiki_flg = isset($request['kaiki_flg']) ? $request['kaiki_flg'] : null;
        $freeword = isset($request['freeword']) ? $request['freeword'] : null;
        $item_category_id = isset($request['item_category_id']) ? $request['item_category_id'] : null;
        $nokotsubi_before = isset($request['nokotsubi_before']) ? $request['nokotsubi_before'] : null;
        $nokotsubi_after = isset($request['nokotsubi_after']) ? $request['nokotsubi_after'] : null;
        $payment_flg = isset($request['payment_flg']) ? $request['payment_flg'] : null;
        $star_event_date_id = isset($request['event_date_id']) ? $request['event_date_id'] : null;
        $event_date_flg = isset($request['event_date_flg']) ? $request['event_date_flg'] : null;
        $sort_item = isset($request['sort_item']) ? $request['sort_item'] : null;
        $sort_type = isset($request['sort_type']) ? $request['sort_type'] : null;

        $fill_data = [
            'category_id' => $request['category_id'],
            'name' => $request['event_name'],
            'danka_count' => $request['danka_count'],
        ];

        DB::beginTransaction();
        try {
            $event_date->fill($fill_data)->save();

            $event_date_id = $event_date->id;
            $danka_id_list = explode(',', $request['danka_id_list']);

            foreach ($danka_id_list as $danka_id) {
                $event_send_list = new EventSendList;
                $fill_data = [
                    'event_date_id' => $event_date_id,
                    'danka_id' => $danka_id,
                ];
                $event_send_list->fill($fill_data)->save();
            }

            $event_search_log = new EventSearchLog();
            $fill_data = [
                'event_date_id' => $event_date_id,
                'meinichi_month' => $meinichi_month,
                'meinichi_day' => $meinichi_day,
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
                'item_category_id' => $item_category_id,
                'nokotsubi_before' => $nokotsubi_before,
                'nokotsubi_after' => $nokotsubi_after,
                'payment_flg' => $payment_flg,
                'star_event_date_id' => $star_event_date_id,
                'event_date_flg' => $event_date_flg,
                'sort_item' => $sort_item,
                'sort_type' => $sort_type,
            ];
            $event_search_log->fill($fill_data)->save();

            DB::commit();
            return redirect()->route('event_show', $request['category_id'])->with('message', '行事の登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function event_date_show($date_id)
    {
        $event_date = EventDate::find($date_id);
        $category_id = $event_date->category_id;
        $event_search_log = EventSearchLog::where('event_date_id', $date_id)->get();
        $filter_array = $event_search_log->toArray();
        $filter_array = $filter_array[0];

        if ($category_id == 1) {
            $meinichi_month = isset($filter_array['meinichi_month']) ? $filter_array['meinichi_month'] : null;
            $meinichi_day = isset($filter_array['meinichi_day']) ? $filter_array['meinichi_day'] : null;
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
            $sort_item = isset($filter_array['sort_item']) ? $filter_array['sort_item'] : null;
            $sort_type = isset($filter_array['sort_type']) ? $filter_array['sort_type'] : null;    

            $event_name = isset($event_date->name) ? $event_date->name : null;
            $category_name = TextCategory::find($category_id)->name;

            $item_categories = ItemCategory::get();

            $query = Danka::select('*')->select('hikuyousya.id as id')->selectRaw("
            TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki
            ")->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id');


            if (isset($meinichi_month)) {
                $month = str_pad($meinichi_month, 2, 0, STR_PAD_LEFT);
                if (isset($meinichi_day)) {
                    $day = str_pad($meinichi_day, 2, 0, STR_PAD_LEFT);
                    $md = $month . $day;
                    $query->whereRaw("DATE_FORMAT(meinichi, '%m%d') = ?", [$md]);

                } else {
                    $query->whereRaw("DATE_FORMAT(meinichi, '%m') = ?", [$month]);
                }
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
                'posthumous', 'meinichi', 'item_category.name as category_name', 'hikuyousya.id as hikuyousya_id', 'total', 'payment_date', 'kaiki_flg')
                ->selectRaw("TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki")
            ->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')->leftJoin('deal_detail', 'hikuyousya.id', '=', 'hikuyousya_id')
            ->leftJoin('deal', 'deal.id', '=', 'deal_detail.deal_id')
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

            if (!empty($freeword)) {
                $freeword = mb_convert_kana($freeword, 's');
                $word_list = explode(" ", $freeword);
                $query->where(function ($query) use ($word_list) {
                    foreach ($word_list as $word) {
                        if (!empty($word)) {
                            $query->orwhere('pref', 'like', "%$word%");
                        }
                    }
                });
            }
    
            $hikuyousya_ids = $query->pluck('hikuyousya_id');
            $hikuyousya_count = count(array_unique($hikuyousya_ids->toArray()));

            if (!empty($sort_item)) {
                $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
            }
        
            $number = \Request::get('number');
            if (isset($number)) {
                $danka_list = $query->orderBy('danka.id')->paginate($number)
                ->appends(["number" => $number]);
            } else {
                $danka_list = $query->orderBy('danka.id')->get();
            }

            $danka_id_list = Danka::select('danka_id')->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')
            ->whereIn('hikuyousya.id', $hikuyousya_ids)->groupBy('danka_id')->get();
            $danka_count = $danka_id_list->count();
            $danka_id_list = array_unique($danka_id_list->pluck('danka_id')->toArray());
            $danka_id_list = implode(",", array_unique($danka_id_list));

            $hikuyousya_id_list = array_unique($hikuyousya_ids->toArray());
            $hikuyousya_id_list = implode(",", array_unique($hikuyousya_id_list));

            return view('event_date_show', [
                'category_id' => $category_id,
                'event_name' => $event_name,
                'category_name' => $category_name,
                'meinichi_month' => $meinichi_month,
                'meinichi_day' => $meinichi_day,
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
                'danka_id_list' => $danka_id_list,
                'hikuyousya_id_list' => $hikuyousya_id_list,
            ]);
        } elseif ($category_id == 5) {
            $nokotsubi_before = isset($filter_array['nokotsubi_before']) ? $filter_array['nokotsubi_before'] : null;
            $nokotsubi_after = isset($filter_array['nokotsubi_after']) ? $filter_array['nokotsubi_after'] : null;
            $freeword = isset($filter_array['freeword']) ? $filter_array['freeword'] : null;
            $sort_item = isset($filter_array['sort_item']) ? $filter_array['sort_item'] : null;
            $sort_type = isset($filter_array['sort_type']) ? $filter_array['sort_type'] : null;    

            $event_name = $event_date->name;
            $category_name = TextCategory::find($category_id)->name;

            $query = Danka::select('danka.id as id', 'hikuyousya.id as hikuyousya_id', 'name', 'common_name', 'posthumous', 'nokotsubi',
             'nokotsuidobi', 'column', 'nokotsu_no', 'ihai_no')->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')
            ->whereNotNull('nokotsubi');


            if (!empty($nokotsubi_before)) {
                $query->whereDate('nokotsubi', '>=', $nokotsubi_before);
            }
            if (!empty($nokotsubi_after)) {
                $query->whereDate('nokotsubi', '<=', $nokotsubi_after);
            }

            if (!empty($freeword)) {
                $freeword = mb_convert_kana($freeword, 's');
                $word_list = explode(" ", $freeword);
                $query->where(function ($query) use ($word_list) {
                    foreach ($word_list as $word) {
                        if (!empty($word)) {
                            $query->orwhere('pref', 'notices', "%$word%")->orwhere('column', 'like', "%$word%");
                        }
                    }
                });
            }
    
            $hikuyousya_ids = $query->pluck('hikuyousya_id');
            $hikuyousya_count = count(array_unique($hikuyousya_ids->toArray()));

            if (!empty($sort_item)) {
                $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
            }
        
            $number = \Request::get('number');
            if (isset($number)) {
                $danka_list = $query->orderBy('danka_id')->paginate($number)
                ->appends(["number" => $number]);
            } else {
                $danka_list = $query->orderBy('danka_id')->get();
            }

            $danka_id_list = Danka::select('danka_id')->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')
            ->whereIn('hikuyousya.id', $hikuyousya_ids)->groupBy('danka_id')->get();
            $danka_count = $danka_id_list->count();
            $danka_id_list = array_unique($danka_id_list->pluck('danka_id')->toArray());
            $danka_id_list = implode(",", array_unique($danka_id_list));

            $hikuyousya_id_list = array_unique($hikuyousya_ids->toArray());
            $hikuyousya_id_list = implode(",", array_unique($hikuyousya_id_list));

            return view('event_date_show', [
                'category_id' => $category_id,
                'event_name' => $event_name,
                'category_name' => $category_name,
                'nokotsubi_before' => $nokotsubi_before,
                'nokotsubi_after' => $nokotsubi_after,
                'freeword' => $freeword,
                'hikuyousya_count' => $hikuyousya_count,
                'danka_count' => $danka_count,
                'number' => $number,
                'danka_list' => $danka_list,
                'danka_id_list' => $danka_id_list,
                'hikuyousya_id_list' => $hikuyousya_id_list,
            ]);
        } else {
            $payment_before = isset($filter_array['payment_before']) ? $filter_array['payment_before'] : null;
            $payment_after = isset($filter_array['payment_after']) ? $filter_array['payment_after'] : null;
            $payment_flg = isset($filter_array['payment_flg']) ? $filter_array['payment_flg'] : null;
            $price_min = isset($filter_array['price_min']) ? $filter_array['price_min'] : null;
            $price_max = isset($filter_array['price_max']) ? $filter_array['price_max'] : null;
            $segaki_flg = isset($filter_array['segaki_flg']) ? $filter_array['segaki_flg'] : null;
            $star_flg = isset($filter_array['star_flg']) ? $filter_array['star_flg'] : null;
            $yakushiji_flg = isset($filter_array['yakushiji_flg']) ? $filter_array['yakushiji_flg'] : null;
            $kaiki_flg = isset($filter_array['kaiki_flg']) ? $filter_array['kaiki_flg'] : null;
            $freeword = isset($filter_array['freeword']) ? $filter_array['freeword'] : null;
            $item_category_id = isset($filter_array['item_category_id']) ? $filter_array['item_category_id'] : null;
            $star_event_date_id = isset($filter_array['star_event_date_id']) ? $filter_array['star_event_date_id'] : null;
            $event_date_flg = isset($filter_array['event_date_flg']) ? $filter_array['event_date_flg'] : null;
            $sort_item = isset($filter_array['sort_item']) ? $filter_array['sort_item'] : null;
            $sort_type = isset($filter_array['sort_type']) ? $filter_array['sort_type'] : null;    

            $event_name = $event_date->name;
            $category_name = TextCategory::find($category_id)->name;

            $item_categories = ItemCategory::get();

            // 檀家情報・取引・商品結合
            $query = Danka::select('danka.id as id', 'danka.name as name', 'tel', 
                'pref', 'city', 'address', 'building', 'item_category.name as category_name', 'payment_date', 'total', 'deal.created_at as created_at')
            ->join('deal', 'danka.id', '=', 'deal.danka_id')->leftJoin('deal_detail', 'deal.id', '=', 'deal_detail.deal_id')
            ->leftJoin('item', 'item.id', '=', 'deal_detail.item_id')->leftJoin('item_category', 'item_category.id', '=', 'item.category_id');

            if ($category_id != 3 && isset($item_category_id)) {
                $query->where('item.category_id', $item_category_id);
            }

            //星祭り処理
            if (isset($payment_flg) && $payment_flg == 'off') {
                $query_tmp = Danka::select('danka.id as id')
                    ->join('deal', 'danka.id', '=', 'deal.danka_id')->leftJoin('deal_detail', 'deal.id', '=', 'deal_detail.deal_id')
                    ->leftJoin('item', 'item.id', '=', 'deal_detail.item_id');
                if (!empty($payment_before)) {
                    $query_tmp->whereDate('payment_date', '>=', $payment_before);
                    $query->whereDate('payment_date', '>=', $payment_before);
                }
                if (!empty($payment_after)) {
                    $query_tmp->whereDate('payment_date', '<=', $payment_after);
                    $query->whereDate('payment_date', '<=', $payment_after);
                }
                $query_tmp->where('item.category_id', 3);
                $not_danka_ids = array_unique($query_tmp->get()->pluck('id')->toArray());

                $query->whereNotIn('danka.id', $not_danka_ids);
            } else {
                if (!empty($payment_before)) {
                    $query->whereDate('payment_date', '>=', $payment_before);
                }
                if (!empty($payment_after)) {
                    $query->whereDate('payment_date', '<=', $payment_after);
                }
                if ($category_id == 3) {
                    $query->where('item.category_id', 3);
                }
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

            if (!empty($star_event_date_id)) {
                $list_query = Danka::select('danka.id as danka_id')
                    ->leftJoin('event_send_list', 'event_send_list.danka_id', '=', 'danka.id')
                    ->leftJoin('event_date', 'event_send_list.event_date_id', '=', 'event_date.id')
                    ->where('event_date.category_id', 3)->where('event_date.id', $star_event_date_id);
                $event_date_danka_ids = array_unique($list_query->get()->pluck('danka_id')->toArray());

                $event_date = EventDate::find($star_event_date_id)->toArray();
                $list_created_at = substr($event_date['created_at'], 0, 10);

                $list_query = Danka::select('danka.id as danka_id')
                    ->leftJoin('deal', 'deal.danka_id', '=', 'danka.id')
                    ->leftJoin('deal_detail', 'deal_detail.deal_id', '=', 'deal.id')
                    ->leftJoin('item', 'deal_detail.item_id', '=', 'item.id')
                    ->where('item.category_id', 3)->whereDate('deal_detail.created_at', '>=', $list_created_at)
                    ->whereIn('danka.id', $event_date_danka_ids);
                $payment_danka_ids = array_unique($list_query->get()->pluck('danka_id')->toArray());

                if ($event_date_flg == 'off') {
                    $payment_danka_ids = array_diff($event_date_danka_ids, $payment_danka_ids);
                }
                $query->whereIn('danka.id', $payment_danka_ids);

            }

            if (!empty($price_min)) {

                $query->where('total', '>=', $price_min);
            }
            if (!empty($price_max)) {
                $query->where('total', '<=', $price_max);
            }

            if (!empty($freeword)) {
                $freeword = mb_convert_kana($freeword, 's');
                $word_list = explode(" ", $freeword);
                $query->where(function ($query) use ($word_list) {
                    foreach ($word_list as $word) {
                        if (!empty($word)) {
                            $query->orwhere('pref', 'like', "%$word%");
                        }
                    }
                });
            }

            $danka_id_list = $query->pluck('danka.id');
            $danka_count = count(array_unique($danka_id_list->toArray()));

            if (!empty($sort_item)) {
                $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
            }
        
            $number = \Request::get('number');
            if (isset($number)) {
                $danka_list = $query->orderBy('danka_id')->paginate($number)
                ->appends(["number" => $number]);
            } else {
                $danka_list = $query->orderBy('danka_id')->get();
            }

            $danka_id_list = implode(",", array_unique($danka_id_list->toArray()));
            $event_date_list = EventDate::where('category_id', 3)->get();

            return view('event_date_show', [
                'category_id' => $category_id,
                'event_name' => $event_name,
                'category_name' => $category_name,
                'payment_before' => $payment_before,
                'payment_after' => $payment_after,
                'payment_flg' => $payment_flg,
                'star_event_date_id' => $star_event_date_id,
                'event_date_flg' => $event_date_flg,
                'price_min' => $price_min,
                'price_max' => $price_max,
                'segaki_flg' => $segaki_flg,
                'star_flg' => $star_flg,
                'yakushiji_flg' => $yakushiji_flg,
                'kaiki_flg' => $kaiki_flg,
                'freeword' => $freeword,
                'item_categories' => $item_categories,
                'item_category_id' => $item_category_id,
                'danka_count' => $danka_count,
                'number' => $number,
                'danka_list' => $danka_list,
                'danka_id_list' => $danka_id_list,
                'event_date_list' => $event_date_list,
            ]);
        }
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

    public function star_csv_export(Request $request)
    {
        $request = $request->all();
        $danka_id_list = explode(',', $request['danka_id_list']);
        arsort($danka_id_list);
        $cvsList[] = ['カルテナンバー', '施主名', 'フリガナ', '電話番号', '携帯番号', '郵便番号', '住所', '星祭', '施餓鬼', '薬師寺霊園',
        ];
        
        foreach ($danka_id_list as $danka_id) {
            $cvsList[] = Danka::find($danka_id)->outputCsvContentStar();
        }

        $response = new StreamedResponse (function() use ($cvsList){
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            $buffer = str_replace("\n", "\r\n", stream_get_contents($stream));
            fclose($stream);
            //出力ストリーム
            $fp = fopen('php://output', 'w+b');
            //さっき置換した内容を出力 
            fwrite($fp, $buffer);
        
            fclose($fp);
        });
        
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="sample.csv"');
 
        return $response;

    }

    public function nenki_csv_export(Request $request)
    {
        $request = $request->all();
        $sort_item = isset($request['sort_item']) ? $request['sort_item'] : null;
        $sort_type = isset($request['sort_type']) ? $request['sort_type'] : null;
        $hikuyousya_id_list = explode(',', $request['hikuyousya_id_list']);

        $query = Danka::select('*')->selectRaw("TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki")
        ->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')->whereIn('hikuyousya.id', $hikuyousya_id_list);

        if (!empty($sort_item)) {
            $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
        }

        $danka_list = $query->orderBy('danka_id', 'desc')->get();

        $cvsList[] = ['カルテナンバー', '施主名', 'フリガナ', '電話番号', '携帯番号', '郵便番号', '住所',
        '種別', '俗名', 'フリガナ', '戒名', '性別', '行年', '命日', '周忌/回忌', '年忌チェック', '特記事項', 
        ];
        
        foreach ($danka_list as $danka) {
            $cvsList[] = $danka->outputCsvContentNenki();
        }

        $response = new StreamedResponse (function() use ($cvsList){
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            $buffer = str_replace("\n", "\r\n", stream_get_contents($stream));
            fclose($stream);
            //出力ストリーム
            $fp = fopen('php://output', 'w+b');
            //さっき置換した内容を出力 
            fwrite($fp, $buffer);
        
            fclose($fp);
        });
        
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="sample.csv"');
 
        return $response;

    }

    public function noukotsu_csv_export(Request $request)
    {
        $request = $request->all();
        $sort_item = isset($request['sort_item']) ? $request['sort_item'] : null;
        $sort_type = isset($request['sort_type']) ? $request['sort_type'] : null;
        $hikuyousya_id_list = explode(',', $request['hikuyousya_id_list']);

        $query = Danka::select('*')->selectRaw("TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki")
        ->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')->whereIn('hikuyousya.id', $hikuyousya_id_list);

        if (!empty($sort_item)) {
            $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
        }

        $danka_list = $query->orderBy('nokotsubi', 'asc')->get();

        $cvsList[] = ['カルテナンバー', '施主名', 'フリガナ', '電話番号', '携帯番号', '郵便番号', '住所',
        '種別', '俗名', 'フリガナ', '戒名', '性別', '行年', '命日', '周忌/回忌', '年忌チェック', 
        '位牌番号', '建立日', '納骨番号', '納骨日', '納骨移動日', '特記事項', 
        ];
        
        foreach ($danka_list as $danka) {
            $cvsList[] = $danka->outputCsvContentNoukotsu();
        }

        $response = new StreamedResponse (function() use ($cvsList){
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            $buffer = str_replace("\n", "\r\n", stream_get_contents($stream));
            fclose($stream);
            //出力ストリーム
            $fp = fopen('php://output', 'w+b');
            //さっき置換した内容を出力 
            fwrite($fp, $buffer);
        
            fclose($fp);
        });
        
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="sample.csv"');
 
        return $response;

    }


}