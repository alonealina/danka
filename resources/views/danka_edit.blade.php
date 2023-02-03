@extends('layouts.app')

@section('content')
<div class="content_title">檀家編集</div>
<div class="admin_list_message">{{ session('message') }}</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('danka_update') }}" method="post">
@csrf
{{ Form::hidden('id', $danka->id) }}
    <div class="danka_regist_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">施主名 <span class="require_mark">※</span></div>
                {{ Form::text('name', $danka->name, ['id' => 'name', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ <span class="require_mark">※</span></div>
                {{ Form::text('name_kana', $danka->name_kana, ['id' => 'name_kana', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => 'セイ　メイ']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">性別</div>
                <select name="gender" class="select_category" style="width: 80px;">
                    <option value="m" @if($danka->gender == 'm') selected @endif>男</option>
                    <option value="f" @if($danka->gender == 'f') selected @endif>女</option>
                    <option value="o" @if($danka->gender == 'o') selected @endif>その他</option>
                </select>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">電話番号 <span class="require_mark">※</span></div>
                {{ Form::text('tel', $danka->tel, ['id' => 'tel', 'class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '半角英数(09011112222)']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">携帯番号</div>
                {{ Form::text('mobile', $danka->mobile, ['class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">メールアドレス</div>
                {{ Form::text('mail', $danka->mail, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">特記事項</div>
                {{ Form::text('notices', $danka->notices, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
        </div>

        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">郵便番号 <span class="require_mark">※</span></div>
                {{ Form::text('zip', $danka->zip, ['id' => 'zip', 'class' => 'danka_form_text', 'maxlength' => 7, 'placeholder' => '0000000', 'style' => 'width: 180px',
                        'onkeyup' => "AjaxZip3.zip2addr(this, '', 'pref', 'city')"]) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">都道府県 <span class="require_mark">※</span></div>
                <select name="pref" class="select_category" style="width: 180px" id="pref">
                    <option value="">選択してください</option>
                    @foreach (config('const.Prefs') as $name)
                    <option value="{{ $name }}"
                        @if($danka->pref == $name) selected @endif >{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">市区町村 <span class="require_mark">※</span></div>
                {{ Form::text('city', $danka->city, ['id' => 'city', 'class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">番地 <span class="require_mark">※</span></div>
                {{ Form::text('address', $danka->address, ['id' => 'address', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">マンション等</div>
                {{ Form::text('building', $danka->building, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">紹介者</div>
                {{ Form::text('introducer', $danka->introducer, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <input type="checkbox" id="segaki_flg" name="segaki_flg" class="danka_checkbox" value="1" @if($danka->segaki_flg) checked @endif>
                <label for="segaki_flg" class="danka_label">施餓鬼</label>
                <input type="checkbox" id="star_flg" name="star_flg" class="danka_checkbox" value="1" @if($danka->star_flg) checked @endif>
                <label for="star_flg" class="danka_label">星祭り</label>
                <input type="checkbox" id="yakushiji_flg" name="yakushiji_flg" class="danka_checkbox" value="1" @if($danka->yakushiji_flg) checked @endif>
                <label for="yakushiji_flg" class="danka_label">薬師寺霊園</label>
            </div>
        </div>
    </div>

    
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">更新</a>
</form>
<script src="{{ asset('js/danka_edit.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



