@extends('layouts.app')

@section('content')
<div class="user_content_title">入出金</div>
<div class="deposit_btn_flex">
    <a href="{{ route('deposit') }}"  class="deposit_btn bank_btn not">銀行入金</a>
    <a href="{{ route('crypto_payment') }}" class="deposit_btn crypto_btn not">暗号通貨入金</a>
    <div class="deposit_btn withdraw_btn" style="letter-spacing: 6.12px;">出金</div>
</div>
<a href="https://secure.get-wallet.com/account/register2/hxs9aw1w" target="_blank">
    <img src="{{ asset('img/v2/card_banner.png') }}" class="card_banner" alt="">
</a>

<div class="head_title">出金を受け付けました。</div>
<div class="complete_text">10営業日以内にご指定頂いた口座に入金されます。</div>
<a href="{{ route('index') }}" class="btn_a"><div class="btn_purple" style="margin-top:50px;">マイページTOP</div></a>

@endsection




@section('content_sp')

<div class="user_content_title">入出金</div>
<div class="deposit_btn_flex" style="width:100%;">
    <a href="{{ route('deposit') }}"  class="deposit_btn_sp bank_btn not">銀行入金</a>
    <a href="{{ route('crypto_payment') }}" class="deposit_btn_sp crypto_btn not">暗号通貨入金</a>
    <div class="deposit_btn_sp withdraw_btn" style="letter-spacing: 6.12px;">出金</div>
</div>
<a href="https://secure.get-wallet.com/account/register2/hxs9aw1w" target="_blank">
    <img src="{{ asset('img/v2/card_banner.png') }}" class="card_banner" alt="">
</a>

<div class="head_title_sp">出金を受け付けました。</div>
<div class="complete_text">10営業日以内にご指定頂いた口座に入金されます。</div>
<a href="{{ route('index') }}" class="btn_a_sp"><div class="btn_purple_sp" style="margin-top:50px;">マイページTOP</div></a>
@endsection

