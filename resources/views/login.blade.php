@extends('layouts.app')

@section('content')

<div class="div_bg header_margin pt100 pb100">
    <div class="login_div">
        <form id="login_form" name="login_form" action="{{ view('route('login_function') }}" method="post">
        @csrf
            <img src="{{ asset('img/v2/logo2.png') }}" class="login_logo" alt="">
            <div class="login_title">Login</div>
            <div class="login_text">ようこそ。GOOD ENOUGH FXへ</div>

            <div class="login_item_name">MT4口座番号</div>
            {{ Form::text('name', old('name'), ['class' => 'login_form_text', 'maxlength' => 30, 'placeholder' => '10桁の口座番号']) }}
            <div class="login_item_name">パスワード</div>
            {{ Form::text('password', old('password'), ['class' => 'login_form_text', 'maxlength' => 30, 'placeholder' => '半角英数字']) }}

            <a onclick="clickLoginFormButton()" class="login_btn_a">
                <div class="login_btn" style="margin-top:30px;">Login</div>
            </a>
            <div class="reminder_a"><a href="{{ view('route('contact') }}">ログインパスワードを忘れた方はこちら</a></div>
            <div class="reminder_a">口座をお持ちでないですか？ <a href="{{ view('route('new_acount') }}">取引口座を今すぐ開設する</a></div>
        </form>
   </div>
</div>

@endsection




@section('content_sp')

<div class="div_bg_sp header_margin_sp padding_sp">
    <div class="login_div_sp">
        <form id="login_form" name="login_form" action="{{ view('route('login_function') }}" method="post">
        @csrf
            <img src="{{ asset('img/v2/logo2.png') }}" class="login_logo" alt="">
            <div class="login_title">Login</div>
            <div class="login_text">ようこそ。GOOD ENOUGH FXへ</div>

            <div class="login_item_name">MT4口座番号</div>
            {{ Form::text('name', old('name'), ['class' => 'login_form_text', 'maxlength' => 30, 'placeholder' => '10桁の口座番号']) }}
            <div class="login_item_name">パスワード</div>
            {{ Form::text('password', old('password'), ['class' => 'login_form_text', 'maxlength' => 30, 'placeholder' => '半角英数字']) }}

            <a onclick="clickLoginFormButton()" class="login_btn_a">
                <div class="login_btn" style="margin-top:30px;">Login</div>
            </a>
            <div class="reminder_a"><a href="{{ view('route('contact') }}">ログインパスワードを忘れた方はこちら</a></div>
            <div class="reminder_a">口座をお持ちでないですか？<br><a href="{{ view('route('new_acount') }}">取引口座を今すぐ開設する</a></div>
        </form>
   </div>
</div>


@endsection