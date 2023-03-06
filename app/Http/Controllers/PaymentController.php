<?php

namespace App\Http\Controllers;

use App\Models\Danka;
use App\Models\Hikuyousya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Deal;
use App\Models\DealDetail;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\TextCategory;
use App\Rules\ItemCheck;
use Symfony\Component\HttpFoundation\StreamedResponse;
use DB;

class PaymentController extends Controller
{
    public function deal_list(Request $request)
    {
        $filter_array = $request->all();
        $name = isset($filter_array['name']) ? $filter_array['name'] : null;
        $name_kana = isset($filter_array['name_kana']) ? $filter_array['name_kana'] : null;
        $tel = isset($filter_array['tel']) ? $filter_array['tel'] : null;
        $item_id = isset($filter_array['item_id']) ? $filter_array['item_id'] : null;
        $item_category_id = isset($filter_array['item_category_id']) ? $filter_array['item_category_id'] : null;
        $created_at_before = isset($filter_array['created_at_before']) ? $filter_array['created_at_before'] : null;
        $created_at_after = isset($filter_array['created_at_after']) ? $filter_array['created_at_after'] : null;
        $payment_before = isset($filter_array['payment_before']) ? $filter_array['payment_before'] : null;
        $payment_after = isset($filter_array['payment_after']) ? $filter_array['payment_after'] : null;
        $price_min = isset($filter_array['price_min']) ? $filter_array['price_min'] : null;
        $price_max = isset($filter_array['price_max']) ? $filter_array['price_max'] : null;
        $sort_item = isset($filter_array['sort_item']) ? $filter_array['sort_item'] : null;
        $sort_type = isset($filter_array['sort_type']) ? $filter_array['sort_type'] : null;
        $type = isset($filter_array['type']) ? $filter_array['type'] : null;
        $gojikaihi_out_flg = isset($filter_array['gojikaihi_out_flg']) ? $filter_array['gojikaihi_out_flg'] : 1;
        $gojikaihi_item_id = Item::where('detail', '護持会費')->where('category_id', 8)->first()->id;

        $query = Deal::select('deal.id as id', 'deal_no', 'name', 'name_kana', 'tel', 'state', 'payment_date', 'deal.created_at as created_at')
            ->selectRaw('SUM(total) AS total')
            ->join('danka', 'danka.id', '=', 'deal.danka_id')->join('deal_detail', 'deal.id', '=', 'deal_detail.deal_id')->join('item', 'item.id', '=', 'deal_detail.item_id')
            ->groupBy('deal.id', 'deal_no', 'name', 'name_kana', 'tel', 'state', 'payment_date', 'deal.created_at');

        if (!empty($name)) {
            $query->where('name', 'like', "%$name%");
        }

        if (!empty($name_kana)) {
            $query->where('name_kana', 'like', "%$name_kana%");
        }
    
        if (!empty($tel)) {
            $query->where(function ($query) use ($tel) {
                $query->orwhere('tel', 'like', "%$tel%")->orwhere('mobile', 'like', "%$tel%");
            });
        }

        if (!empty($created_at_before)) {
            $query->whereDate('deal.created_at', '>=', $created_at_before);
        }
        if (!empty($created_at_after)) {
            $query->whereDate('deal.created_at', '<=', $created_at_after);
        }

        if (!empty($payment_before)) {
            $query->whereDate('payment_date', '>=', $payment_before);
        }
        if (!empty($payment_after)) {
            $query->whereDate('payment_date', '<=', $payment_after);
        }

        if (!empty($item_category_id)) {
            $query->where('category_id', $item_category_id);
        }

        if (!empty($item_id)) {
            $query->where('item.id', $item_id);
        }

        if (!empty($gojikaihi_out_flg)) {
            $query->where('item.id', '!=', $gojikaihi_item_id);
        }

        if (!empty($type)) {
            if ($type != 'すべて') {
                $query->where('state', $type);
            }
        } else {
            $type = '未払い';
            $query->where('state', $type);
        }

        if (!empty($price_min)) {
            $query->having('total', '>=', $price_min);
        }

        if (!empty($price_max)) {
            $query->having('total', '<=', $price_max);
        }

        if (!empty($sort_item)) {
            if ($sort_item == 'created_at') {
                $query->orderByRaw('deal.' . $sort_item . ' is null asc')->orderBy('deal.' . $sort_item, $sort_type);
            } else {
                $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
            }
        }

        if (!empty($type) && $type == '支払済') {
            $query->orderBy('payment_date', 'desc')->orderBy('deal_no', 'desc');
        } else {
            $query->orderBy('deal_no', 'desc');
        }

        $sum_query = clone $query;
        $sum_query = $sum_query->get();
        $sum_price = 0;
        foreach($sum_query as $item) {
            $sum_price += $item->total;
        }

        $deal_id_list = $sum_query->pluck('id');
        $deal_detail_count = DealDetail::whereIn('deal_id', $deal_id_list)->count();

        $number = \Request::get('number');
        if (isset($number)) {
            $deal_list = $query->paginate($number)
            ->appends(["number" => $number]);
        } else {
            $deal_list = $query->paginate(10);
        }

        $item_category_list = ItemCategory::orderBy('id')->get();

        $item_list = Item::select('item.id as id', 'name', 'detail', 'price')->join('item_category', 'item_category.id', '=', 'item.category_id')
        ->orderBy('item_category.id')->orderBy('id')->get();

        return view('deal_list', [
            'deal_list' => $deal_list,
            'item_category_list' => $item_category_list,
            'item_list' => $item_list,

            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'item_category_id' => $item_category_id,
            'item_id' => $item_id,
            'created_at_before' => $created_at_before,
            'created_at_after' => $created_at_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'sort_item' => $sort_item,
            'sort_type' => $sort_type,
            'type' => $type,
            'number' => $number,
            'gojikaihi_out_flg' => $gojikaihi_out_flg,

            'sum_price' => $sum_price,
            'deal_detail_count' => $deal_detail_count,
        ]);
    }

