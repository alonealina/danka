@extends('layouts.app')

@section('content')
<div class="user_content_title">入出金</div>
<div class="deposit_btn_flex">
    <div class="deposit_btn bank_btn">銀行入金</div>
    <a href="{{ route('crypto_payment') }}" class="deposit_btn crypto_btn not">暗号通貨入金</a>
    <a href="{{ route('withdraw') }}" class="deposit_btn withdraw_btn not" style="letter-spacing: 6.12px;">出金</a>
</div>
<a href="https://secure.get-wallet.com/account/register2/hxs9aw1w" target="_blank">
    <img src="{{ asset('img/v2/card_banner.png') }}" class="card_banner" alt="">
</a>

<div id="bank_div">
    <div class="deposit_title">銀行入金</div>
    <div class="deposit_text">下記口座にお振り込みをお願いいたします</div>
    <div class="deposit_red">
        必ず振り込み名には登録口座のお名前と MT４口座番号をご入力下さいますよう お願い申し上げます。<br>
        MT４口座番号が入力されておりませんと残高に反映できない場合がございますので ご注意下さい。
    </div>
    <div class="bank_detail">
        <div>銀行名<br>支店名<br>口座種類<br>口座番号<br>口座名義<br>振込名義</div>
        <div style="max-width: 220px;">住信ＳＢＩネット銀行<br>法人第一支店（106)<br>普通預金<br>1387680<br>グッドイナフトレジャー(カ<br>{{ $account_number }} {{ $name }}</div>
    </div>
    <div class="bank_text" style="width:470px; margin-bottom:60px;">
        ※反映までの時間 : 最大３営業日<br>
        ※振り込み手数料 : お客様負担でお願いいたします。
    </div>
    <div class="bank_text" style="width:620px;">
        ◇金融商品取引は高リスクを伴う為、損失に耐えうる資金投資をして下さい<br>
        ◇場合により口座への入金反映が通常より遅れる場合がございます<br>
        ◇当社が取扱わない通貨、トークン等を誤ってお預入された場合、原則として返還対応いたしかねます。<br>
        　返還が可能な場合においても、それに係る手数料等をお支払いただくことがあります。<br>
        ◇外国為替相場については、三菱UFJ銀行（TTS AM11:00）のレートを適応しております。
    </div>
</div>



@endsection




@section('content_sp')

<div class="user_content_title">入出金</div>
<div class="deposit_btn_flex" style="width:100%;">
    <div class="deposit_btn_sp bank_btn">銀行入金</div>
    <a href="{{ route('crypto_payment') }}" class="deposit_btn_sp crypto_btn not">暗号通貨入金</a>
    <a href="{{ route('withdraw') }}" class="deposit_btn_sp withdraw_btn not" style="letter-spacing: 6.12px;">出金</a>
</div>
<a href="https://secure.get-wallet.com/account/register2/hxs9aw1w" target="_blank">
    <img src="{{ asset('img/v2/card_banner.png') }}" class="card_banner" alt="">
</a>

<div id="bank_div">
    <div class="deposit_title">銀行入金</div>
    <div class="deposit_text">下記口座にお振り込みをお願いいたします</div>
    <div class="deposit_red">
        必ず振り込み名には登録口座のお名前と MT４口座番号をご入力下さいますよう お願い申し上げます。<br>
        MT４口座番号が入力されておりませんと残高に反映できない場合がございますので ご注意下さい。
    </div>
    <div class="bank_detail" style="width: 100%;padding: 30px 10px;">
        <div>銀行名<br>支店名<br>口座種類<br>口座番号<br>口座名義<br>振込名義</div>
        <div style="max-width: 220px;">住信ＳＢＩネット銀行<br>法人第一支店（106)<br>普通預金<br>1387680<br>グッドイナフトレジャー(カ<br>{{ $account_number }} {{ $name }}</div>
    </div>
    <div class="bank_text" style="width:100%; margin-bottom:60px;">
        ※反映までの時間 : 最大３営業日<br>
        ※振り込み手数料 : お客様負担でお願いいたします。
    </div>
    <div class="bank_text" style="width:100%;">
        ◇金融商品取引は高リスクを伴う為、損失に耐えうる資金投資をして下さい<br>
        ◇場合により口座への入金反映が通常より遅れる場合がございます<br>
        ◇当社が取扱わない通貨、トークン等を誤ってお預入された場合、原則として返還対応いたしかねます。<br>
        　返還が可能な場合においても、それに係る手数料等をお支払いただくことがあります。<br>
        ◇外国為替相場については、三菱UFJ銀行（TTS AM11:00）のレートを適応しております。
    </div>
</div>


@endsection

