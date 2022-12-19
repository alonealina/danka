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
    <form name="txid_form" action="{{ route('txid_confirm') }}" method="post">
    @csrf
        <img src="{{ asset('img/v2/t_mark.png') }}" class="t_mark" alt="">
        <div class="deposit_text">
            お客様の Tether(USDT) 預入用アドレスです。<br>
            コピーするか、2次元バーコードをスキャンしてご利用ください。<br>
            ※送金の際、タグに口座番号を記載して送金してください。
        </div>
        <div class="bank_text" style="text-align:center; margin-top:30px;">
            セキュリティの関係で、下記アドレスは本画面のみの表示となっています。前のページへ戻ると<br>
            表示されませんのでご注意ください。再度確認したい場合は、再度入金申請を送信してください。
        </div>
        <div class="t_box">
            <div>お客様用Tetherアドレス（ERC20）</div>
            <img src="{{ asset('img/v2/qr.png') }}" class="t_mark" alt="">
            <div style="color: #6E6E6E;">0xD3A272Bc0AC3FFf9F00c2Ebc8f2F2D8A573B97ef</div>
        </div>
        <div class="deposit_red">
            送信完了時のトランザクションID(TXID)を下記入力欄に必ず入力してください<br>
        </div>
        <div class="deposit_item" style="margin:30px auto 15px;">
            <div class="user_item_name">TXID</div>
            {{ Form::text('txid', old('txid'), ['class' => 'deposit_input_text', 'maxlength' => 10, 'placeholder' => '', 'style' => 'width: 100%;', 'required']) }}
        </div>
        <a onclick="clickTxidButton()" class="btn_a">
            <div class="btn_purple" style="margin-top:50px;">送信する</div>
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
    <form name="txid_form" action="{{ route('txid_confirm') }}" method="post">
    @csrf
        <img src="{{ asset('img/v2/t_mark.png') }}" class="t_mark" alt="">
        <div class="deposit_text">
            お客様の Tether(USDT) 預入用アドレスです。<br>
            コピーするか、2次元バーコードをスキャンしてご利用ください。<br>
            ※送金の際、タグに口座番号を記載して送金してください。
        </div>
        <div class="bank_text" style="text-align:center; margin-top:30px;">
            セキュリティの関係で、下記アドレスは本画面のみの表示となっています。前のページへ戻ると<br>
            表示されませんのでご注意ください。再度確認したい場合は、再度入金申請を送信してください。
        </div>
        <div class="t_box" style="width: 100%;">
            <div>お客様用Tetherアドレス（ERC20）</div>
            <img src="{{ asset('img/v2/qr.png') }}" class="t_mark" alt="">
            <div class="txid_sp">0xD3A272Bc0AC3FFf9F00c2Ebc8f2F2D8A573B97ef</div>
        </div>
        <div class="deposit_red" style="margin-bottom:50px;">
            送信完了時のトランザクションID(TXID)を下記入力欄に必ず入力してください<br>
        </div>
        <div class="deposit_item_sp">
            <div class="user_item_name">TXID</div>
            {{ Form::text('txid', old('txid'), ['class' => 'deposit_input_text_sp', 'maxlength' => 50, 'placeholder' => '', 'required']) }}
        </div>
        <a onclick="clickTxidButton()" class="btn_a_sp">
            <div class="btn_purple_sp" style="margin-top:50px;">送信する</div>
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

