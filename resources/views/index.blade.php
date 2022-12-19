@extends('layouts.app')

@section('content')

<div class="header_margin top_bg1">
    <img src="{{ asset('img/v2/logo_white.png') }}" class="top_logo" alt="">
    <div class="top_text_main">使いやすさとFXの「自由」を手に入れる</div>
    <div class="top_text_sub">多種「暗号通貨」での入出金を可能にした GOOD ENOUGH FXで新しい取引と資産形成を可能に !!</div>
    <div class="top_btn_flex">
        <a href="{{ route('new_acount') }}" class="btn_a" style="margin:0;">
            <div class="btn_purple">新規口座開設はこちら</div>
        </a>
        <a href="{{ route('demo_acount') }}" class="btn_a" style="margin:0;">
            <div class="btn_purple" style="background:none;">デモ口座開設はこちら</div>
        </a>
    </div>
</div>

<div class="fx_bar">
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box">
        <div class="fx_currency">EUR/JPY</div>
        <div class="fx_rate">1.05213</div>
        <div class="fx_fluctuation">-0.00284(-0.27%)</div>
    </div>
</div>

<div class="top_bg2">
    <div class="top2_title">Service</div>
    <div class="top2_title_sub">
        <img src="{{ asset('img/v2/logo_white.png') }}" class="top2_logo" alt="">
        GOOD ENOUGH FX の取引プラットフォーム
        <div class="top2_line"></div>
    </div>
    <div class="top2_text">
        GOOD ENOUGH FX が採用する取引ツール「MetaTrader4」(メタトレーダー 4)は、<br>
        MetaQueotesSoftware 社が開発した世界でも最も利用されている FX 取引のプラットフォームです。
    </div>
    <img src="{{ asset('img/v2/top2_img1.png') }}" class="top2_img" alt="">
    <a href="{{ asset('exe/v2/goodenoughtreasure4setup.exe') }}" class="btn_a" style="margin:50px auto;">
        <div class="btn_purple" style="background: #3939399B;">ダウンロードはこちら</div>
    </a>
    <div class="top2_title_sub">
        <img src="{{ asset('img/v2/logo_white.png') }}" class="top2_logo" alt="">
        GOOD ENOUGH FX は暗号通貨での入出金が可能
        <div class="top2_line2"></div>
    </div>
    <div class="top2_text">
        GOOD ENOUGH FX での資金の入出金は現金振り込みの他に暗号通貨での入出金が可能です。<br>
        （USDTのみ）高いセキュリティー技術で安全な管理と操作をお約束します。
    </div>
    <img src="{{ asset('img/v2/top2_img2.png') }}" class="top2_img" alt="">
</div>

<div class="top_bg3">
    <div class="top3_text">簡単即座の新規口座開設手順</div>
    <img src="{{ asset('img/v2/top3_img.png') }}" class="top3_img" alt="">
</div>

<div class="div_bg" style="padding:100px 0">
    <div class="top4_text">GOOD ENOUGH FX が選ばれる理由</div>
    <div class="top4_flex">
        <div class="top4_div">
            <img src="{{ asset('img/v2/top4_img1.png') }}" class="top4_img" alt="">
            <div class="top4_text2" style="padding: 15px;">最大レバレッジ200倍</div>
            資金効率を高めるため、FX取引最大200:1の取引を提供。真のDMA業者として、お客様の取引残高や司教によるレバレッジの一時的な変更は行ません
        </div>
        <div class="top4_div">
            <img src="{{ asset('img/v2/top4_img2.png') }}" class="top4_img" alt="">
            <div class="top4_text2">ゼロカット方式採用<br>安心の追証の請求なし</div>
            相場の急激な変動により、お客様の残高がマイナスになった場合でも、追証・追加入金の必要はありません。当社では、マイナス残高をゼロリセット対応いたします。
        </div>
    </div>
</div>


@endsection




@section('content_sp')

<div class="header_margin_sp top_bg1_sp">
    <img src="{{ asset('img/v2/logo_white.png') }}" class="top_logo_sp" alt="">
    <div class="top_text_main_sp">使いやすさとFXの<br>「自由」を手に入れる</div>
    <div class="top_text_sub" style="font: normal normal 600 18px/25px Open Sans;">多種「暗号通貨」での入出金を可能にした GOOD ENOUGH FXで新しい取引と資産形成を可能に !!</div>
    <div class="top_btn_sp">
        <a href="{{ route('new_acount') }}" class="btn_a" style="margin-bottom:20px; width:100%;">
            <div class="btn_purple" style="font: normal normal normal 22px/30px Open Sans;">新規口座開設はこちら</div>
        </a>
        <a href="{{ route('demo_acount') }}" class="btn_a" style="width:100%;">
            <div class="btn_purple" style="background:none; font: normal normal normal 22px/30px Open Sans;">デモ口座開設はこちら</div>
        </a>
    </div>
