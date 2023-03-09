<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Danka;
use App\Models\Hikuyousya;
use App\Models\Family;
use App\Models\Item;
use App\Models\Deal;
use App\Models\DealDetail;
use App\Models\DankaDate;
use App\Models\DankaBook;
use App\Rules\DankaCheck;
use Symfony\Component\HttpFoundation\StreamedResponse;
use DB;

class CsvController extends Controller
{

    public function danka_csv_test()
    {
        return view('danka_csv_test');
    }

    public function hikuyousya_csv_test()
    {
        return view('hikuyousya_csv_test');
    }

    public function deal_csv_test()
    {
        return view('deal_csv_test');
    }

    public function family_csv_test()
    {
        return view('family_csv_test');
    }

    public function nenki_csv_test()
    {
        return view('nenki_csv_test');
    }

    public function konryu_csv_test()
    {
        return view('konryu_csv_test');
    }



    public function danka_csv_import(Request $request)
    {
        $fp = fopen($request->csv, 'r');
        
        DB::beginTransaction();
        try {
            while($data = fgetcsv($fp)){
                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                if ($data[0] == '施主コード') {
                    continue;
                }
                if (empty($data[1])) {
                    continue;
                }
                $count = Danka::where('id', $data[0])->get()->count();
                if ($count > 0) {
                    continue;
                }
                
                $pref_tmp = mb_substr($data[6], 0, 4);
                if ($pref_tmp == '神奈川県' || $pref_tmp == '和歌山県' || $pref_tmp == '鹿児島県') {
                    $pref = $pref_tmp;
                } else {
                    $pref = mb_substr($data[6], 0, 3);
                }
                $city = str_replace($pref, '', $data[6]);

                $fill_data = [
                    'id' => $data[0],
                    'name' => $data[1],
                    'name_kana' => mb_convert_kana($data[2], "KVa"),
                    'notices' => $data[3] . '　' . $data[12],
                    'introducer' => $data[4],
                    'zip' => str_replace('-', '', $data[5]),
                    'pref' => $pref,
                    'city' => $city,
                    'address' => $data[7],
                    'tel' => str_replace('-', '', $data[8]),
                    'mobile' => isset($data[9]) ? str_replace('-', '', $data[9]) : '',
                    'star_flg' => $data[10] ? 0 : 1,
                    'segaki_flg' => $data[11] ? 0 : 1,
                ];
                
                $danka = new Danka();
                $danka->fill($fill_data)->save();
            }

            DB::commit();
            fclose($fp);
            return redirect()->route('danka_csv_test')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
            var_dump($e);
        }  
        fclose($fp);

        return;
    }

    public function hikuyousya_csv_import(Request $request)
    {
        $fp = fopen($request->csv, 'r');
        
        DB::beginTransaction();
        try {
            while($data = fgetcsv($fp)){
                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                if ($data[0] == '施主コード') {
                    continue;
                }
                if (empty($data[1])) {
                    continue;
                }

                $nokotsu_no = str_pad($data[6], 6, 0, STR_PAD_LEFT);

                $fill_data = [
                    'danka_id' => $data[0],
                    'ihai_no' => $data[1],
                    'posthumous' => $data[2],
                    'common_name' => $data[3],
                    'gyonen' => empty($data[4]) ? null : $data[4],
                    'meinichi' => empty($data[5]) ? null : $data[5],
                    'nokotsu_no' => $nokotsu_no,
                    'nokotsubi' => $data[7],
                    'nokotsuidobi' => $data[8],
                    'column' => $data[9],
                ];
                
                $hikuyousya = new Hikuyousya();
                $hikuyousya->fill($fill_data)->save();
            }

            DB::commit();
            fclose($fp);
            return redirect()->route('hikuyousya_csv_test')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
            var_dump($e);
        }  
        fclose($fp);

        return;
    }

    public function family_csv_import(Request $request)
    {
        $fp = fopen($request->csv, 'r');
        
        DB::beginTransaction();
        try {
            while($data = fgetcsv($fp)){
                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                if ($data[0] == '施主コード') {
                    continue;
                }
                if (empty($data[1])) {
                    continue;
                }

                $fill_data = [
                    'danka_id' => $data[0],
                    'name' => $data[1],
                ];
                
                $hikuyousya = new Family();
                $hikuyousya->fill($fill_data)->save();
            }

            DB::commit();
            fclose($fp);
            return redirect()->route('family_csv_test')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
            var_dump($e);
        }  
        fclose($fp);

        return;
    }

