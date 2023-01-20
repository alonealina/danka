<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ShipmentCategory;
use App\Models\ItemCategory;
use App\Models\TextCategory;
use App\Rules\TextCategoryCheck;
use DB;

class CategoryController extends Controller
{

    public function category_list(Request $request)
    {
        $shipment_categories = ShipmentCategory::get();
        $item_categories = ItemCategory::get();
        $text_categories = TextCategory::get();

        return view('category_list', [
            'shipment_categories' => $shipment_categories,
            'item_categories' => $item_categories,
            'text_categories' => $text_categories,
        ]);
    }

    public function category_store(Request $request)
    {
        $rules = [
            'name' => ['required', new TextCategoryCheck()],
        ];

        $messages = [
            'name.required' => 'カテゴリ名を入力してください',
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
            return redirect()->to('category_list')->with('message', 'カテゴリの登録が完了いたしました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function shipment_category_delete($id)
    {
        DB::beginTransaction();
        try {
            ShipmentCategory::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('category_list')->with('message', '発送物カテゴリを削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function item_category_delete($id)
    {
        DB::beginTransaction();
        try {
            ItemCategory::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('category_list')->with('message', '商品カテゴリを削除しました');
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
            return redirect()->route('category_list')->with('message', '行事カテゴリを削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
