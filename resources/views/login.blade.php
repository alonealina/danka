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
            </header>

            <div class="div_bg header_margin pt100 pb100">
                <div class="login_div">
                    <form id="login_form" name="login_form" action="{{ route('login_function') }}" method="post">
                    @csrf
                        <div class="login_item_name">ログインID</div>
                        {{ Form::text('login_id', old('login_id'), ['class' => 'login_form_text', 'maxlength' => 30, 'placeholder' => '']) }}
                        <div class="login_item_name">パスワード</div>
                        <input name="password" type="password" class="login_form_text" maxlength="30">

                        <a onclick="clickLoginFormButton()" class="login_btn_a">
                            <div class="login_btn" style="margin-top:30px;">ログイン</div>
                        </a>
                    </form>
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







@section('content')


@endsection