    public function deal_csv_import(Request $request)
    {
        $fp = fopen($request->csv, 'r');
        
        $item_id = [
            6 =>  Item::where('detail', '位牌')->first()->id,
            7 =>  Item::where('detail', '年忌')->first()->id,
            8 =>  Item::where('detail', '星まつり')->first()->id,
            9 =>  Item::where('detail', '写経')->first()->id,
            10 => Item::where('detail', '水子')->first()->id,
            11 => Item::where('detail', '納骨')->first()->id,
            12 => Item::where('detail', '盆彼')->first()->id,
            13 => Item::where('detail', '寄付')->first()->id,
            14 => Item::where('detail', 'お供え')->first()->id,
            15 => Item::where('detail', '施餓鬼')->first()->id,
            16 => Item::where('detail', 'お布施')->first()->id,
            17 => Item::where('detail', '戒名料')->first()->id,
            18 => Item::where('detail', '絵天井')->first()->id,
            19 => Item::where('detail', 'その他')->first()->id,
            20 => Item::where('detail', 'お祝い')->first()->id,
        ];


        DB::beginTransaction();
        try {
            while($data = fgetcsv($fp)){
                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                var_dump($data);
                if ($data[0] == '対象年度') {
                    continue;
                }
                if (empty($data[1])) {
                    continue;
                }

                $deal_year = mb_substr($data[0], 0, 4);
                if (strlen($data[1]) > 6) {
                    $deal_tmp = str_pad(substr($data[1], -6), 6, 0, STR_PAD_LEFT);
                } else {
                    $deal_tmp = str_pad($data[1], 6, 0, STR_PAD_LEFT);
                }
                $deal_no = $deal_year . $deal_tmp;

                $payment_date = str_replace('年', '-', $data[4]);
                $payment_date = str_replace('月', '-', $payment_date);
                $payment_date = str_replace('日', '', $payment_date);

                $payment_tmp = substr($data[5], 0, 1);

                if ($payment_tmp == 4 || $payment_tmp == 5) {
                    $payment_method = '銀行振込';
                } else {
                    $payment_method = substr_replace($data[5], "", 0,2);
                }


                $hikuyousya_id = 0;
                if (!empty($data[3])) {
                    $hikuyousya = Hikuyousya::where('danka_id', $data[2])->where('common_name', $data[3])->first();
                    if (isset($hikuyousya)) {
                        $hikuyousya_id = $hikuyousya->id;
                    }
                }

                $fill_data = [
                    'deal_no' => $deal_no,
                    'danka_id' => $data[2],
                    'payment_method' => $payment_method,
                    'state' => '支払済',
                    'payment_date' => $payment_date,
                    'created_at' => $payment_date,
                ];
                
                $deal = new Deal();
                $deal->fill($fill_data)->save();


                for ($i = 6; $i <= 20; $i++) {
                    if ($data[$i] > 0) {
                        $fill_data = [
                            'deal_id' => $deal->id,
                            'item_id' => $item_id[$i],
                            'quantity' => 1,
                            'price' => $data[$i],
                            'total' => $data[$i],
                            'hikuyousya_id' => $hikuyousya_id,
                            'remark' => $data[21],
                        ];
    
                        $deal_detail = new DealDetail();
                        $deal_detail->fill($fill_data)->save();
                    }
                }

            }

            DB::commit();
            fclose($fp);
            return redirect()->route('deal_csv_test')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
            var_dump($e);
        }  
        fclose($fp);

        return;
    }

    public function nenki_csv_import(Request $request)
    {
        $fp = fopen($request->csv, 'r');
        
        DB::beginTransaction();
        try {
            while($data = fgetcsv($fp)){
                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                if ($data[0] == '施主コード') {
                    continue;
                }

                Hikuyousya::where('danka_id', $data[0])->update(['kaiki_flg' => 1]);
            }

            DB::commit();
            fclose($fp);
            return redirect()->route('nenki_csv_test')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
            var_dump($e);
        }  
        fclose($fp);

        return;
    }

    public function konryu_csv_import(Request $request)
    {
        $fp = fopen($request->csv, 'r');
        
        DB::beginTransaction();
        try {
            while($data = fgetcsv($fp)){
                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                if ($data[0] == '施主コード') {
                    continue;
                }

                Hikuyousya::where('danka_id', $data[0])->where('ihai_no', $data[1])->update(['konryubi' => $data[2]]);
            }

            DB::commit();
            fclose($fp);
            return redirect()->route('konryu_csv_test')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
            var_dump($e);
        }  
        fclose($fp);

        return;
    }


}
