<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>GOOD ENOUGH FX</title>
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

    @if(!$isMobile)
    <div id="registration_pc">
        <body>
            <header class="header_pc">
                <a class="logo_a" href="{{ route('index') }}">
                    <img src="{{ asset('img/v2/logo.png') }}" class="header_logo" alt="">
                </a>
                <div class="header_menu_user">
                    <a href="{{ route('faq') }}" class="header_a">
                        <p class="menu_name" style="width: 105px;">よくあるご質問</p>
                    </a>
                    <a href="{{ route('logout') }}" class="header_a header_btn1">
                        <p class="menu_name" style="width: 90px;">Logout</p>
                    </a>
                    <select class="header_a header_btn3">
                        <option value="JP">JP</option>
                    </select>
                </div>
                <input type="checkbox" id="user_detail_check" class="user_detail_check" hidden>
                <label for="user_detail_check" class="user_detail_label_pc">
                    <div class="user_div">
                    <img src="{{ asset('img/v2/human.png') }}" class="" alt="">
                    <span class="user_span user_name">{{ $name }}</span>
                    <span class="user_span user_tab" id="user_detail_span">▼</span>
                    </div>
                </label>

            </header>
            <div class="user_detail" id="user_detail" hidden>
                口座番号
                <div class="user_detail_content">{{ $account_number }}</div>
                口座種類
                <div class="user_detail_content">{{ $account_type }}</div>
                レバレッジ
                <div class="user_detail_content">{{ $leverage }}</div>
                メールアドレス
                <div class="user_detail_content">{{ $mail }}</div>
                開設日
                <div class="user_detail_content">{{ $opening_date }}</div>
            </div>

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

            <div class="footer_border"></div>
            <footer>
                <div class="footer_menu">
                    <a href="{{ asset('pdf/v2/GEFX FSG.pdf') }}" class="footer_a" target="_blank">
                        <p class="">金融サービスガイド(FSG)</p>
                    </a>
                    <span class="footer_separate">｜</span>
                    <a href="{{ asset('pdf/v2/GEFX PDS.pdf') }}" class="footer_a" target="_blank">
                        <p class="">金融商品開示文書(PDS)</p>
                    </a>
                    <span class="footer_separate">｜</span>
                    <a href="{{ asset('pdf/v2/GEFX Terms & conditions.pdf') }}" class="footer_a" target="_blank">
                        <p class="">取引規約</p>
                    </a>
                    <span class="footer_separate">｜</span>
                    <a href="{{ asset('pdf/v2/GEFX WebsitePrivacyPolicy.pdf') }}" class="footer_a" target="_blank">
                        <p class="">ウェブサイト個人情報保護方針</p>
                    </a>
                    <span class="footer_separate">｜</span>
                    <a href="{{ asset('pdf/v2/GEFX利用規約.pdf') }}" class="footer_a" target="_blank">
                        <p class="">ウェブサイト利用規約</p>
                    </a>
                    <span class="footer_separate">｜</span>
                    <a href="{{ route('company') }}" class="footer_a">
                        <p class="">会社概要</p>
                    </a>
                </div>
                <div class="footer_explain">
                リスクに関する警告:<br>
                外国為替金取引やデリバティブ取引は高リスクを伴います。損失に耐えうる範囲の資金でお取引されることをお勧め致します。<br>
                デリバティブ取引は全ての投資家に適しているわけではございません。取引に伴うリスクを充分に理解された上で、必要に応じて専門家にご相談下さい。<br>
                金融サービスガイド(FSG)および金融商品開示文書(PDS)は、当GOOD ENOUGH FX Ltdのウェブサイトよりご確認ください。<br>
                GOOD ENOUGH FX Ltdでデリバティブ取引を始められる前に、金融サービスガイド(FSG)および金融商品開示文書(PDS)の内容を慎重に考慮してください。<br><br>
                制限地域:<br>
                米国、オーストラリア、カナダ、ニュージーランド、朝鮮民主主義人民共和国、イラン、バヌアツ共和国のお客様もしくはFATFまたは同様の国際機関がAML-CFT対策が万全でないとしている特定管轄区地域在住のお客様を対象としておりませんので、ご注意ください。<br>
                当ウェブサイト上の情報は、FXおよび/またはCFD商品取引が法律や規制によって制限または禁止されている国在住のお客様を対象としておりません。
                </div>
                <img src="{{ asset('img/v2/logo.png') }}" class="footer_logo" alt="">
                <div class="copyright">Copyright © 2014-2022 GOOD ENOUGH. All rights reserved.</div>
            </footer>

        </body>
    </div>
    <script src="{{ asset('js/v2/user_detail.js') }}"></script>
    @else
    <div id="registration_sp">
    @php
    $now_route = \Route::currentRouteName();
    @endphp
        <body>
            <header class="header_sp">
                <select class="header_a header_btn3_sp">
                    <option value="JP">JP</option>
                </select>
                <a class="logo_a_sp" href="{{ route('index') }}">
                    <img src="{{ asset('img/v2/logo_white.png') }}" class="logo_img_sp" alt="">
                </a>
                <div class="hamburger-menu">
                    <input type="checkbox" id="menu-btn-check">
                    <label for="menu-btn-check" class="menu-btn"><span></span></label>
                    <div class="menu-content" style="background: transparent linear-gradient(90deg, #6A0DFF 0%, #66008D 100%) 0% 0% no-repeat padding-box;">
                        <ul>
                            <li>
                                <a href ="{{ route('summary') }}" class="menu_content_sp">口座サマリー</a>
                            </li>
                            <li>
                                <a href ="{{ route('history') }}" class="menu_content_sp">履歴</a>
                            </li>
                            <li>
                                <a href ="{{ route('deposit') }}" class="menu_content_sp">入出金</a>
                            </li>
                            <li>
                                <a href ="{{ route('transfer') }}" class="menu_content_sp">資金移動</a>
                            </li>
                            <li>
                                <a href ="{{ route('add_acount') }}" class="menu_content_sp">追加口座</a>
                            </li>
                            <li>
                                <a href ="{{ route('setting') }}" class="menu_content_sp">設 定</a>
                            </li>
                        </ul>
                        <a href ="{{ route('faq') }}" class="menu_content_sp" style="text-align:center">よくあるご質問</a>
                        <a href="{{ route('logout') }}" class="header_a_sp header_btn2_sp">
                            <p class="menu_btn_name_sp">Logout</p>
                        </a>
                    </div>
                </div>
            </header>
            <div class="user_div_sp header_margin_sp">
                <img src="{{ asset('img/v2/human.png') }}" class="" alt="">
                <span class="user_span user_name">{{ $name }}</span>
                <span class="user_span user_tab" style="float: right;" id="user_detail_span_sp">▼</span>
                <input type="checkbox" id="user_detail_check_sp" class="user_detail_check" hidden>
                <label for="user_detail_check_sp" class="user_detail_label"></label>
            </div>
            <div class="user_detail_div" id="user_detail_sp" hidden>
                口座番号
                <div class="user_detail_content">{{ $account_number }}</div>
                口座種類
                <div class="user_detail_content">{{ $account_type }}</div>
                レバレッジ
                <div class="user_detail_content">{{ $leverage }}</div>
                メールアドレス
                <div class="user_detail_content">{{ $mail }}</div>
                開設日
                <div class="user_detail_content">{{ $opening_date }}</div>
            </div>
            <div class="user_content_div_sp padding_sp_2" id="user_content_sp">
                <div class="user_content_main_sp">
                @yield('content_sp')
                </div>
            </div>

            <footer class="footer_sp">

                <div class="footer_menu_sp">
                    <ul>
                        <li>
                            <a href ="{{ asset('pdf/v2/GEFX FSG.pdf') }}" class="menu_content_sp" target="_blank">金融サービスガイド(FSG)</a>
                        </li>
                        <li>
                            <a href ="{{ asset('pdf/v2/GEFX PDS.pdf') }}" class="menu_content_sp" target="_blank">金融商品開示文書(PDS)</a>
                        </li>
                        <li>
                            <a href ="{{ asset('pdf/v2/GEFX Terms & conditions.pdf') }}" class="menu_content_sp" target="_blank">取引規約</a>
                        </li>
                        <li>
                            <a href ="{{ asset('pdf/v2/GEFX WebsitePrivacyPolicy.pdf') }}" class="menu_content_sp" target="_blank">ウェブサイト個人情報保護方針</a>
                        </li>
                        <li>
                            <a href ="{{ asset('pdf/v2/GEFX利用規約.pdf') }}" class="menu_content_sp" target="_blank">ウェブサイト利用規約</a>
                        </li>
                        <li>
                            <a href ="{{ route('company') }}" class="menu_content_sp">会社概要</a>
                        </li>
                    </ul>
                    <div class="footer_text_sp">
                        リスクに関する警告: 外国為替金取引やデリバティブ取引は高リスクを伴います。
                        損失に耐えうる範囲の資金でお取引されることをお勧め致します。
                        デリバティブ取引は全ての投資家に適しているわけではございません。
                        取引に伴うリスクを充分に理解された上で、必要に応じて専門家にご相談下さい。
                        金融サービスガイド(FSG)および金融商品開示文書(PDS)は、
                        当GOOD ENOUGH FX Ltdのウェブサイトよりご確認ください。<br>
                        GOOD ENOUGH FX Ltdでデリバティブ取引を始められる前に、
                        金融サービスガイド(FSG)および金融商品開示文書(PDS)の内容を慎重に考慮してください。<br><br>
                        制限地域:<br>
                        米国、オーストラリア、カナダ、ニュージーランド、朝鮮民主主義人民共和国、
                        イラン、バヌアツ共和国のお客様もしくはFATFまたは同様の国際機関がAML-CFT対策が
                        万全でないとしている特定管轄区地域在住のお客様を対象としておりませんので、ご注意ください。<br>
                        当ウェブサイト上の情報は、FXおよび/またはCFD商品取引が法律や規制によって制限または禁止されている国在住のお客様を対象としておりません。
                    </div>
                    <img src="{{ asset('img/v2/logo.png') }}" class="footer_logo" alt="">
                    <div class="copyright_sp">Copyright © 2014-2022 GOOD ENOUGH. All rights reserved.</div>
                </div>
            </footer>
        </body>
    </div>
    <script src="{{ asset('js/v2/user_detail_sp.js') }}"></script>

    @endif

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>


</html>