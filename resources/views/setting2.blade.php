@extends('layouts.app')

@section('content')
<div class="user_content_title">設定</div>

<div class="setting_title2">2段階認証設定</div>
<div class="setting_text2">
    GOOD ENOUGH FXにログインするたびに、ユーザー名とパスワードに加えて、<br>
    スマートフォンのGoogle認証システムアプリによって生成されたコードも必要になります。<br>
    ログインするには動的コードを入力する必要があります。<br>
    これにより、アカウントのパスワードが漏洩した場合のアカウントへの侵入を効果的に防ぐことができます。
</div>
<div class="setting_item_flex">
    <div class="deposit_item" style="margin:0 auto 24px;">
        <a href="{{ route('activate_2fa') }}" class="active_btn_a">
            <div class="active_btn">アクティブ申請</div>
        </a>
    </div>
</div>
<div class="setting_item_flex">
    <div class="deposit_item" style="margin:0 auto 24px;">
        <a href="{{ route('inactivate_2fa') }}" class="active_btn_a">
            <div class="active_btn">非アクティブ申請</div>
        </a>
    </div>
</div>

<iframe class="qr_img" src='{{$GoogleAuthenticatorQrCodeUrl}}' width='240' height='240' style="border: none;"></iframe>
@endsection




@section('content_sp')

<div class="user_content_title">設定</div>

<div class="setting_title2">2段階認証設定</div>
<div class="setting_text2" style="width:100%;">
    GOOD ENOUGH FXにログインするたびに、ユーザー名とパスワードに加えて、<br>
    スマートフォンのGoogle認証システムアプリによって生成されたコードも必要になります。<br>
    ログインするには動的コードを入力する必要があります。<br>
    これにより、アカウントのパスワードが漏洩した場合のアカウントへの侵入を効果的に防ぐことができます。
</div>

<div class="deposit_item_sp">
    <a href="{{ route('activate_2fa') }}" class="">
        <div class="active_btn">アクティブ申請</div>
    </a>
</div>

<div class="deposit_item_sp">
    <a href="{{ route('inactivate_2fa') }}" class="">
        <div class="active_btn">非アクティブ申請</div>
    </a>
</div>


<iframe class="qr_img" src='{{$GoogleAuthenticatorQrCodeUrl}}' width='240' height='240' style="border: none;"></iframe>




@endsection

