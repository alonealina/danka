@extends('layouts.app')

@section('content')
<div class="content_title">被供養者編集</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('hikuyousya_update') }}" method="post">
@csrf
{{ Form::hidden('hikuyousya_id', $hikuyousya->id) }}
{{ Form::hidden('danka_id', $hikuyousya->danka_id) }}
    <div class="danka_other_div">
        <div class="danka_other_content">
            <div class="hikuyousya_regist_form">
                <div class="">
                    <div class="danka_column">
                        <div class="danka_regist_name2">種別</div>
                        <select name="type" class="select_category" style="width: 80px;">
                            <option value="故人" @if($hikuyousya->type == '故人') selected @endif>故人</option>
                            <option value="ペット" @if($hikuyousya->type == 'ペット') selected @endif>ペット</option>
                            <option value="水子" @if($hikuyousya->type == '水子') selected @endif>水子</option>
                            <option value="先祖" @if($hikuyousya->type == '先祖') selected @endif>先祖</option>
                            <option value="生前" @if($hikuyousya->type == '生前') selected @endif>生前</option>
                        </select>
                        <div class="danka_regist_name2" style="margin-left: 30px; width: 40px;">性別</div>
                        <select name="gender_h" class="select_category" style="width: 50px;">
                            <option value="m" @if($hikuyousya->gender_h == 'm') selected @endif>男</option>
                            <option value="f" @if($hikuyousya->gender_h == 'f') selected @endif>女</option>
                            <option value="o" @if($hikuyousya->gender_h == 'o') selected @endif>その他</option>
                        </select>
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">俗名 <span class="require_mark">※</span></div>
                        {{ Form::text('common_name', $hikuyousya->common_name, ['id' => 'common_name', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => '俗名']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">フリガナ <span class="require_mark">※</span></div>
                        {{ Form::text('common_kana', $hikuyousya->common_kana, ['id' => 'common_kana', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => 'フリガナ']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">戒名</div>
                        {{ Form::text('posthumous', $hikuyousya->posthumous, ['class' => 'danka_form_text2', 'maxlength' => 50, 'style' => 'width: 300px;', 'placeholder' => '戒名']) }}
                    </div>

                </div>

                <div class="">
                    <div class="danka_column">
                        <div class="danka_regist_name2">命日</div>
                        {{ Form::date('meinichi', $hikuyousya->meinichi, ['class' => 'danka_form_text2', 'id' => 'meinichi', 'placeholder' => '', 'style' => 'width: 110px;']) }}
                        　<input type="checkbox" id="kaiki_flg" name="kaiki_flg" class="danka_checkbox" value="1" @if($hikuyousya->kaiki_flg) checked @endif>
                        {{ Form::text('kaiki', $kaiki, ['class' => 'danka_form_text2', 'id' => 'kaiki_year', 'maxlength' => 2, 'style' => 'width: 30px;', 'disabled']) }}
                        <div class="danka_regist_name2" style="width: 70px;">周忌/回忌</div>
                        <div class="danka_regist_name2" style="margin-left: 50px; width: 40px;">行年</div>
                        {{ Form::text('gyonen', $hikuyousya->gyonen, ['id' => 'gyonen', 'class' => 'danka_form_text2', 'style' => 'width: 70px;', 'maxlength' => 3, 'placeholder' => '1～150']) }}

                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2">建立日</div>
                        {{ Form::date('konryubi', $hikuyousya->konryubi, ['class' => 'danka_form_text2', 'id' => 'konryubi', 'placeholder' => '', 'style' => 'width: 110px;']) }}
                        <div class="danka_regist_name2" style="width: 100px; margin-left: 70px;">
                            <input type="checkbox" id="ihai_flg" name="ihai_flg" class="" value="1" @if($hikuyousya->ihai_no != '0000') checked @endif>
                            <label for="ihai_flg" class="danka_label" style="margin-right: 0;">位牌番号</label>
                        </div>

                        {{ Form::text('ihai_no', $ihai_no, ['class' => 'danka_form_text2', 'maxlength' => 4, 'style' => 'width: 70px;', 'readonly' => 'readonly']) }}
                    </div>

                    <div class="danka_column">
                        <div class="danka_regist_name2">特記事項</div>
                        {{ Form::text('column', $hikuyousya->column, ['class' => 'danka_form_text2', 'maxlength' => 100, 'style' => 'width: 500px;', 'placeholder' => '骨のぼり']) }}
                    </div>

                    <div class="danka_column">
                        <div class="danka_regist_name2">遍照閣</div>
                        <select name="henjokaku1" class="select_category" style="width: 80px;" id="henjokaku1">
                            <option value="">----</option>
                            <option value="紫雲の間" @if($hikuyousya->henjokaku1 == '紫雲の間') selected @endif>紫雲の間</option>
                            <option value="金剛の間" @if($hikuyousya->henjokaku1 == '金剛の間') selected @endif>金剛の間</option>
                            <option value="登天の間" @if($hikuyousya->henjokaku1 == '登天の間') selected @endif>登天の間</option>
                            <option value="萬燈の間" @if($hikuyousya->henjokaku1 == '萬燈の間') selected @endif>萬燈の間</option>
                            <option value="宝珠の間" @if($hikuyousya->henjokaku1 == '宝珠の間') selected @endif>宝珠の間</option>
                            <option value="心蓮の間" @if($hikuyousya->henjokaku1 == '心蓮の間') selected @endif>心蓮の間</option>
                            <option value="精薫の間" @if($hikuyousya->henjokaku1 == '精薫の間') selected @endif>精薫の間</option>
                        </select>

                        <select name="henjokaku2" class="select_category" style="width: 60px;" id="henjokaku2">
                            <option value="">----</option>
                            <option value="円内" @if($hikuyousya->henjokaku2 == '円内') selected @endif>円内</option>
                            <option value="円外" @if($hikuyousya->henjokaku2 == '円外') selected @endif>円外</option>
                            <option value="正面" @if($hikuyousya->henjokaku2 == '正面') selected @endif>正面</option>
                            @for ($i = 2; $i <= 10; $i++)
                            <option value="{{ $i }}列" @if($hikuyousya->henjokaku2 == $i . '列') selected @endif>{{ $i }}列</option>
                            @endfor
                        </select>

                        <select name="henjokaku3" class="select_category" style="width: 50px;" id="henjokaku3">
                            <option value="">----</option>
                            @for ($i = 1; $i <= 94; $i++)
                            <option value="{{ $i }}" @if($hikuyousya->henjokaku3 == $i) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>

                        <select name="henjokaku4" class="select_category" style="width: 50px;" id="henjokaku4">
                            <option value="">----</option>
                            <option value="A" @if($hikuyousya->henjokaku4 == 'A') selected @endif>A</option>
                            <option value="B" @if($hikuyousya->henjokaku4 == 'B') selected @endif>B</option>
                            <option value="C" @if($hikuyousya->henjokaku4 == 'C') selected @endif>C</option>
                            <option value="D" @if($hikuyousya->henjokaku4 == 'D') selected @endif>D</option>
                            <option value="E" @if($hikuyousya->henjokaku4 == 'E') selected @endif>E</option>
                            <option value="F" @if($hikuyousya->henjokaku4 == 'F') selected @endif>F</option>
                            <option value="G" @if($hikuyousya->henjokaku4 == 'G') selected @endif>G</option>
                            <option value="H" @if($hikuyousya->henjokaku4 == 'H') selected @endif>H</option>
                            <option value="I" @if($hikuyousya->henjokaku4 == 'I') selected @endif>I</option>
                            <option value="J" @if($hikuyousya->henjokaku4 == 'J') selected @endif>J</option>
                            <option value="K" @if($hikuyousya->henjokaku4 == 'K') selected @endif>K</option>
                            <option value="L" @if($hikuyousya->henjokaku4 == 'L') selected @endif>L</option>
                        </select>
                    </div>


                </div>

                <div class="">
                    <div class="danka_column">
                        <div class="danka_regist_name2" style="width: 100px;">納骨日</div>
                        {{ Form::date('nokotsubi', $hikuyousya->nokotsubi, ['class' => 'danka_form_text2', 'id' => 'nokotsubi', 'placeholder' => '', 'style' => 'width: 110px;']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2" style="width: 100px;">納骨移動日</div>
                        {{ Form::date('nokotsuidobi', $hikuyousya->nokotsuidobi, ['class' => 'danka_form_text2', 'id' => 'nokotsuidobi', 'placeholder' => '', 'style' => 'width: 110px;']) }}
                    </div>
                    <div class="danka_column">
                        <div class="danka_regist_name2" style="width: 100px;">
                            <input type="checkbox" id="nokotsu_flg" name="nokotsu_flg" class="" value="1" @if($hikuyousya->nokotsu_no != '000000' && isset($hikuyousya->nokotsu_no)) checked @endif>
                            <label for="nokotsu_flg" class="danka_label" style="margin-right: 0;">納骨番号</label>
                        </div>

                        {{ Form::text('nokotsu_no', $nokotsu_no, ['class' => 'danka_form_text2', 'maxlength' => 6, 'style' => 'width: 70px;', 'readonly' => 'readonly']) }}

                    </div>


                </div>


            
            </div>
        </div>
    </div>




    
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">更新</a>
</form>
<script src="{{ asset('js/hikuyousya_regist.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



