@extends('layouts.app')

@section('content')
<div class="user_content_title">設定</div>

<div class="setting_div">
    <img src="{{ asset('img/v2/lock.png') }}" class="" alt="">
    <div class="setting_title">２段階認証使用方法</div>
    <div class="setting_text">
        GOOD ENOUGH FX会員サイトにログインするたびに、<br>
        ユーザー名とパスワードに加えて、<br>
        スマートフォンのGoogle認証システムアプリによって<br>
        生成されたコードも必要になります。<br>
        ログインするには認証コードを入力する必要があります。<br>
        これにより、アカウントのパスワードが漏洩した場合の<br>
        アカウントへの侵入を効果的に防ぐことができます。
    </div>
    <a href="{{ route('setting2') }}" class="login_btn_a">
        <div class="login_btn" style="margin:50px auto 0;">Active</div>
    </a>

</div>


@endsection




@section('content_sp')

<div class="user_content_title">設定</div>

<div class="setting_div" style="width: 100%;padding:30px 10px;">
    <img src="{{ asset('img/v2/lock.png') }}" class="" alt="">
    <div class="setting_title">２段階認証使用方法</div>
    <div class="setting_text" style="width: 100%;margin: auto;">
        GOOD ENOUGH FX会員サイトにログインするたびに、<br>
        ユーザー名とパスワードに加えて、<br>
        スマートフォンのGoogle認証システムアプリによって<br>
        生成されたコードも必要になります。<br>
        ログインするには認証コードを入力する必要があります。<br>
        これにより、アカウントのパスワードが漏洩した場合の<br>
        アカウントへの侵入を効果的に防ぐことができます。
    </div>
    <a href="{{ route('setting2') }}" class="login_btn_a">
        <div class="login_btn" style="margin:50px auto 0;">Active</div>
    </a>

</div>


@endsection

