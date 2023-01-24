@extends('layouts.app')

@section('content')
<div class="content_title">檀家新規登録</div>
<div class="admin_list_message">{{ session('message') }}</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('danka_store') }}" method="post">
@csrf
    <div class="danka_regist_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">カルテナンバー</div>
                {{ Form::text('id', old('id'), ['id' => 'id_input', 'class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '']) }}
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">施主名</div>
                <div class="" id="name"></div>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ</div>
                <div class="" id="kana"></div>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ</div>
                <div class="" id="kana"></div>
            </div>
        </div>
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">郵便番号</div>
                <div class="" id="zip"></div>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">住所</div>
                <div class="" id="address"></div>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ</div>
                <div class="" id="kana"></div>
            </div>
        </div>
    </div>

</form>
<script src="{{ asset('js/db_test.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



