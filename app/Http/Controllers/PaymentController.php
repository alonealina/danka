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
        $created_at_before = isset($filter_array['created_at_before']) ? $filter_array['created_at_before'] : null;
        $created_at_after = isset($filter_array['created_at_after']) ? $filter_array['created_at_after'] : null;
        $payment_before = isset($filter_array['payment_before']) ? $filter_array['payment_before'] : null;
        $payment_after = isset($filter_array['payment_after']) ? $filter_array['payment_after'] : null;
        $price_min = isset($filter_array['price_min']) ? $filter_array['price_min'] : null;
        $price_max = isset($filter_array['price_max']) ? $filter_array['price_max'] : null;
        $type = isset($filter_array['type']) ? $filter_array['type'] : null;

        $query = Deal::select('deal.id as id','deal_detail.id as deal_detail_id', 'name', 'name_kana', 'tel', 'detail', 'total', 'quantity', 'state', 'payment_date', 'deal.created_at as created_at')
            ->join('danka', 'danka.id', '=', 'deal.danka_id')->join('deal_detail', 'deal.id', '=', 'deal_detail.deal_id')->join('item', 'item.id', '=', 'deal_detail.item_id');

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

        if (!empty($item_id)) {
            $query->where('item_id', $item_id);
        }

        if (!empty($price_min)) {
            $query->where('total', '>=', $price_min);
        }

        if (!empty($price_max)) {
            $query->where('total', '<=', $price_max);
        }

        if (!empty($type)) {
            $query->where('state', $type);
        }



        $number = \Request::get('number');
        if (isset($number)) {
            $deal_list = $query->orderBy('deal.id')->paginate($number)
            ->appends(["number" => $number]);
        } else {
            $deal_list = $query->orderBy('deal.id')->paginate(10);
        }

        $item_list = Item::select('item.id as id', 'name', 'detail', 'price')->join('item_category', 'item_category.id', '=', 'item.category_id')->orderBy('item_category.id')->get();

        return view('deal_list', [
            'deal_list' => $deal_list,
            'item_list' => $item_list,

            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'item_id' => $item_id,
            'created_at_before' => $created_at_before,
            'created_at_after' => $created_at_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'type' => $type,
            'number' => $number,
        ]);
    }

    public function unclaimed_update($id)
    {
        $deal_detail = DealDetail::find($id);

        DB::beginTransaction();
        try {
            $fill_data = [
                'state' => '送付待ち',
            ];

            $deal_detail->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('deal_list')->with('message', 'ステータスを変更しました。');
        } catch (\Exception $e) {
            DB::rollback();
        }

    }

    public function unpaid_update($id)
    {
        $deal_detail = DealDetail::find($id);

        DB::beginTransaction();
        try {
            $fill_data = [
                'state' => '未払い',
                'payment_date' => null,
            ];

            $deal_detail->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('deal_list')->with('message', 'ステータスを変更しました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function paid_update($id)
    {
        $deal_detail = DealDetail::find($id);
        $date = date('Y-m-d');
        DB::beginTransaction();
        try {
            $fill_data = [
                'state' => '支払済',
                'payment_date' => $date,
            ];

            $deal_detail->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('deal_list')->with('message', 'ステータスを変更しました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function deal_regist(Request $request)
    {
        $item_list = Item::select('item.id as id', 'name', 'detail', 'price')->join('item_category', 'item_category.id', '=', 'item.category_id')->orderBy('item_category.id')->get();

        return view('deal_regist', [
            'item_list' => $item_list,
        ]);
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
            ];
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
                'state' => $state[$i],
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
        $danka_id = $request['danka_id'];
        $payment_method = $request['payment_method'];

        DB::beginTransaction();
        try {
            $deal = new Deal();
            $fill_data = [
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
                    'state' => $request['state'][$i],
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
            DB::commit();
            return redirect()->route('item_list')->with('message', '商品を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }






}