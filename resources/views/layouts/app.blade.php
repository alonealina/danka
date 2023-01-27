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
                <div class="content_flex">
                    <div class="user_sidebar">
                        <a href="#!" class="menu_a @if (strpos($now_route,'summary') !== false) current @endif" onclick="clickMenu1();">
                            檀家管理
                            @if (strpos($now_route,'summary') !== false) 
                            <img src="{{ asset('img/down.png') }}" id="down1" class="down_r"><img src="{{ asset('img/up.png') }}" id="up1" class="up_r">
                            @else
                            <img src="{{ asset('img/down.png') }}" id="down1" class="down"><img src="{{ asset('img/up.png') }}" id="up1" class="up">
                            @endif
                        </a>
                        <div 
                        @if (strpos($now_route,'summary') === false) class="menu_none" @endif
                        id="menu1">
                        <a href="{{ route('danka_regist') }}" class="menu_a @if (strpos($now_route,'danka_regist') !== false) current @endif">　新規登録</a>
                        <a href="{{ route('danka_search') }}" class="menu_a @if (strpos($now_route,'danka_search') !== false) current @endif">　檀家検索</a>
                        <a href="{{ route('hikuyousya_search') }}" class="menu_a @if (strpos($now_route,'hikuyousya_search') !== false) current @endif">　被供養者検索</a>
                        </div>

                        <a href="#!" class="menu_a 
                        @if (strpos($now_route,'unclaimed_list') !== false || strpos($now_route,'unpaid_list') !== false || strpos($now_route,'paid_list') !== false)
                        current @endif" onclick="clickMenu3();">
                            請求/支払い
                            @if (strpos($now_route,'unclaimed_list') !== false || strpos($now_route,'unpaid_list') !== false || strpos($now_route,'paid_list') !== false) 
                            <img src="{{ asset('img/down.png') }}" id="down3" class="down_r"><img src="{{ asset('img/up.png') }}" id="up3" class="up_r">
                            @else
                            <img src="{{ asset('img/down.png') }}" id="down3" class="down"><img src="{{ asset('img/up.png') }}" id="up3" class="up">
                            @endif
                        </a>
                        <div 
                        @if (strpos($now_route,'unclaimed_list') === false && strpos($now_route,'unpaid_list') === false && strpos($now_route,'paid_list') === false)
                        class="menu_none"
                        @endif
                        id="menu3">
                        <a href="{{ route('deal_regist') }}" class="menu_a
                        @if (strpos($now_route,'unclaimed_list') !== false || strpos($now_route,'unpaid_list') !== false || strpos($now_route,'paid_list') !== false)
                        current @endif">　取引作成</a>
                        <a href="{{ route('deal_list') }}" class="menu_a
                        @if (strpos($now_route,'unclaimed_list') !== false || strpos($now_route,'unpaid_list') !== false || strpos($now_route,'paid_list') !== false)
                        current @endif">　取引一覧</a>
                        <a href="{{ route('item_list') }}" class="menu_a
                        @if (strpos($now_route,'item_list') !== false || strpos($now_route,'unpaid_list') !== false || strpos($now_route,'paid_list') !== false)
                        current @endif">　商品一覧</a>
                        </div>

                        <a href="#!" class="menu_a 
                        @if (strpos($now_route,'event_list') !== false || strpos($now_route,'event_show') !== false || strpos($now_route,'event_regist') !== false || 
                        strpos($now_route,'event_book_show') !== false || strpos($now_route,'event_book_regist') !== false) current @endif" onclick="clickMenu2();">
                            行事
                            @if (strpos($now_route,'event_list') !== false || strpos($now_route,'event_show') !== false || strpos($now_route,'event_regist') !== false || 
                            strpos($now_route,'event_book_show') !== false || strpos($now_route,'event_book_regist') !== false)
                            <img src="{{ asset('img/down.png') }}" id="down2" class="down_r"><img src="{{ asset('img/up.png') }}" id="up2" class="up_r">
                            @else
                            <img src="{{ asset('img/down.png') }}" id="down2" class="down"><img src="{{ asset('img/up.png') }}" id="up2" class="up">
                            @endif
                        </a>
                        <div
                        @if (strpos($now_route,'event_list') === false && strpos($now_route,'event_show') === false && strpos($now_route,'event_regist') === false &&
                        strpos($now_route,'event_book_show') === false && strpos($now_route,'event_book_regist') === false) class="menu_none" @endif
                        id="menu2">
                        <a href="{{ route('event_list') }}" class="menu_a
                        @if (strpos($now_route,'event_list') !== false || strpos($now_route,'event_show') !== false || strpos($now_route,'event_regist') !== false || 
                        strpos($now_route,'event_book_show') !== false || strpos($now_route,'event_book_regist') !== false) current @endif">　行事一覧</a>
                        <a href="{{ route('text_category_list') }}" class="menu_a
                        @if (strpos($now_route,'event_list') !== false || strpos($now_route,'event_show') !== false || strpos($now_route,'event_regist') !== false || 
                        strpos($now_route,'event_book_show') !== false || strpos($now_route,'event_book_regist') !== false) current @endif">　発送物一覧</a>
                        </div>

                        <a href="#!" class="menu_a
                        @if (strpos($now_route,'text_category_list') !== false || strpos($now_route,'text_list') !== false || strpos($now_route,'text_edit') !== false || 
                        strpos($now_route,'text_show') !== false || strpos($now_route,'text_regist') !== false) current @endif" onclick="clickMenu5();">
                            文章作成/編集
                            @if (strpos($now_route,'text_category_list') !== false || strpos($now_route,'text_list') !== false || strpos($now_route,'text_edit') !== false || 
                            strpos($now_route,'text_show') !== false || strpos($now_route,'text_regist') !== false)
                            <img src="{{ asset('img/down.png') }}" id="down5" class="down_r"><img src="{{ asset('img/up.png') }}" id="up5" class="up_r">
                            @else
                            <img src="{{ asset('img/down.png') }}" id="down5" class="down"><img src="{{ asset('img/up.png') }}" id="up5" class="up">
                            @endif
                        </a>
                        <div 
                        @if (strpos($now_route,'text_category_list') === false && strpos($now_route,'text_list') === false && strpos($now_route,'text_edit') === false &&
                        strpos($now_route,'text_show') === false && strpos($now_route,'text_regist') === false) class="menu_none" @endif
                        id="menu5">
                        <a href="{{ route('text_regist') }}" class="menu_a 
                        @if (strpos($now_route,'text_category_list') !== false || strpos($now_route,'text_list') !== false || strpos($now_route,'text_edit') !== false || 
                        strpos($now_route,'text_show') !== false || strpos($now_route,'text_regist') !== false) current @endif">　新規文章作成</a>
                        <a href="{{ route('text_list') }}" class="menu_a 
                        @if (strpos($now_route,'text_category_list') !== false || strpos($now_route,'text_list') !== false || strpos($now_route,'text_edit') !== false || 
                        strpos($now_route,'text_show') !== false || strpos($now_route,'text_regist') !== false) current @endif">　文章一覧</a>
                        </div>

                        <a href="#!" class="menu_a
                        @if (strpos($now_route,'admin_regist') !== false || strpos($now_route,'admin_list') !== false) current @endif" onclick="clickMenu6();">
                            管理者管理
                            @if (strpos($now_route,'admin_regist') !== false || strpos($now_route,'admin_list') !== false) 
                            <img src="{{ asset('img/down.png') }}" id="down6" class="down_r"><img src="{{ asset('img/up.png') }}" id="up6" class="up_r">
                            @else
                            <img src="{{ asset('img/down.png') }}" id="down6" class="down"><img src="{{ asset('img/up.png') }}" id="up6" class="up">
                            @endif
                        </a>
                        <div 
                        @if (strpos($now_route,'admin_regist') === false && strpos($now_route,'admin_list') === false) class="menu_none" @endif
                        id="menu6">
                        <a href="{{ route('admin_regist') }}" class="menu_a 
                        @if (strpos($now_route,'admin_regist') !== false || strpos($now_route,'admin_list') !== false) current @endif">　新規追加</a>
                        <a href="{{ route('admin_list') }}" class="menu_a 
                        @if (strpos($now_route,'admin_regist') !== false || strpos($now_route,'admin_list') !== false) current @endif">　管理者一覧</a>
                        </div>

                        <a href="{{ route('category_list') }}" class="menu_a 
                        @if (strpos($now_route,'category_list') !== false) current @endif">カテゴリ管理</a>

                    </div>
                    <div class="@if (strpos($now_route,'unclaimed_list') !== false || strpos($now_route,'unpaid_list') !== false || strpos($now_route,'paid_list') !== false) paid_list_main 
                        @elseif (strpos($now_route,'admin_list') !== false || strpos($now_route,'danka_regist') !== false) paid_list_main
                        @else user_content_main @endif">
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