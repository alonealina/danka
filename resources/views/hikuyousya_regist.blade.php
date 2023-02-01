@extends('layouts.app')

@section('content')
<div class="content_title">被供養者追加</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('hikuyousya_store') }}" method="post">
@csrf
{{ Form::hidden('danka_id', $danka_id) }}
    <div class="danka_other_div">
        <div class="danka_other_content">
            <div class="hikuyousya_regist_form">
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
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">俗名 <span class="require_mark">※</span></div>
                        {{ Form::text('common_name', old('common_name'), ['id' => 'common_name', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => '俗名']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">フリガナ <span class="require_mark">※</span></div>
                        {{ Form::text('common_kana', old('common_kana'), ['id' => 'common_kana', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => 'フリガナ']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">性別</div>
                        <select name="gender_h" class="select_category" style="width: 50px;">
                            <option value="m">男</option>
                            <option value="f">女</option>
                            <option value="o">その他</option>
                        </select>
                    </div>

                </div>

                <div class="">
                    <div class="danka_column">
                        <div class="danka_regist_name2">戒名</div>
                        {{ Form::text('posthumous', old('posthumous'), ['class' => 'danka_form_text2', 'maxlength' => 50, 'style' => 'width: 300px;', 'placeholder' => '戒名']) }}
                    </div>
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
                        {{ Form::text('column', old('column'), ['class' => 'danka_form_text2', 'maxlength' => 100, 'style' => 'width: 500px;', 'placeholder' => '']) }}
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
    </div>




    
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">作成</a>
</form>
<script src="{{ asset('js/hikuyousya_regist.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



