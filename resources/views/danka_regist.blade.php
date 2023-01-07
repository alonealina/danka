@extends('layouts.app')

@section('content')
<div class="content_title">檀家新規登録</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('danka_store') }}" method="post">
@csrf
    <div class="danka_regist_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">カルテナンバー</div>
                {{ Form::text('chart_no', old('chart_no'), ['id' => 'chart_no', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => 'カルテナンバー']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">施主名</div>
                {{ Form::text('name', old('name'), ['id' => 'name', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ</div>
                {{ Form::text('name_kana', old('name_kana'), ['id' => 'name_kana', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => 'セイ　メイ']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">カテゴリ</div>
                <select name="gender" class="select_category" style="width: 50px;">
                    <option value="m">男</option>
                    <option value="f">女</option>
                </select>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">電話番号</div>
                {{ Form::text('tel', old('tel'), ['id' => 'tel', 'class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '半角英数(09011112222)']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">携帯番号</div>
                {{ Form::text('mobile', old('mobile'), ['class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">メールアドレス</div>
                {{ Form::text('mail', old('mail'), ['class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '']) }}
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
                <div class="danka_regist_name">特記事項</div>
                {{ Form::text('notices', old('notices'), ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <input type="checkbox" id="segaki_flg" name="segaki_flg" class="danka_checkbox" value="1">
                <label for="segaki_flg" class="danka_label">施餓鬼</label>
                <input type="checkbox" id="star_flg" name="star_flg" class="danka_checkbox" value="1">
                <label for="star_flg" class="danka_label">星祭り</label>
                <input type="checkbox" id="kaiki_flg" name="kaiki_flg" class="danka_checkbox" value="1">
                <label for="kaiki_flg" class="danka_label">回忌</label>
            </div>
        </div>

    </div>
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">作成</a>
</form>
<script src="{{ asset('js/danka_regist.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



