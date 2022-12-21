@extends('layouts.app')

@section('content')
<div class="content_title">管理者新規追加</div>
<div class="admin_regist_div pt100">
    <form id="admin_store_form" name="admin_store_form" action="{{ route('admin_store') }}" method="post">
    @csrf
        <div class="flex_column">
            <div class="regist_item_name">ID</div>
            {{ Form::text('login_id', old('login_id'), ['class' => 'regist_form_text', 'maxlength' => 30, 'placeholder' => '']) }}
        </div>

        <div class="flex_column">
            <div class="regist_item_name">パスワード</div>
            <input name="password" type="password" class="regist_form_text pass_text" maxlength="20">
        </div>

        <div class="flex_column">
            <div class="regist_item_name">パスワード確認</div>
            <input name="password_confirm" type="password" class="regist_form_text pass_text" maxlength="20">
        </div>

        <div class="flex_column" id="password_error">
            <div class="regist_item_name"></div>
            <div class="error_message" id="password_error_text">パスワードが一致しません。</div>
        </div>

        <div class="flex_column">
            <div class="regist_item_name">名前</div>
            {{ Form::text('name', old('name'), ['class' => 'regist_form_text', 'maxlength' => 30, 'placeholder' => '']) }}
        </div>

        <div class="flex_column" id="name_error">
            <div class="regist_item_name"></div>
            <div class="error_message" id="name_error_text">パスワードが一致しません。</div>
        </div>

        <a onclick="clickAdminStoreButton()" class="login_btn_a">
            <div class="login_btn" style="margin-top:30px;">ログイン</div>
        </a>
    </form>
</div>

<script src="{{ asset('js/admin_regist.js') }}"></script>

@endsection