    public function unclaimed_update(Request $request)
    {
        $id = $request->id;
        $deal = Deal::find($id);

        DB::beginTransaction();
        try {
            $fill_data = [
                'state' => '送付待ち',
            ];

            $deal->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('deal_list',[
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'tel' => $request->tel,
            'item_category_id' => $request->item_category_id,
            'created_at_before' => $request->created_at_before,
            'created_at_after' => $request->created_at_after,
            'payment_before' => $request->payment_before,
            'payment_after' => $request->payment_after,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'type' => $request->type,
            'number' => $request->number,
            ])->with('message', 'ステータスを変更しました。');
        } catch (\Exception $e) {
            DB::rollback();
        }

    }

    public function unpaid_update(Request $request)
    {
        $id = $request->id;
        $deal = Deal::find($id);

        DB::beginTransaction();
        try {
            $fill_data = [
                'state' => '未払い',
                'payment_date' => null,
            ];

            $deal->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('deal_list',[
                'name' => $request->name,
                'name_kana' => $request->name_kana,
                'tel' => $request->tel,
                'item_category_id' => $request->item_category_id,
                'created_at_before' => $request->created_at_before,
                'created_at_after' => $request->created_at_after,
                'payment_before' => $request->payment_before,
                'payment_after' => $request->payment_after,
                'price_min' => $request->price_min,
                'price_max' => $request->price_max,
                'type' => $request->type,
                'number' => $request->number,
                ])->with('message', 'ステータスを変更しました。');
            } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function paid_update(Request $request)
    {
        $id = $request->id;
        $deal = Deal::find($id);
        $danka_id = $deal->danka_id;
        $danka = Danka::find($danka_id);
        $date = date('Y-m-d');
        DB::beginTransaction();
        try {
            $fill_data = [
                'state' => '支払済',
                'payment_date' => $date,
            ];

            $deal->fill($fill_data)->update();
            
            $fill_data = [];
            $star_count = DealDetail::join('item', 'item.id', '=', 'deal_detail.item_id')->where('deal_id', $id)->where('category_id', 3)->count();
            if ($star_count > 0) {
                $fill_data['star_flg'] = 1;
            }

            $segaki_count = DealDetail::join('item', 'item.id', '=', 'deal_detail.item_id')->where('deal_id', $id)->where('category_id', 4)->count();
            if ($segaki_count > 0) {
                $fill_data['segaki_flg'] = 1;
            }

            $yakushiji_count = DealDetail::join('item', 'item.id', '=', 'deal_detail.item_id')->where('deal_id', $id)->where('category_id', 11)->count();
            if ($yakushiji_count > 0) {
                $fill_data['yakushiji_flg'] = 1;
            }

            $danka->fill($fill_data)->update();

            $query = DealDetail::join('item', 'item.id', '=', 'deal_detail.item_id')->where('deal_id', $id)->where('hikuyousya_id', '!=', 0);
            $query->where(function ($query) {
                $query->orwhere('category_id', 1)->orwhere('category_id', 2);
            });
            $hikuyousya_ids = $query->get()->pluck('hikuyousya_id');

            $fill_data = [
                'kaiki_flg' => 1,
            ];

            foreach ($hikuyousya_ids as $hikuyousya_id) {
                $hikuyousya = Hikuyousya::find($hikuyousya_id);
                $hikuyousya->fill($fill_data)->update();
            }


            DB::commit();
            return redirect()->route('deal_list',[
                'name' => $request->name,
                'name_kana' => $request->name_kana,
                'tel' => $request->tel,
                'item_category_id' => $request->item_category_id,
                'created_at_before' => $request->created_at_before,
                'created_at_after' => $request->created_at_after,
                'payment_before' => $request->payment_before,
                'payment_after' => $request->payment_after,
                'price_min' => $request->price_min,
                'price_max' => $request->price_max,
                'type' => $request->type,
                'number' => $request->number,
                ])->with('message', 'ステータスを変更しました。');
            } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function deal_regist(Request $request)
    {
        $item_list = Item::select('item.id as id', 'name', 'detail', 'price')->join('item_category', 'item_category.id', '=', 'item.category_id')
            ->orderBy('item_category.id')->orderBy('id')->get();
        $current_year = date('Y');
        $max_deal_no = Deal::where('deal_no', 'like', "$current_year%")->max('deal_no');
        if (isset($max_deal_no)) {
            $next_deal_no = $max_deal_no + 1;
        } else {
            $next_deal_no = $current_year . '000001';
        }

        $gojikaihi_count = Hikuyousya::where('gojikaihi_flg', 1)->whereNotNull('henjokaku1')->groupBy('danka_id')->get()->pluck('danka_id')->count();
        return view('deal_regist', [
            'item_list' => $item_list,
            'next_deal_no' => $next_deal_no,
            'gojikaihi_count' => $gojikaihi_count,
        ]);
    }

    public function gojikaihi_deal_store(Request $request)
    {
        $request = $request->all();
        $next_deal_no = $request['next_deal_no'];
        $item_id = Item::where('detail', '護持会費')->where('category_id', 8)->first()->id;

        DB::beginTransaction();
        try {

            $danka_ids = Hikuyousya::where('gojikaihi_flg', 1)->whereNotNull('henjokaku1')->groupBy('danka_id')->get()->pluck('danka_id');

            foreach ($danka_ids as $danka_id) {
                $deal = new Deal();
                $fill_data = [
                    'deal_no' => $next_deal_no,
                    'danka_id' => $danka_id,
                    'payment_method' => '銀行振込',
                ];
                $deal->fill($fill_data)->save();
                $deal_id = $deal->id;

                $hikuyousya_list = Hikuyousya::where('danka_id', $danka_id)->where('gojikaihi_flg', 1)->whereNotNull('henjokaku1')->get();
                foreach ($hikuyousya_list as $hikuyousya) {
                    $deal_detail = new DealDetail();
                    $price = $hikuyousya->henjokaku1 == '精薫の間' ? 33000 : 30000;
                    $fill_data = [
                        'deal_id' => $deal_id,
                        'item_id' => $item_id,
                        'quantity' => 1,
                        'price' => $price,
                        'total' => $price,
                        'hikuyousya_id' => $hikuyousya->id,
                        'remark' => $hikuyousya->henjokaku1 . $hikuyousya->henjokaku2 . $hikuyousya->henjokaku3 . $hikuyousya->henjokaku4,
                    ];
                    $deal_detail->fill($fill_data)->save();
                }
                $next_deal_no++;
            }

            DB::commit();
            return redirect()->to('deal_list')->with('message', '護持会費取引を作成いたしました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function deal_confirm(Request $request)
    {
        $request = $request->all();
        $danka_id = $request['danka_id'];
        $payment_method = $request['payment_method'];
        $item_id = $request['item_id'];
        $quantity = $request['quantity'];
        $price = $request['price'];
        $zokumyo_id = $request['zokumyo'];
        $remark = $request['remark'];
        $deal_no = $request['deal_no'];

        $danka = Danka::find($danka_id);
        $item_list = [];
        for ($i = 0; $i < count($item_id); $i++) {
            $item = Item::select('name', 'detail', 'price')->join('item_category', 'item_category.id', '=', 'item.category_id')->where('item.id', $item_id[$i])->first();
            if (isset($zokumyo_id[$i])) {
                $hikuyousya = Hikuyousya::select('*')->selectRaw("
                TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki
                ")->where('id', $zokumyo_id[$i])->first();
            }
            if (isset($item_id[$i])) {
                $item_list[] = [
                    'item_id' => $item_id[$i],
                    'hikuyousya_id' => $zokumyo_id[$i],
                    'item_name' => $item->name . '：'. $item->detail,
                    'quantity' => $quantity[$i],
                    'price' => isset($price[$i]) ? $price[$i] : $item->price,
                    'total' => isset($price[$i]) ? $price[$i] * $quantity[$i] : $item->price * $quantity[$i],
                    'zokumyo' => isset($zokumyo_id[$i]) ? $hikuyousya->common_name : 'なし',
                    'kaimyo' => isset($zokumyo_id[$i]) ? $hikuyousya->posthumous : 'なし',
                    'meinichi' => isset($zokumyo_id[$i]) ? $hikuyousya->meinichi : 'なし',
                    'gyonen' => isset($zokumyo_id[$i]) ? $hikuyousya->gyonen : 'なし',
                    'kaiki' => isset($zokumyo_id[$i]) ? $hikuyousya->kaiki : 'なし',
                    'remark' => isset($remark[$i]) ? $remark[$i] : '',
                ];    
            }
        }

        $total = 0;
        foreach ($item_list as $item) {
            $total += $item['total'];
        }

        return view('deal_confirm', [
            'danka' => $danka,
            'payment_method' => $payment_method,
            'item_list' => $item_list,
            'total' => $total,
            'deal_no' => $deal_no,
        ]);
    }

    public function deal_detail($id)
    {
        $deal = Deal::find($id);
        $danka = Danka::find($deal->danka_id);
        $deal_detail_list = DealDetail::where('deal_id', $id)->get();

        $item_list = [];
        foreach ($deal_detail_list as $deal_detail) {
            $item = Item::select('name', 'detail')->join('item_category', 'item_category.id', '=', 'item.category_id')
                ->where('item.id', $deal_detail->item_id)->first();
            if ($deal_detail->hikuyousya_id != 0) {
                $hikuyousya = Hikuyousya::select('*')->selectRaw("
                TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki
                ")->where('id', $deal_detail->hikuyousya_id)->first();
            }
            $item_list[] = [
                'item_name' => $item->name . '：'. $item->detail,
                'quantity' => $deal_detail->quantity,
                'price' => $deal_detail->price,
                'total' => $deal_detail->total,
                'zokumyo' => $deal_detail->hikuyousya_id != 0 ? $hikuyousya->common_name : 'なし',
                'kaimyo' => $deal_detail->hikuyousya_id != 0 ? $hikuyousya->posthumous : 'なし',
                'meinichi' => $deal_detail->hikuyousya_id != 0 ? $hikuyousya->meinichi : 'なし',
                'gyonen' => $deal_detail->hikuyousya_id != 0 ? $hikuyousya->gyonen : 'なし',
                'kaiki' => $deal_detail->hikuyousya_id != 0 ? $hikuyousya->kaiki : 'なし',
                'remark' => $deal_detail->remark,
            ];
        }

        $total = 0;
        foreach ($item_list as $item) {
            $total += $item['total'];
        }

        return view('deal_detail', [
            'deal' => $deal,
            'danka' => $danka,
            'item_list' => $item_list,
            'total' => $total,
        ]);
    }

    public function deal_edit($id)
    {
        $item_list = Item::select('item.id as id', 'name', 'detail', 'price')->join('item_category', 'item_category.id', '=', 'item.category_id')->orderBy('item_category.id')->get();

        $deal = Deal::find($id);
        $danka = Danka::find($deal->danka_id);
        $deal_detail_list = DealDetail::where('deal_id', $id)->get();
        $hikuyousya_list = Hikuyousya::where('danka_id', $deal->danka_id)->get();

        return view('deal_edit', [
            'deal' => $deal,
            'danka' => $danka,
            'item_list' => $item_list,
            'deal_detail_list' => $deal_detail_list,
            'hikuyousya_list' => $hikuyousya_list,
            'payment_method' => $deal->payment_method,
        ]);
    }

    public function deal_edit_confirm(Request $request)
    {
        $request = $request->all();
        $danka_id = $request['danka_id'];
        $deal_id = $request['deal_id'];
        $payment_method = $request['payment_method'];
        $item_id = $request['item_id'];
        $quantity = $request['quantity'];
        $price = $request['price'];
        $zokumyo_id = $request['zokumyo'];
        $remark = $request['remark'];
        $state = $request['state'];
        $payment_date = $request['payment_date'];

        $danka = Danka::find($danka_id);
        $item_list = [];
        for ($i = 0; $i < count($item_id); $i++) {
            $item = Item::select('name', 'detail', 'price')->join('item_category', 'item_category.id', '=', 'item.category_id')->where('item.id', $item_id[$i])->first();
            if (isset($zokumyo_id[$i])) {
                $hikuyousya = Hikuyousya::select('*')->selectRaw("
                TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki
                ")->where('id', $zokumyo_id[$i])->first();
            }
            $item_list[] = [
                'item_id' => $item_id[$i],
                'hikuyousya_id' => $zokumyo_id[$i],
                'item_name' => $item->name . '：'. $item->detail,
                'quantity' => $quantity[$i],
                'price' => isset($price[$i]) ? $price[$i] : $item->price,
                'total' => isset($price[$i]) ? $price[$i] * $quantity[$i] : $item->price * $quantity[$i],
                'zokumyo' => isset($zokumyo_id[$i]) ? $hikuyousya->common_name : 'なし',
                'kaimyo' => isset($zokumyo_id[$i]) ? $hikuyousya->posthumous : 'なし',
                'meinichi' => isset($zokumyo_id[$i]) ? $hikuyousya->meinichi : 'なし',
                'gyonen' => isset($zokumyo_id[$i]) ? $hikuyousya->gyonen : 'なし',
                'kaiki' => isset($zokumyo_id[$i]) ? $hikuyousya->kaiki : 'なし',
                'remark' => isset($remark[$i]) ? $remark[$i] : '',
                'state' => isset($state[$i]) ? $state[$i] : '未払い',
                'payment_date' => isset($payment_date[$i]) ? $payment_date[$i] : null,
            ];
        }

        $total = 0;
        foreach ($item_list as $item) {
            $total += $item['total'];
        }

        return view('deal_edit_confirm', [
            'danka' => $danka,
            'deal_id' => $deal_id,
            'payment_method' => $payment_method,
            'item_list' => $item_list,
            'total' => $total,
        ]);
    }

    public function deal_store(Request $request)
    {
        $request = $request->all();
        $deal_no = $request['deal_no'];
        $danka_id = $request['danka_id'];
        $payment_method = $request['payment_method'];

        DB::beginTransaction();
        try {
            $deal = new Deal();
            $fill_data = [
                'deal_no' => $deal_no,
                'danka_id' => $danka_id,
                'payment_method' => $payment_method,
            ];
            $deal->fill($fill_data)->save();
            $danka_id = $deal->id;

            $item_len = count($request['item_id']);
            for ($i = 0; $i < $item_len; $i++) {
                $fill_data = [
                    'deal_id' => $danka_id,
                    'item_id' => $request['item_id'][$i],
                    'quantity' => $request['quantity'][$i],
                    'price' => $request['price'][$i],
                    'total' => $request['quantity'][$i] * $request['price'][$i],
                    'hikuyousya_id' => isset($request['hikuyousya_id'][$i]) ? $request['hikuyousya_id'][$i] : '0',
                    'remark' => isset($request['remark'][$i]) ? $request['remark'][$i] : '',
                ];

                $deal_detail = new DealDetail();
                $deal_detail->fill($fill_data)->save();
            }

            DB::commit();
            return redirect()->to('deal_list')->with('message', '取引を作成いたしました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function deal_update(Request $request)
    {
        $request = $request->all();
        $deal_id = $request['deal_id'];

        DB::beginTransaction();
        try {
            DealDetail::where('deal_id', $deal_id)->delete();

            $item_len = count($request['item_id']);
            for ($i = 0; $i < $item_len; $i++) {
                $fill_data = [
                    'deal_id' => $deal_id,
                    'item_id' => $request['item_id'][$i],
                    'quantity' => $request['quantity'][$i],
                    'price' => $request['price'][$i],
                    'total' => $request['quantity'][$i] * $request['price'][$i],
                    'hikuyousya_id' => isset($request['hikuyousya_id'][$i]) ? $request['hikuyousya_id'][$i] : '0',
                    'remark' => isset($request['remark'][$i]) ? $request['remark'][$i] : '',
                    'state' => isset($request['state'][$i]) ? $request['state'][$i] : null,
                    'payment_date' => isset($request['payment_date'][$i]) ? $request['payment_date'][$i] : null,
    
                ];

                $deal_detail = new DealDetail();
                $deal_detail->fill($fill_data)->save();
            }

            DB::commit();
            return redirect()->to('deal_list')->with('message', '取引の更新が完了いたしました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }




    public function item_list(Request $request)
    {
        $item_list = Item::select('item.id as id', 'name', 'detail', 'price')->join('item_category', 'item_category.id', '=', 'item.category_id')->orderBy('item_category.id')->get();
        $item_categories = ItemCategory::get();

        return view('item_list', [
            'item_list' => $item_list,
            'item_categories' => $item_categories,
        ]);
    }

    public function item_store(Request $request)
    {
        $category_id = $request['category_id'];

        $rules = ['detail' => ['required', new ItemCheck($category_id, null)]];
        $item = new Item();

        Validator::make($request->all(), $rules)->validate();


        $request = $request->all();
        $fill_data = [
            'category_id' => $request['category_id'],
            'detail' => $request['detail'],
            'price' => $request['price'],
        ];

        DB::beginTransaction();
        try {
            $item->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('item_list')->with('message', '商品の登録が完了いたしました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function item_edit($id)
    {
        $item = Item::find($id);
        $item_categories = ItemCategory::get();

        return view('item_edit', [
            'item' => $item,
            'item_categories' => $item_categories,
        ]);
    }

    public function item_update(Request $request)
    {
        $item_id = $request['id'];

        $category_id = $request['category_id'];
        $rules = ['detail' => ['required', new ItemCheck($category_id, $item_id)]];

        Validator::make($request->all(), $rules)->validate();

        DB::beginTransaction();
        try {
            $fill_data = [
                'category_id' => $request['category_id'],
                'detail' => $request['detail'],
                'price' => $request['price'],
            ];

            $item = Item::find($item_id);

            $item->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('item_list')->with('message', '商品の編集が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function deal_delete($id)
    {
        DB::beginTransaction();
        try {
            Deal::where('id', $id)->delete();
            DealDetail::where('deal_id', $id)->delete();
            DB::commit();
            return redirect()->route('deal_list')->with('message', '取引を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function item_delete($id)
    {
        DB::beginTransaction();
        try {
            Item::where('id', $id)->delete();
            DealDetail::where('item_id', $id)->delete();

            $deal_id_list = Deal::select('deal.id as id')->selectRaw('count(deal_detail.id) as count')->leftJoin('deal_detail', 'deal.id', '=', 'deal_detail.deal_id')
            ->groupBy('deal.id')->having('count', 0)->get()->pluck('id');
            Deal::whereIn('id', $deal_id_list)->delete();

            DB::commit();
            return redirect()->route('item_list')->with('message', '商品を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function deal_csv_export(Request $request)
    {
        $filter_array = $request->all();
        $name = isset($filter_array['name']) ? $filter_array['name'] : null;
        $name_kana = isset($filter_array['name_kana']) ? $filter_array['name_kana'] : null;
        $tel = isset($filter_array['tel']) ? $filter_array['tel'] : null;
        $item_category_id = isset($filter_array['item_category_id']) ? $filter_array['item_category_id'] : null;
        $created_at_before = isset($filter_array['created_at_before']) ? $filter_array['created_at_before'] : null;
        $created_at_after = isset($filter_array['created_at_after']) ? $filter_array['created_at_after'] : null;
        $payment_before = isset($filter_array['payment_before']) ? $filter_array['payment_before'] : null;
        $payment_after = isset($filter_array['payment_after']) ? $filter_array['payment_after'] : null;
        $price_min = isset($filter_array['price_min']) ? $filter_array['price_min'] : null;
        $price_max = isset($filter_array['price_max']) ? $filter_array['price_max'] : null;
        $sort_item = isset($filter_array['sort_item']) ? $filter_array['sort_item'] : null;
        $sort_type = isset($filter_array['sort_type']) ? $filter_array['sort_type'] : null;
        $type = isset($filter_array['type']) ? $filter_array['type'] : null;

        $query = Deal::select('deal_no', 'payment_date', 'name_kana', 'tel', 'mobile', 'zip', 'pref', 'city', 'address', 'building', 'payment_method', 
            'state', 'detail', 'quantity', 'deal_detail.price as price', 'total', 'common_name', 'common_kana', 'common_kana', 'posthumous', 'meinichi', 'gyonen', 'remark', 
            'danka.id as danka_id', 'danka.name as danka_name', 'item_category.name as item_category_name', 'deal.created_at as created_at')
            ->selectRaw("TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki")
            ->join('danka', 'danka.id', '=', 'deal.danka_id')->join('deal_detail', 'deal.id', '=', 'deal_detail.deal_id')->join('item', 'item.id', '=', 'deal_detail.item_id')
            ->join('item_category', 'item_category.id', '=', 'item.category_id')->leftJoin('hikuyousya', 'deal_detail.hikuyousya_id', '=', 'hikuyousya.id');

        if (!empty($name)) {
            $query->where('name', 'like', "%$name%");
        }

        if (!empty($name_kana)) {
            $query->where('name_kana', 'like', "%$name_kana%");
        }
    
        if (!empty($tel)) {
            $query->where(function ($query) use ($tel) {
                $query->orwhere('tel', 'like', "%$tel%")->orwhere('mobile', 'like', "%$tel%");
            });
        }

        if (!empty($created_at_before)) {
            $query->whereDate('deal.created_at', '>=', $created_at_before);
        }
        if (!empty($created_at_after)) {
            $query->whereDate('deal.created_at', '<=', $created_at_after);
        }

        if (!empty($payment_before)) {
            $query->whereDate('payment_date', '>=', $payment_before);
        }
        if (!empty($payment_after)) {
            $query->whereDate('payment_date', '<=', $payment_after);
        }

        if (!empty($item_category_id)) {
            $query->where('category_id', $item_category_id);
        }

        if (!empty($type)) {
            if ($type != 'すべて') {
                $query->where('state', $type);
            }
        } else {
            $type = '未払い';
            $query->where('state', $type);
        }

        if (!empty($price_min)) {
            $query->having('total', '>=', $price_min);
        }

        if (!empty($price_max)) {
            $query->having('total', '<=', $price_max);
        }

        if (!empty($sort_item)) {
            if ($sort_item == 'created_at') {
                $query->orderByRaw('deal.' . $sort_item . ' is null asc')->orderBy('deal.' . $sort_item, $sort_type);
            } else {
                $query->orderByRaw($sort_item . ' is null asc')->orderBy($sort_item, $sort_type);
            }
        }

        if (!empty($type) && $type == '支払済') {
            $query->orderBy('payment_date', 'desc');
        } else {
            $query->orderBy('deal_no', 'desc');
        }

        $deal_list = $query->get();

        $cvsList[] = ['取引番号', '作成日', '支払い確認日', 'カルテナンバー', '施主名', 'フリガナ（施主｝', '電話番号', '携帯番号', 'メールアドレス', '郵便番号', '住所1', '住所2', 
        '取引方法', 'ステータス', '商品カテゴリー', '詳細', '単価', '数量', '金額', '俗名', 'フリガナ（被供養者｝', '戒名', '命日', '周忌/回忌', '行年', '備考',
        ];
        foreach ($deal_list as $deal) {
            $cvsList[] = $deal->outputCsvContent();
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
        
        $item_category_name = '';
        if (!empty($item_category_id)) {
            $item_category_name = ItemCategory::find($item_category_id)->name . '_';
        }

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="取引_'. $item_category_name . $type . date('YmdHis') .'.csv"');
 
        return $response;
    }
    
    





}
