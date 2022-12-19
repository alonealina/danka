@extends('layouts.app')

@section('content')
<div class="user_content_title">入出金</div>
<div class="deposit_btn_flex">
    <a href="{{ route('deposit') }}" class="deposit_btn bank_btn not">銀行入金</a>
    <div class="deposit_btn crypto_btn">暗号通貨入金</div>
    <a href="{{ route('withdraw') }}" class="deposit_btn withdraw_btn not" style="letter-spacing: 6.12px;">出金</a>
</div>
<a href="https://secure.get-wallet.com/account/register2/hxs9aw1w" target="_blank">
    <img src="{{ asset('img/v2/card_banner.png') }}" class="card_banner" alt="">
</a>
<div id="crypto_div">
    <form name="crypto_payment_form" action="{{ route('crypto_payment_confirm') }}" method="post">
    @csrf
        <div class="deposit_title">暗号通貨入金</div>
        <div class="deposit_text">
            ご入金の前に、下記入力フォームにて、入金申請を行ってください。<br>
            次へボタンを押すと次ページに振込情報（QRコード,預入用アドレス）が表示されます。
        </div>
        <div class="deposit_item_flex">
            <div class="deposit_item">
                <div class="user_item_name">トレード口座</div>
                <div class="deposit_item_content">{{ $account_number }}</div>
            </div>
            <div class="deposit_item">
                <div class="user_item_name">メールアドレス</div>
                <div class="deposit_item_content">{{ $mail }}</div>
            </div>
        </div>
        <div class="deposit_item_flex">
            <div class="deposit_item">
                <div class="user_item_name">ご入金方法</div>
                <div class="deposit_item_content">Tether(USDT)</div>
            </div>
            <div class="deposit_item">
                <div class="user_item_name">入金額</div>
                {{ Form::text('deposit', old('deposit'), ['class' => 'deposit_input_text', 'maxlength' => 10, 'placeholder' => '']) }}
            </div>
        </div>
        <div class="deposit_item_flex">
            <div class="deposit_item">
                <div class="user_item_name">入金元のウォレットアドレス</div>
                {{ Form::text('wallet_address', old('wallet_address'), ['class' => 'deposit_input_text', 'maxlength' => 50, 'placeholder' => '']) }}
            </div>
            <div class="deposit_item">
                <div class="user_item_name">備考欄</div>
                {{ Form::text('remarks', old('remarks'), ['class' => 'deposit_input_text', 'maxlength' => 50, 'placeholder' => '']) }}
            </div>
        </div>
        <a onclick="clickCryptoPaymentFormButton()" class="btn_a">
            <div class="btn_purple" style="margin-top:50px;">振込情報を確認する</div>
        </a>
        <div class="bank_text" style="width:620px; margin-top:50px;">
            ◇金融商品取引は高リスクを伴う為、損失に耐えうる資金投資をして下さい<br>
            ◇場合により口座への入金反映が通常より遅れる場合がございます<br>
            ◇当社が取扱わない通貨、トークン等を誤ってお預入された場合、原則として返還対応いたしかねます。<br>
            　返還が可能な場合においても、それに係る手数料等をお支払いただくことがあります。<br>
            ◇外国為替相場については、三菱UFJ銀行（TTS AM11:00）のレートを適応しております。
        </div>
    </form>
</div>

<script src="{{ asset('js/v2/deposit.js') }}"></script>


@endsection




@section('content_sp')

<div class="user_content_title">入出金</div>
<div class="deposit_btn_flex" style="width:100%;">
    <a href="{{ route('deposit') }}" class="deposit_btn_sp bank_btn not">銀行入金</a>
    <div class="deposit_btn_sp crypto_btn">暗号通貨入金</div>
    <a href="{{ route('withdraw') }}" class="deposit_btn_sp withdraw_btn not" style="letter-spacing: 6.12px;">出金</a>
</div>
<a href="https://secure.get-wallet.com/account/register2/hxs9aw1w" target="_blank">
    <img src="{{ asset('img/v2/card_banner.png') }}" class="card_banner" alt="">
</a>

<div id="crypto_div">
    <form name="crypto_payment_form" action="{{ route('crypto_payment_confirm') }}" method="post">
    @csrf
        <div class="deposit_title">暗号通貨入金</div>
        <div class="deposit_text" style="margin-bottom:30px">
            ご入金の前に、下記入力フォームにて、入金申請を行ってください。<br>
            次へボタンを押すと次ページに振込情報（QRコード,預入用アドレス）が表示されます。
        </div>

        <div class="deposit_item_sp">
            <div class="user_item_name">トレード口座</div>
            <div class="deposit_item_content">{{ $account_number }}</div>
        </div>
        <div class="deposit_item_sp">
            <div class="user_item_name">メールアドレス</div>
            <div class="deposit_item_content">{{ $mail }}</div>
        </div>
        <div class="deposit_item_sp">
            <div class="user_item_name">ご入金方法</div>
            <div class="deposit_item_content">Tether(USDT)</div>
        </div>
        <div class="deposit_item_sp">
            <div class="user_item_name">入金額</div>
            {{ Form::text('deposit', old('deposit'), ['class' => 'deposit_input_text_sp', 'maxlength' => 10, 'placeholder' => '']) }}
        </div>
        <div class="deposit_item_sp">
            <div class="user_item_name">入金元のウォレットアドレス</div>
            {{ Form::text('wallet_address', old('wallet_address'), ['class' => 'deposit_input_text_sp', 'maxlength' => 50, 'placeholder' => '']) }}
        </div>
        <div class="deposit_item_sp">
            <div class="user_item_name">備考欄</div>
            {{ Form::text('remarks', old('remarks'), ['class' => 'deposit_input_text_sp', 'maxlength' => 50, 'placeholder' => '']) }}
        </div>
        <a onclick="clickCryptoPaymentFormButton()" class="btn_a_sp">
            <div class="btn_purple_sp" style="margin-top:50px;">振込情報を確認する</div>
        </a>
        <div class="bank_text" style="width:100%; margin-top:50px;">
            ◇金融商品取引は高リスクを伴う為、損失に耐えうる資金投資をして下さい<br>
            ◇場合により口座への入金反映が通常より遅れる場合がございます<br>
            ◇当社が取扱わない通貨、トークン等を誤ってお預入された場合、原則として返還対応いたしかねます。<br>
            　返還が可能な場合においても、それに係る手数料等をお支払いただくことがあります。<br>
            ◇外国為替相場については、三菱UFJ銀行（TTS AM11:00）のレートを適応しております。
        </div>
    </form>
</div>

<script src="{{ asset('js/v2/deposit.js') }}"></script>

@endsection