</div>
<div class="fx_bar_sp">
    <div class="fx_box_sp">
        <div class="fx_currency_sp">EUR/JPY</div>
        <div class="fx_rate_sp">1.05213</div>
        <div class="fx_fluctuation_sp">-0.00284(-0.27%)</div>
    </div>
    <div class="fx_box_sp">
        <div class="fx_currency_sp">EUR/JPY</div>
        <div class="fx_rate_sp">1.05213</div>
        <div class="fx_fluctuation_sp">-0.00284(-0.27%)</div>
    </div>
</div>



<div class="top_bg2_sp">
    <div class="top2_title_sp">Service</div>
    <img src="{{ asset('img/v2/logo_white.png') }}" class="top2_logo_sp" alt="">
    <div class="top2_title_sub_sp">GOOD ENOUGH FX の<br>取引プラットフォーム</div>
    <div class="top2_text" style="margin: 40px 0;">
        GOOD ENOUGH FX が採用する取引ツール「MetaTrader4」(メタトレーダー 4)は、<br>
        MetaQueotesSoftware 社が開発した世界でも最も利用されている FX 取引のプラットフォームです。
    </div>
    <img src="{{ asset('img/v2/top2_sp1.png') }}" class="top2_img_sp" alt="">
    <img src="{{ asset('img/v2/top2_sp2.png') }}" class="top2_img_sp" alt="">
    <img src="{{ asset('img/v2/top2_sp3.png') }}" class="top2_img_sp" alt="">
    <a href="{{ asset('exe/v2/goodenoughtreasure4setup.exe') }}" class="btn_a" style="width:100%; margin:50px auto;">
        <div class="btn_purple" style="background: #3939399B;">ダウンロードはこちら</div>
    </a>
    <img src="{{ asset('img/v2/logo_white.png') }}" class="top2_logo_sp" alt="">
    <div class="top2_title_sub_sp">GOOD ENOUGH FX は暗号通貨での入出金が可能</div>
    <div class="top2_text" style="margin: 40px 0;">
        GOOD ENOUGH FX での資金の入出金は現金振り込みの他に暗号通貨での入出金が可能です。<br>
        （USDTのみ）高いセキュリティー技術で安全な管理と操作をお約束します。
    </div>
    <img src="{{ asset('img/v2/top2_img2.png') }}" class="top2_img_sp2" alt="">
</div>

<div class="top_bg3_sp">
    <div class="top3_text">簡単即座の<br>新規口座開設手順</div>
    <div class="top3_img_list">
        <img src="{{ asset('img/v2/hexa1.png') }}" class="top3_img_sp" alt="" style="margin-left: -77px;">
        <img src="{{ asset('img/v2/hexa2.png') }}" class="top3_img_sp" alt="" style="margin:-165px 45px;">
        <img src="{{ asset('img/v2/hexa3.png') }}" class="top3_img_sp" alt="" style="margin-left: -77px;">
        <img src="{{ asset('img/v2/hexa4.png') }}" class="top3_img_sp" alt="" style="margin:-165px 45px;">
        <img src="{{ asset('img/v2/hexa5.png') }}" class="top3_img_sp" alt="" style="margin-left: -77px;">
    </div>
</div>

<div class="top_bg4_sp">
    <div class="top4_text">GOOD ENOUGH FX が選ばれる理由</div>
    <div class="top4_div_sp">
        <img src="{{ asset('img/v2/top4_img1.png') }}" class="top4_img" alt="">
        <div class="top4_text2_sp">最大レバレッジ200倍</div>
        資金効率を高めるため、FX取引最大200:1の取引を提供。真のDMA業者として、お客様の取引残高や司教によるレバレッジの一時的な変更は行ません
    </div>
    <div class="top4_div_sp" style="height: 400px;">
        <img src="{{ asset('img/v2/top4_img2.png') }}" class="top4_img" alt="">
        <div class="top4_text2_sp">ゼロカット方式採用<br>安心の追証の請求なし</div>
        相場の急激な変動により、お客様の残高がマイナスになった場合でも、追証・追加入金の必要はありません。当社では、マイナス残高をゼロリセット対応いたします。
    </div>
</div>

@endsection