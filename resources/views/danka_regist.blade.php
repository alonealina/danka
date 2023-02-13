@extends('layouts.app')

@section('content')
<div class="content_title">檀家新規登録</div>
<div class="admin_list_message">{{ session('message') }}</div>
@if($errors->has('name'))
<div class="error_message check_error">{{ $errors->first('name') }}</div>
@endif
<div class="error_message" id="danka_error">{{ $errors->first('name') }}</div>
<div class="error_message" id="hikuyousya_error">{{ $errors->first('name') }}</div>

<form id="admin_store_form" name="danka_store_form" action="{{ route('danka_store') }}" method="post">
@csrf
    <div class="danka_regist_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">施主名 <span class="require_mark">※</span></div>
                {{ Form::text('name', old('name'), ['id' => 'name', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ <span class="require_mark">※</span></div>
                {{ Form::text('name_kana', old('name_kana'), ['id' => 'name_kana', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => 'セイ　メイ']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">性別</div>
                <select name="gender" class="select_category" style="width: 80px;">
                    <option value="m">男</option>
                    <option value="f">女</option>
                    <option value="o">その他</option>
                </select>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">固定番号</div>
                {{ Form::text('tel', old('tel'), ['id' => 'tel', 'class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '半角英数(0736562434)']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">携帯番号</div>
                {{ Form::text('mobile', old('mobile'), ['class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '09012345678']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">メールアドレス</div>
                {{ Form::text('mail', old('mail'), ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => 'XXXXXX1234@gmail.com']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">特記事項</div>
                {{ Form::text('notices', old('notices'), ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '絵天井　XX列XX番、灯籠']) }}
            </div>
        </div>

        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">郵便番号</div>
                {{ Form::text('zip', old('zip'), ['id' => 'zip', 'class' => 'danka_form_text', 'maxlength' => 7, 'placeholder' => '0000000', 'style' => 'width: 180px',
                        'onkeyup' => "AjaxZip3.zip2addr(this, '', 'pref', 'city')"]) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">都道府県</div>
                <select name="pref" class="select_category" style="width: 180px" id="pref">
                    <option value="">選択してください</option>
                    @foreach (config('const.Prefs') as $name)
                    <option value="{{ $name }}"
                        @if(old('pref') == $name) selected @endif >{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">市区町村</div>
                {{ Form::text('city', old('city'), ['id' => 'city', 'class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">番地</div>
                {{ Form::text('address', old('address'), ['id' => 'address', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">マンション等</div>
                {{ Form::text('building', old('building'), ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">紹介者</div>
                {{ Form::text('introducer', old('introducer'), ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <input type="checkbox" id="yakushiji_flg" name="yakushiji_flg" class="danka_checkbox" value="1">
                <label for="yakushiji_flg" class="danka_label">薬師寺霊園</label>
            </div>
        </div>
    </div>

    <div class="danka_other_div">
        <div class="danka_other_tab">
            <a href="#!" id="hikuyousya" onclick="clickHikuyousya()" class="danka_tab danka_current">被供養者</a>
            <a href="#!" id="family" onclick="clickFamily()" class="danka_tab">家族情報</a>
            <div class="danka_space"></div>
        </div>
        <div class="danka_other_content">
            <input type="checkbox" id="hikuyousya_flg" name="hikuyousya_flg" class="danka_checkbox" value="1" @if(old('hikuyousya_flg')) checked @endif>
            <label for="hikuyousya_flg" class="danka_label">登録する</label>
            <div class="hikuyousya_form" id="hikuyousya_form">
                <div class="">
                    <div class="danka_column">
                        <div class="danka_regist_name2">種別</div>
                        <select name="type" class="select_category" style="width: 80px;">
                            <option value="故人">故人</option>
                            <option value="ペット">ペット</option>
                            <option value="水子">水子</option>
                            <option value="先祖">先祖</option>
                            <option value="生前">生前</option>
                        </select>
                        <div class="danka_regist_name2" style="margin-left: 30px; width: 40px;">性別</div>
                        <select name="gender_h" class="select_category" style="width: 50px;">
                            <option value="m">男</option>
                            <option value="f">女</option>
                            <option value="o">その他</option>
                        </select>
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">俗名 <span class="require_mark">※</span></div>
                        {{ Form::text('common_name', old('common_name'), ['id' => 'common_name', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">フリガナ <span class="require_mark">※</span></div>
                        {{ Form::text('common_kana', old('common_kana'), ['id' => 'common_kana', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => 'セイ　メイ']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">戒名</div>
                        {{ Form::text('posthumous', old('posthumous'), ['class' => 'danka_form_text2', 'maxlength' => 50, 'style' => 'width: 260px;', 'placeholder' => '戒名']) }}
                    </div>


                </div>

                <div class="">
                    <div class="danka_column">
                        <div class="danka_regist_name2">命日</div>
                        {{ Form::date('meinichi', old('meinichi'), ['class' => 'danka_form_text2', 'id' => 'meinichi', 'placeholder' => '', 'style' => 'width: 110px;']) }}
                        　<input type="checkbox" id="kaiki_flg" name="kaiki_flg" class="danka_checkbox" value="1">
                        {{ Form::text('kaiki', old('kaiki'), ['class' => 'danka_form_text2', 'id' => 'kaiki_year', 'maxlength' => 2, 'style' => 'width: 30px;', 'disabled']) }}
                        <div class="danka_regist_name2" style="width: 70px;">周忌/回忌</div>
                        <div class="danka_regist_name2" style="margin-left: 50px; width: 40px;">行年</div>
                        {{ Form::text('gyonen', old('gyonen'), ['id' => 'gyonen', 'class' => 'danka_form_text2', 'style' => 'width: 70px;', 'maxlength' => 3, 'placeholder' => '1～150']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">建立日</div>
                        {{ Form::date('konryubi', old('konryubi'), ['class' => 'danka_form_text2', 'id' => 'konryubi', 'placeholder' => '', 'style' => 'width: 110px;']) }}
                        <div class="danka_regist_name2" style="width: 100px; margin-left: 70px;">
                            <input type="checkbox" id="ihai_flg" name="ihai_flg" class="" value="1">
                            <label for="ihai_flg" class="danka_label" style="margin-right: 0;">位牌番号</label>
                        </div>

                        {{ Form::text('ihai_no', $ihai_next, ['class' => 'danka_form_text2', 'maxlength' => 4, 'style' => 'width: 70px;', 'readonly' => 'readonly']) }}

                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">特記事項</div>
                        {{ Form::text('column', old('column'), ['class' => 'danka_form_text2', 'maxlength' => 100, 'style' => 'width: 500px;', 'placeholder' => '骨のぼり']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">遍照閣</div>
                        {{ Form::text('henjokaku', old('henjokaku'), ['class' => 'danka_form_text2', 'maxlength' => 100, 'style' => 'width: 500px;', 'placeholder' => '紫雲の間15列5A']) }}
                    </div>

                </div>

                <div class="">
                    <div class="danka_column">
                        <div class="danka_regist_name2" style="width: 100px;">納骨日</div>
                        {{ Form::date('nokotsubi', old('nokotsubi'), ['class' => 'danka_form_text2', 'id' => 'nokotsubi', 'placeholder' => '', 'style' => 'width: 110px;']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2" style="width: 100px;">納骨移動日</div>
                        {{ Form::date('nokotsuidobi', old('nokotsuidobi'), ['class' => 'danka_form_text2', 'id' => 'nokotsuidobi', 'placeholder' => '', 'style' => 'width: 110px;']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2" style="width: 100px;">
                            <input type="checkbox" id="nokotsu_flg" name="nokotsu_flg" class="" value="1">
                            <label for="nokotsu_flg" class="danka_label" style="margin-right: 0;">納骨番号</label>
                        </div>

                        {{ Form::text('nokotsu_no', $nokotsu_next, ['class' => 'danka_form_text2', 'maxlength' => 6, 'style' => 'width: 70px;', 'readonly' => 'readonly']) }}

                    </div>

                </div>


            
            </div>
        </div>
        <div id="family_form" class="danka_family_content" style="display:none;">
            <a href="#!" onclick="clickAddButton()" class="family_add_btn">＋</a>
            @if(is_null(old('family_name')))
            <div id="family_item" class="family_item">
                <div class="family_column">
                    <div class="danka_regist_name2">氏名</div>
                    {{ Form::text('family_name[]', '', ['id' => 'family_name', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
                </div>
                <div class="family_column">
                    <div class="danka_regist_name2">フリガナ</div>
                    {{ Form::text('family_kana[]', '', ['id' => 'family_kana', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => 'セイ　メイ']) }}
                </div>
                <div class="family_column">
                    <div class="danka_regist_name2" style="width: 50px;">続柄</div>
                    {{ Form::text('relationship[]', '', ['id' => 'relationship', 'class' => 'danka_form_text2', 'maxlength' => 10, 'placeholder' => '', 'style' => 'width: 100px;']) }}
                </div>
                <div class="family_column">
                    <div class="danka_regist_name2">電話番号</div>
                    {{ Form::text('family_tel[]', '', ['id' => 'family_tel', 'class' => 'danka_form_text2', 'maxlength' => 15, 'placeholder' => '09011112222']) }}
                </div>
            </div>
            @else
            @foreach (old('family_name') as $key => $value)
            <div id="family_item" class="family_item">
                <div class="family_column">
                    <div class="danka_regist_name2">氏名</div>
                    {{ Form::text('family_name[]', '', ['id' => 'family_name', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
                </div>
                <div class="family_column">
                    <div class="danka_regist_name2">フリガナ</div>
                    {{ Form::text('family_kana[]', '', ['id' => 'family_kana', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => 'フリガナ']) }}
                </div>
                <div class="family_column">
                    <div class="danka_regist_name2" style="width: 50px;">続柄</div>
                    {{ Form::text('relationship[]', '', ['id' => 'relationship', 'class' => 'danka_form_text2', 'maxlength' => 10, 'placeholder' => '', 'style' => 'width: 100px;']) }}
                </div>
                <div class="family_column">
                    <div class="danka_regist_name2">電話番号</div>
                    {{ Form::text('family_tel[]', '', ['id' => 'family_tel', 'class' => 'danka_form_text2', 'maxlength' => 15, 'placeholder' => '09011112222']) }}
                </div>
            </div>
            @endforeach

            @endif
        </div>
    </div>




    
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">作成</a>
</form>
<script src="{{ asset('js/danka_regist.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



