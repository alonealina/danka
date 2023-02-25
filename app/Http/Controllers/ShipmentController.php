<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Text;
use App\Models\Shipment;
use App\Models\ShipmentCategory;
use App\Rules\ShipmentCategoryCheck;
use DB;

class ShipmentController extends Controller
{
    public function shipment_regist(Request $request)
    {
        $shipment_categories = ShipmentCategory::get();

        return view('shipment_regist', [
            'shipment_categories' => $shipment_categories,
        ]);
    }

    public function shipment_store(Request $request)
    {
        $shipment = new Shipment;

        $file = $request->file;
        $category_id = $request['category_id'];
        $file_name = $file->getClientOriginalName();
        

        $fill_data = [
            'category_id' => $category_id,
            'title' => $file_name,
        ];

        DB::beginTransaction();

            $shipment->fill($fill_data)->save();
            $target_path = public_path('shipment/'. $category_id . '/');
            $file->move($target_path, $file_name);    

            DB::commit();
            return redirect()->route('shipment_list', ['id' => $category_id])->with('message', 'ファイルの登録が完了いたしました。');
    }

    public function shipment_list($category_id)
    {
        $category = ShipmentCategory::find($category_id);

        $shipment_list = Shipment::where('category_id', $category_id)->get();

        return view('shipment_list', [
            'category' => $category,
            'shipment_list' => $shipment_list,
        ]);
    }

    public function shipment_category_list(Request $request)
    {
        $shipment_categories = ShipmentCategory::get();

        return view('shipment_category_list', [
            'shipment_categories' => $shipment_categories,
        ]);
    }

    public function shipment_dl($id)
    {
        $shipment = Shipment::find($id);
        $category_id = $shipment->category_id;
        $file_name = $shipment->title;
        $file_path = '../public/'. $category_id . '/' . $file_name;
        
        $mimeType = Storage::mimeType($file_path);
        $headers = [['Content-Type' => $mimeType]];
        
        return Storage::download($file_path, $file_name, $headers);

    }

    public function shipment_show($category_id)
    {
        $category = ShipmentCategory::find($category_id);
        $shipment_list = Text::where('category_id', $category_id)->get();

        return view('shipment_show', [
            'category' => $category,
            'shipment_list' => $shipment_list,

        ]);
    }

    public function shipment_edit($id)
    {
        $shipment_categories = ShipmentCategory::get();
        
        $text = Text::find($id);

        return view('shipment_edit', [
            'shipment_categories' => $shipment_categories,
            'text' => $text,
        ]);
    }

    public function shipment_update(Request $request)
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
            return redirect()->to('shipment_list')->with('message', '文章の編集が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function shipment_delete($id)
    {
        $shipment = Shipment::find($id);
        $category_id = $shipment->category_id;
        $file_name = $shipment->title;
        $file_path = public_path('shipment/' . $category_id . '/' . $file_name);

        DB::beginTransaction();
        try {
            Shipment::where('id', $id)->delete();
            if(file_exists($file_path)){
                unlink($file_path);
            }

            DB::commit();
            return redirect()->route('shipment_list', ['id' => $category_id])->with('message', 'ファイルを削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function shipment_category_store(Request $request)
    {
        $rules = [
            'name' => ['required', new ShipmentCategoryCheck()],
        ];

        $messages = [
            'name.required' => 'IDを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $shipment_category = new ShipmentCategory;

        $request = $request->all();
        $fill_data = [
            'name' => $request['name'],
        ];

        DB::beginTransaction();
        try {
            $shipment_category->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('shipment_category_list')->with('message', 'カテゴリの登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


}
