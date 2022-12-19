<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>遍照尊院檀家管理システム</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />

        <link rel="icon" type="image/jpg" href="{{ asset('img/favicon.jpg') }}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Devanagari:wght@600&amp;display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Devanagari:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    </head>
    @php
    $now_route = \Route::currentRouteName();
    @endphp

    <div id="registration_pc">
        <body>
            <header class="header_pc">
                <a class="logo_a" href="">遍照尊院檀家<br>管理システム</a>
                <div class="header_menu_user">
                    <a href="{{ route('logout') }}" class="header_a header_btn1">
                        <p class="menu_name" style="width: 90px;">Logout</p>
                    </a>
                </div>


            </header>
            <div class="user_content_div header_margin">
                <div class="user_content_flex">
                    <div class="user_sidebar">
                        <a href="{{ route('summary') }}" class="user_a @if (strpos($now_route,'summary') !== false) current @endif">口座サマリー</a>
                        <a href="{{ route('history') }}" class="user_a @if (strpos($now_route,'history') !== false) current @endif">履歴</a>
                        <a href="{{ route('deposit') }}" class="user_a @if (strpos($now_route,'deposit') !== false || strpos($now_route,'crypto') !== false 
                            || strpos($now_route,'txid') !== false || strpos($now_route,'payment') !== false || strpos($now_route,'withdraw') !== false ) current @endif">入出金</a>
                        <a href="{{ route('transfer') }}" class="user_a @if (strpos($now_route,'transfer') !== false) current @endif">資金移動</a>
                        <a href="{{ route('add_acount') }}" class="user_a @if (strpos($now_route,'add_acount') !== false) current @endif">追加口座</a>
                        <a href="{{ route('setting') }}" class="user_a @if (strpos($now_route,'setting') !== false) current @endif">設 定</a>
                    </div>
                    <div class="@if (strpos($now_route,'history') !== false) history_content @else user_content_main @endif">
                    @yield('content')
                    </div>
                </div>
            </div>

        </body>
    </div>

    <script src="{{ asset('js/user_detail.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>


</html>