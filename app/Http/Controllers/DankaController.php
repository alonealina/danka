<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Danka;
use App\Models\Hikuyousya;
use App\Models\Family;
use App\Models\TextCategory;
use App\Models\DankaDate;
use App\Models\DankaBook;
use App\Rules\TextCategoryCheck;
use DB;

class DankaController extends Controller
{
    public function danka_regist()
    {
        $ihai_max = intval(Hikuyousya::max('ihai_no'));
        $ihai_next = str_pad($ihai_max + 1, 4, 0, STR_PAD_LEFT);

        return view('danka_regist', [
            'ihai_next' => $ihai_next,
        ]);
    }

    public function danka_store(Request $request)
    {
        $danka = new Danka;

        $request = $request->all();
        $fill_data = [
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
            'yakushiji_flg' => isset($request['yakushiji_flg']) ? $request['yakushiji_flg'] : 0,
        ];

        DB::beginTransaction();
        try {
            $danka->fill($fill_data)->save();
            $danka_id = $danka->id;

            if (isset($request['hikuyousya_flg'])) {
                $fill_data = [
                    'danka_id' => $danka_id,
                    'type' => $request['type'],
                    'common_name' => $request['common_name'],
                    'common_kana' => $request['common_kana'],
                    'posthumous' => $request['posthumous'],
                    'gender_h' => $request['gender_h'],
                    'meinichi' => $request['meinichi'],
                    'nokotsubi' => $request['nokotsubi'],
                    'konryubi' => $request['konryubi'],
                    'gyonen' => $request['gyonen'],
                    'ihai_no' => isset($request['ihai_flg']) ? $request['ihai_no'] : "0000",
                    'column' => $request['column'],
                    'kaiki_flg' => isset($request['kaiki_flg']) ? $request['kaiki_flg'] : 0,
                ];
        
                $hikuyousya = new Hikuyousya();
                $hikuyousya->fill($fill_data)->save();
            }

            $family_len = count($request['family_name']);
            for ($i = 0; $i < $family_len; $i++) {
                if(isset($request['family_name'][$i]) && isset($request['family_kana'][$i])) {
                    $fill_data = [
                        'danka_id' => $danka_id,
                        'name' => $request['family_name'][$i],
                        'name_kana' => $request['family_kana'][$i],
                        'relationship' => isset($request['relationship'][$i]) ? $request['relationship'][$i] : '',
                        'tel' => isset($request['family_tel'][$i]) ? $request['family_tel'][$i] : '',
                    ];

                    $family = new Family();
                    $family->fill($fill_data)->save();
                }
            }


            
            DB::commit();
            return redirect()->route('danka_regist')->with('message', '檀家の登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function danka_edit($id)
    {
        $danka = Danka::find($id);

        return view('danka_edit', [
            'danka' => $danka,
        ]);
    }

    public function danka_update(Request $request)
    {

        $request = $request->all();
        $id = $request['id'];
        $danka = Danka::find($id);

        $fill_data = [
            'id' => $id,
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
            'yakushiji_flg' => isset($request['yakushiji_flg']) ? $request['yakushiji_flg'] : 0,
        ];

        DB::beginTransaction();
        try {
            $danka->fill($fill_data)->update();

            DB::commit();
            return redirect()->route('danka_detail', $id)->with('message', '檀家の編集が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function hikuyousya_regist($danka_id)
    {
        $ihai_max = intval(Hikuyousya::max('ihai_no'));
        $ihai_next = str_pad($ihai_max + 1, 4, 0, STR_PAD_LEFT);

        return view('hikuyousya_regist', [
            'danka_id' => $danka_id,
            'ihai_next' => $ihai_next,
        ]);
    }

    public function hikuyousya_store(Request $request)
    {
        $request = $request->all();

        DB::beginTransaction();
        try {
            $fill_data = [
                'danka_id' => $request['danka_id'],
                'type' => $request['type'],
                'common_name' => $request['common_name'],
                'common_kana' => $request['common_kana'],
                'posthumous' => $request['posthumous'],
                'gender_h' => $request['gender_h'],
                'meinichi' => $request['meinichi'],
                'nokotsubi' => $request['nokotsubi'],
                'konryubi' => $request['konryubi'],
                'gyonen' => $request['gyonen'],
                'ihai_no' => isset($request['ihai_flg']) ? $request['ihai_no'] : "0000",
                'column' => $request['column'],
                'kaiki_flg' => isset($request['kaiki_flg']) ? $request['kaiki_flg'] : 0,
            ];

            $hikuyousya = new Hikuyousya();
            $hikuyousya->fill($fill_data)->save();
            
            DB::commit();
            return redirect()->route('danka_detail', $request['danka_id'])->with('message', '被供養者の登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function hikuyousya_edit($hikuyousya_id)
    {
        $hikuyousya = Hikuyousya::find($hikuyousya_id);
        $ihai_no = $hikuyousya->ihai_no;

        if ($ihai_no == "0000") {
            $ihai_max = intval(Hikuyousya::max('ihai_no'));
            $ihai_no = str_pad($ihai_max + 1, 4, 0, STR_PAD_LEFT);
        }

        return view('hikuyousya_edit', [
            'hikuyousya' => $hikuyousya,
            'ihai_no' => $ihai_no,
        ]);
    }

    public function hikuyousya_update(Request $request)
    {
        $request = $request->all();
        $hikuyousya_id = $request['hikuyousya_id'];

        DB::beginTransaction();
        try {
            $fill_data = [
                'type' => $request['type'],
                'common_name' => $request['common_name'],
                'common_kana' => $request['common_kana'],
                'posthumous' => $request['posthumous'],
                'gender_h' => $request['gender_h'],
                'meinichi' => $request['meinichi'],
                'nokotsubi' => $request['nokotsubi'],
                'konryubi' => $request['konryubi'],
                'gyonen' => $request['gyonen'],
                'ihai_no' => isset($request['ihai_flg']) ? $request['ihai_no'] : "0000",
                'column' => $request['column'],
                'kaiki_flg' => isset($request['kaiki_flg']) ? $request['kaiki_flg'] : 0,
            ];

            $hikuyousya = Hikuyousya::find($hikuyousya_id);

            $hikuyousya->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('danka_detail', $request['danka_id'])->with('message', '被供養者の編集が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


    public function family_regist($danka_id)
    {
        return view('family_regist', [
            'danka_id' => $danka_id,
        ]);
    }

    public function family_store(Request $request)
    {
        $request = $request->all();

        DB::beginTransaction();
        try {

            $family_len = count($request['family_name']);
            for ($i = 0; $i < $family_len; $i++) {
                if(isset($request['family_name'][$i]) && isset($request['family_kana'][$i])) {
                    $fill_data = [
                        'danka_id' => $request['danka_id'],
                        'name' => $request['family_name'][$i],
                        'name_kana' => $request['family_kana'][$i],
                        'relationship' => isset($request['relationship'][$i]) ? $request['relationship'][$i] : '',
                        'tel' => isset($request['family_tel'][$i]) ? $request['family_tel'][$i] : '',
                    ];

                    $family = new Family();
                    $family->fill($fill_data)->save();
                }
            }

            
            DB::commit();
            return redirect()->route('danka_detail', $request['danka_id'])->with('message', '家族の登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function family_edit($family_id)
    {
        $family = Family::find($family_id);

        return view('family_edit', [
            'family' => $family,
        ]);
    }

    public function family_update(Request $request)
    {
        $request = $request->all();
        $family_id = $request['family_id'];

        DB::beginTransaction();
        try {
            $fill_data = [
                'name' => $request['name'],
                'name_kana' => $request['name_kana'],
                'relationship' => $request['relationship'],
                'tel' => $request['tel'],
            ];

            $family = Family::find($family_id);

            $family->fill($fill_data)->update();
            
            DB::commit();
            return redirect()->route('danka_detail', $request['danka_id'])->with('message', '家族の編集が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


    public function danka_search(Request $request)
    {
        $filter_array = $request->all();
        $id = isset($filter_array['id']) ? $filter_array['id'] : null;
        $name = isset($filter_array['name']) ? $filter_array['name'] : null;
        $name_kana = isset($filter_array['name_kana']) ? $filter_array['name_kana'] : null;
        $tel = isset($filter_array['tel']) ? $filter_array['tel'] : null;
        $mail = isset($filter_array['mail']) ? $filter_array['mail'] : null;
        $freeword = isset($filter_array['freeword']) ? $filter_array['freeword'] : null;
        $area = isset($filter_array['area']) ? $filter_array['area'] : null;
        $zip = isset($filter_array['zip']) ? $filter_array['zip'] : null;
        $pref = isset($filter_array['pref']) ? $filter_array['pref'] : null;
        $address = isset($filter_array['address']) ? $filter_array['address'] : null;
        $segaki_flg = isset($filter_array['segaki_flg']) ? $filter_array['segaki_flg'] : null;
        $star_flg = isset($filter_array['star_flg']) ? $filter_array['star_flg'] : null;
        $yakushiji_flg = isset($filter_array['yakushiji_flg']) ? $filter_array['yakushiji_flg'] : null;

        $query = Danka::select('*');

        if (!empty($id)) {
            $query->where('id', 'like', "%$id%");
        }

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

        if (!empty($mail)) {
            $query->where('mail', 'like', "%$mail%");
        }

        if (!empty($zip)) {
            $query->where('zip', 'like', "%$zip%");
        }

        if (!empty($area)) {
            $query->where(function ($query) use ($area) {
                if ($area == "北海道") {
                    $query->orwhere('pref', 'like', "%北海道%");
                } elseif ($area == "東北") {
                    $query->orwhere('pref', 'like', "%青森県%")->orwhere('pref', 'like', "%岩手県%")->orwhere('pref', 'like', "%宮城県%")->orwhere('pref', 'like', "%秋田県%")
                    ->orwhere('pref', 'like', "%山形県%")->orwhere('pref', 'like', "%福島県%");
                } elseif ($area == "関東") {
                    $query->orwhere('pref', 'like', "%茨城県%")->orwhere('pref', 'like', "%栃木県%")->orwhere('pref', 'like', "%群馬県%")->orwhere('pref', 'like', "%埼玉県%")
                    ->orwhere('pref', 'like', "%千葉県%")->orwhere('pref', 'like', "%東京都%")->orwhere('pref', 'like', "%神奈川県%");
                } elseif ($area == "中部") {
                    $query->orwhere('pref', 'like', "%新潟県%")->orwhere('pref', 'like', "%富山県%")->orwhere('pref', 'like', "%石川県%")->orwhere('pref', 'like', "%福井県%")
                    ->orwhere('pref', 'like', "%山梨県%")->orwhere('pref', 'like', "%長野県%")->orwhere('pref', 'like', "%岐阜県%")
                    ->orwhere('pref', 'like', "%静岡県%")->orwhere('pref', 'like', "%愛知県%");
                } elseif ($area == "近畿") {
                    $query->orwhere('pref', 'like', "%三重県%")->orwhere('pref', 'like', "%滋賀県%")->orwhere('pref', 'like', "%京都府%")->orwhere('pref', 'like', "%大阪府%")
                    ->orwhere('pref', 'like', "%兵庫県%")->orwhere('pref', 'like', "%奈良県%")->orwhere('pref', 'like', "%和歌山県%");
                } elseif ($area == "中国") {
                    $query->orwhere('pref', 'like', "%鳥取県%")->orwhere('pref', 'like', "%島根県%")->orwhere('pref', 'like', "%岡山県%")
                    ->orwhere('pref', 'like', "%広島県%")->orwhere('pref', 'like', "%山口県%");
                } elseif ($area == "四国") {
                    $query->orwhere('pref', 'like', "%徳島県%")->orwhere('pref', 'like', "%香川県%")->orwhere('pref', 'like', "%愛媛県%")->orwhere('pref', 'like', "%高知県%");
                } elseif ($area == "九州") {
                    $query->orwhere('pref', 'like', "%福岡県%")->orwhere('pref', 'like', "%佐賀県%")->orwhere('pref', 'like', "%長崎県%")->orwhere('pref', 'like', "%熊本県%")
                    ->orwhere('pref', 'like', "%大分県%")->orwhere('pref', 'like', "%宮崎県%")->orwhere('pref', 'like', "%鹿児島県%")->orwhere('pref', 'like', "%沖縄県%");
                } 
            });
        }

        if (!empty($pref)) {
            $query->where('pref', 'like', "%$pref%");
        }

        if (!empty($address)) {
            $query->where(function ($query) use ($address) {
                $query->orwhere('city', 'like', "%$address%")->orwhere('address', 'like', "%$address%")->orwhere('building', 'like', "%$address%");
            });
        }

        if (!empty($freeword)) {
            $freeword = mb_convert_kana($freeword, 's');
            $word_list = explode(" ", $freeword);
            $query->where(function ($query) use ($word_list) {
                foreach ($word_list as $word) {
                    if (!empty($word)) {
                        $query->orwhere('notices', 'like', "%$word%")->orwhere('pref', 'like', "%$word%");
                    }
                }
            });
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



        $number = \Request::get('number');
        if (isset($number)) {
            $danka_list = $query->orderBy('id')->paginate($number)
            ->appends(["number" => $number]);
        } else {
            $danka_list = $query->orderBy('id')->paginate(10);
            $number = 5;
        }

        return view('danka_search', [
            'danka_list' => $danka_list,

            'id' => $id,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'mail' => $mail,
            'freeword' => $freeword,
            'area' => $area,
            'zip' => $zip,
            'pref' => $pref,
            'address' => $address,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'number' => $number,
        ]);
    }

    public function hikuyousya_search(Request $request)
    {
        $filter_array = $request->all();
        $danka_id = isset($filter_array['danka_id']) ? $filter_array['danka_id'] : null;
        $name = isset($filter_array['name']) ? $filter_array['name'] : null;
        $name_kana = isset($filter_array['name_kana']) ? $filter_array['name_kana'] : null;
        $type = isset($filter_array['type']) ? $filter_array['type'] : null;
        $common_name = isset($filter_array['common_name']) ? $filter_array['common_name'] : null;
        $common_kana = isset($filter_array['common_kana']) ? $filter_array['common_kana'] : null;
        $posthumous = isset($filter_array['posthumous']) ? $filter_array['posthumous'] : null;
        $freeword = isset($filter_array['freeword']) ? $filter_array['freeword'] : null;
        $meinichi_before = isset($filter_array['meinichi_before']) ? $filter_array['meinichi_before'] : null;
        $meinichi_after = isset($filter_array['meinichi_after']) ? $filter_array['meinichi_after'] : null;
        $kaiki_before = isset($filter_array['kaiki_before']) ? $filter_array['kaiki_before'] : null;
        $kaiki_after = isset($filter_array['kaiki_after']) ? $filter_array['kaiki_after'] : null;
        $ihai_no = isset($filter_array['ihai_no']) ? $filter_array['ihai_no'] : null;
        $ihai_flg = isset($filter_array['ihai_flg']) ? $filter_array['ihai_flg'] : null;
        $konryu_flg = isset($filter_array['konryu_flg']) ? $filter_array['konryu_flg'] : null;
        $kaiki_flg = isset($filter_array['kaiki_flg']) ? $filter_array['kaiki_flg'] : null;

        $query = Danka::select('*')->select('hikuyousya.id as id')->selectRaw("
        TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki
        ")->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id');

        if (!empty($danka_id)) {
            $query->where('danka_id', 'like', "%$danka_id%");
        }

        if (!empty($name)) {
            $query->where('name', 'like', "%$name%");
        }

        if (!empty($name_kana)) {
            $query->where('name_kana', 'like', "%$name_kana%");
        }

        if (!empty($type)) {
            $query->where('type', $type);
        }

        if (!empty($common_name)) {
            $query->where('common_name', 'like', "%$common_name%");
        }

        if (!empty($common_kana)) {
            $query->where('common_kana', 'like', "%$common_kana%");
        }

        if (!empty($posthumous)) {
            $query->where('posthumous', 'like', "%$posthumous%");
        }

        if (!empty($pref)) {
            $query->where('zip', 'like', "%$pref%");
        }

        if (!empty($address)) {
            $query->where(function ($query) use ($address) {
                $query->orwhere('city', 'like', "%$address%")->orwhere('address', 'like', "%$address%")->orwhere('building', 'like', "%$address%");
            });
        }

        if (!empty($freeword)) {
            $freeword = mb_convert_kana($freeword, 's');
            $word_list = explode(" ", $freeword);
            $query->where(function ($query) use ($word_list) {
                foreach ($word_list as $word) {
                    if (!empty($word)) {
                        $query->orwhere('column', 'like', "%$word%");
                    }
                }
            });
        }

        if (!empty($meinichi_before)) {
            $query->whereDate('meinichi', '>=', $meinichi_before);
        }
        if (!empty($meinichi_after)) {
            $query->whereDate('meinichi', '<=', $meinichi_after);
        }

        if (isset($ihai_flg)) {
            $query->where('ihai_no', 'not like', '0000');
        }

        if (isset($konryu_flg)) {
            $query->whereNotNull('konryubi');
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

        $ids = $query->get()->pluck('id');
        $query = Danka::select('*')->selectRaw("
        TIMESTAMPDIFF(YEAR, `meinichi`, CURDATE()) AS kaiki
        ")->join('hikuyousya', 'danka.id', '=', 'hikuyousya.danka_id')->whereIn('hikuyousya.id', $ids);

        $number = \Request::get('number');
        if (isset($number)) {
            $danka_list = $query->orderBy('danka_id')->paginate($number)
            ->appends(["number" => $number]);
        } else {
            $danka_list = $query->orderBy('danka_id')->paginate(10);
        }





        return view('hikuyousya_search', [
            'danka_list' => $danka_list,

            'danka_id' => $danka_id,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            'number' => $number,
        ]);
    }

    public function danka_detail($id)
    {
        $danka = Danka::find($id);
        $hikuyousya_list = Hikuyousya::where('danka_id', $id)->get();
        $family_list = Family::where('danka_id', $id)->get();

        return view('danka_detail', [
            'danka' => $danka,
            'hikuyousya_list' => $hikuyousya_list,
            'family_list' => $family_list,
        ]);
    }







    public function db_test()
    {
        return view('db_test');
    }
}
