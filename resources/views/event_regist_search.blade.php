@extends('layouts.app')

@section('content')
<div class="content_title">行事新規追加</div>
<div class="text_show_title">{{ $category_name }} - {{ $event_name }}</div>
<form id="form" name="search_form" action="{{ route('event_regist_search') }}" method="post">
@csrf
{{ Form::hidden('category_id', $category_id) }}
{{ Form::hidden('category_name', $category_name) }}
{{ Form::hidden('event_name', $event_name) }}
{{ Form::hidden('danka_count', $danka_count) }}
{{ Form::hidden('danka_id_list', $danka_id_list) }}
<div class="danka_search_div">
    @if($category_id == 5)
    <div class="danka_form_div">

        <div class="danka_column">
            <div class="danka_regist_name">フリーワード</div>
            {{ Form::text('freeword', $freeword, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
        </div>
    </div>

    <div class="danka_form_div">

        <div class="danka_column">
            <div class="danka_regist_name">納骨日</div>
            {{ Form::date('nokotsubi_before', $nokotsubi_before, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}　～　
            {{ Form::date('nokotsubi_after', $nokotsubi_after, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}
        </div>
        <input type="checkbox" id="mail_flg" name="mail_flg" class="danka_checkbox" value="1"
        @if(isset($mail_flg)) checked @endif>
        <label for="mail_flg" class="danka_label">メールアドレスあり</label>

    </div>
    @else
    <div class="danka_form_div">

        @if($category_id == 1)
        <div class="danka_column">
            <div class="danka_regist_name">命日</div>
            <select name="meinichi_month" class="select_category" style="width: 50px;">
                <option value="">----</option>
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" @if($meinichi_month == $i) selected @endif >{{ $i }}</option>
                @endfor
            </select>
            <div class="yen_text"> 月　　</div>
            <select name="meinichi_day" class="select_category" style="width: 50px;">
                <option value="">----</option>
                @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}" @if($meinichi_day == $i) selected @endif >{{ $i }}</option>
                @endfor
            </select>
            <div class="yen_text"> 日</div>
        </div>

        <div class="danka_column">
            <div class="danka_regist_name">回忌</div>
            <select name="kaiki_before" class="select_category" style="width: 80px;">
                <option value="">----</option>
                <option value="1" @if($kaiki_before == '1') selected @endif >1</option>
                @for ($i = 3; $i <= 50; $i++)
                <option value="{{ $i }}" @if($kaiki_before == $i) selected @endif >{{ $i }}</option>
                @endfor
            </select>　～　
            <select name="kaiki_after" class="select_category" style="width: 80px;">
                <option value="">----</option>
                <option value="1" @if($kaiki_after == '1') selected @endif >1</option>
                @for ($i = 3; $i <= 50; $i++)
                <option value="{{ $i }}" @if($kaiki_after == $i) selected @endif >{{ $i }}</option>
                @endfor
            </select>
        </div>
        @endif

        <div class="danka_column">
            <div class="danka_regist_name">支払い履歴</div>
            {{ Form::date('payment_before', $payment_before, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}　～　
            {{ Form::date('payment_after', $payment_after, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}
            <div class="danka_regist_name" style="width: 200px;">　取引実績　
            @if($category_id == 3)
                <input type="radio" name="payment_flg" value="on" checked>　有　
                <input type="radio" name="payment_flg" value="off" @if($payment_flg == 'off') checked @endif>　無
            @else
            有
            @endif
            </div>
        </div>



        @if($category_id == 3)
        <div class="danka_column">
            <div class="danka_regist_name">リスト名</div>
            <select name="event_date_id" class="select_category" style="width: 261px" id="">
                <option value="">----</option>
                @foreach ($event_date_list as $event_date)
                <option value="{{ $event_date->id }}"
                    @if($event_date_id == $event_date->id) selected @endif >{{ $event_date->name }}</option>
                @endforeach
            </select>
            <div class="danka_regist_name" style="width: 200px;">　取引実績　
                <input type="radio" name="event_date_flg" value="on" checked>　有　
                <input type="radio" name="event_date_flg" value="off" @if($event_date_flg == 'off') checked @endif>　無
            </div>
        </div>
        @endif

        <div class="danka_column">
            <div class="danka_regist_name">フリーワード</div>
            {{ Form::text('freeword', $freeword, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
        </div>
        
        @if($category_id == 5)
        <div class="danka_column">
            <div class="danka_regist_name">ソート</div>
            <select name="sort_item" class="select_category" style="width: 200px">
                <option value="">----</option>
                <option value="ihai_no" @if($sort_item == 'ihai_no') selected @endif >位牌番号</option>
                <option value="nokotsubi" @if($sort_item == 'nokotsubi') selected @endif >納骨日</option>
                <option value="nokotsuidobi" @if($sort_item == 'nokotsuidobi') selected @endif >納骨移動日</option>
                <option value="nokotsu_no" @if($sort_item == 'nokotsu_no') selected @endif >納骨番号</option>
            </select>　　
            <select name="sort_type" class="select_category" style="width: 70px">
                <option value="asc">昇順</option>
                <option value="desc" @if($sort_type == 'desc') selected @endif >降順</option>
            </select>
        </div>
        @elseif($category_id != 1)
        <div class="danka_column">
            <div class="danka_regist_name">ソート</div>
            <select name="sort_item" class="select_category" style="width: 200px">
                <option value="">----</option>
                <option value="created_at" @if($sort_item == 'created_at') selected @endif >取引作成日</option>
                <option value="payment_date" @if($sort_item == 'payment_date') selected @endif >支払確認日</option>
                <option value="total" @if($sort_item == 'total') selected @endif >金額</option>
            </select>　　
            <select name="sort_type" class="select_category" style="width: 70px">
                <option value="asc">昇順</option>
                <option value="desc" @if($sort_type == 'desc') selected @endif >降順</option>
            </select>
        </div>
        @endif
    </div>

    <div class="danka_form_div">


        <div class="danka_column">
            <div class="danka_regist_name">商品カテゴリー</div>

            @if($category_id != 3)
            <select name="item_category_id" class="select_category" style="width: 400px" id="">
                <option value="">----</option>
                @foreach ($item_categories as $item_category)
                <option value="{{ $item_category->id }}"
                    @if($item_category_id == $item_category->id) selected @endif >{{ $item_category->name }}</option>
                @endforeach
            </select>
            @else
            <div class="danka_regist_name">星まつり</div>
            {{ Form::hidden('item_category_id', 3) }}
            @endif
        </div>

        <div class="danka_column">
            <div class="danka_regist_name">金額</div>
            {{ Form::text('price_min', $price_min, ['id' => 'tel', 'class' => 'danka_form_text2', 'maxlength' => 7, 'style' => 'width: 110px;']) }}
            <div class="yen_text"> 円　～　</div>
            {{ Form::text('price_max', $price_max, ['id' => 'tel', 'class' => 'danka_form_text2', 'maxlength' => 7, 'style' => 'width: 110px;']) }}
            <div class="yen_text"> 円</div>
        </div>

        <div class="danka_column">
            @if($category_id != 3 && $category_id != 1)
                @if($category_id != 1 && $category_id != 2 && $category_id != 6)
                <input type="checkbox" id="segaki_flg" name="segaki_flg" class="danka_checkbox" value="1"
                @if(isset($segaki_flg)) checked @endif>
                <label for="segaki_flg" class="danka_label">施餓鬼</label>
                <input type="checkbox" id="star_flg" name="star_flg" class="danka_checkbox" value="1"
                @if(isset($star_flg)) checked @endif>
                <label for="star_flg" class="danka_label">星祭り</label>
                <input type="checkbox" id="yakushiji_flg" name="yakushiji_flg" class="danka_checkbox" value="1"
                @if(isset($yakushiji_flg)) checked @endif>
                <label for="yakushiji_flg" class="danka_label">薬師寺霊苑</label>
                <input type="checkbox" id="mail_flg" name="mail_flg" class="danka_checkbox" value="1"
                @if(isset($mail_flg)) checked @endif>
                <label for="mail_flg" class="danka_label">メールアドレスあり</label>
            @elseif($category_id == 1)
            <input type="checkbox" id="kaiki_flg" name="kaiki_flg" class="danka_checkbox" value="1"
            @if(isset($kaiki_flg)) checked @endif>
            <label for="kaiki_flg" class="danka_label">年忌</label>
            <input type="checkbox" id="mail_flg" name="mail_flg" class="danka_checkbox" value="1"
            @if(isset($mail_flg)) checked @endif>
            <label for="mail_flg" class="danka_label">メールアドレスあり</label>
            @else
            <input type="checkbox" id="star_flg" name="star_flg" class="danka_checkbox" value="1"
            @if(isset($star_flg)) checked @endif>
            <label for="star_flg" class="danka_label">星祭り</label>
            <input type="checkbox" id="mail_flg" name="mail_flg" class="danka_checkbox" value="1"
            @if(isset($mail_flg)) checked @endif>
            <label for="mail_flg" class="danka_label">メールアドレスあり</label>
            @endif


        </div>

        @if($category_id == 1)
        <div class="danka_column">
            <div class="danka_regist_name">ソート</div>
            <select name="sort_item" class="select_category" style="width: 200px">
                <option value="">----</option>
                <option value="meinichi" @if($sort_item == 'meinichi') selected @endif >命日</option>
                <option value="payment_date" @if($sort_item == 'payment_date') selected @endif >支払確認日</option>
                <option value="total" @if($sort_item == 'total') selected @endif >金額</option>
            </select>　　
            <select name="sort_type" class="select_category" style="width: 70px">
                <option value="asc">昇順</option>
                <option value="desc" @if($sort_type == 'desc') selected @endif >降順</option>
            </select>
        </div>
        @endif
    </div>
    @endif
    <div class="search_btn_list">
        <a href="#!" onclick="clickSearchButton()" class="search_btn_a">検索</a>
        <a href="#!" onclick="clickClearButton()" class="clear_btn_a">クリア</a>
    </div>
</div>

<div class="paginationWrap">
    <div class="pagination_div">
        表示件数　
        @if($category_id == 1)
        @include('item.kaiki_regist_number')　　
        @elseif($category_id == 5)
        @include('item.nokotsu_regist_number')　　
        @else
        @include('item.other_regist_number')　　
        @endif
        {{ $danka_list->total()}}件 （
        @if($category_id == 1 || $category_id == 5) 被供養者{{ $hikuyousya_count }}人　@endif
        施主{{ $danka_count }}人）が該当しました　
        {{ $danka_list->appends(['category_id' => $category_id, 'event_name' => $event_name])->appends(request()->query())->links('pagination::default') }}

    </div>
</div>
</form>


<form id="regist_form" name="event_store_form" action="{{ route('event_store') }}" method="post">
@csrf
{{ Form::hidden('category_id', $category_id) }}
{{ Form::hidden('category_name', $category_name) }}
{{ Form::hidden('event_name', $event_name) }}
{{ Form::hidden('danka_count', $danka_count) }}
{{ Form::hidden('danka_id_list', $danka_id_list) }}
{{ Form::hidden('freeword', $freeword) }}
{{ Form::hidden('sort_item', $sort_item) }}
{{ Form::hidden('sort_type', $sort_type) }}

    @if($category_id == 1)
    {{ Form::hidden('meinichi_month', $meinichi_month) }}
    {{ Form::hidden('meinichi_day', $meinichi_day) }}
    {{ Form::hidden('kaiki_before', $kaiki_before) }}
    {{ Form::hidden('kaiki_after', $kaiki_after) }}
    {{ Form::hidden('payment_before', $payment_before) }}
    {{ Form::hidden('payment_after', $payment_after) }}
    {{ Form::hidden('price_min', $price_min) }}
    {{ Form::hidden('price_max', $price_max) }}
    {{ Form::hidden('segaki_flg', $segaki_flg) }}
    {{ Form::hidden('star_flg', $star_flg) }}
    {{ Form::hidden('yakushiji_flg', $yakushiji_flg) }}
    {{ Form::hidden('kaiki_flg', $kaiki_flg) }}
    {{ Form::hidden('item_category_id', $item_category_id) }}

    <div class="payment_list_header" style="margin:0;">
        <div class="hikuyousya_id">カルテナンバー</div>
        <div class="hikuyousya_name">施主名</div>
        <div class="hikuyousya_zokumyo">俗名</div>
        <div class="hikuyousya_kaimyo">戒名</div>
        <div class="hikuyousya_date">命日</div>
        <div class="hikuyousya_kaiki">回忌</div>
        <div class="hikuyousya_kaiki">発送</div>
        <div class="hikuyousya_date">支払日</div>
        <div class="hikuyousya_kaimyo">商品カテゴリー</div>
        <div class="hikuyousya_date">金額</div>
        <div class="hikuyousya_btn"></div>
    </div>

    <div class="search_result_div" style="height:300px;">
        @foreach ($danka_list as $danka)
        <div class="payment_list_column">
            <div class="hikuyousya_id">{{ $danka->id }}</div>
            <div class="hikuyousya_name">{{ $danka->name }}</div>
            <div class="hikuyousya_zokumyo">{{ $danka->common_name }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->posthumous }}</div>
            <div class="hikuyousya_date">{{ $danka->meinichi }}</div>
            <div class="hikuyousya_kaiki">@if($danka->kaiki <= 0) 1 @else {{ $danka->kaiki + 2 }} @endif</div>
            <div class="hikuyousya_kaiki">@if($danka->kaiki_flg) ✓ @endif</div>
            <div class="hikuyousya_date">{{ $danka->payment_date }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->category_name }}</div>
            <div class="hikuyousya_date">@if($danka->total > 0) {{ number_format($danka->total) }} @endif</div>
            <div class="hikuyousya_btn"><a href="{{ route('danka_detail', $danka->id) }}" target="_blank" class="search_view_btn_a">表示</a></div>
        </div>
        @endforeach
    </div>

    @elseif($category_id == 5)
    {{ Form::hidden('nokotsubi_before', $nokotsubi_before) }}
    {{ Form::hidden('nokotsubi_after', $nokotsubi_after) }}

    <div class="payment_list_header" style="margin:0;">
        <div class="hikuyousya_id">カルテナンバー</div>
        <div class="hikuyousya_name">施主名</div>
        <div class="hikuyousya_zokumyo">俗名</div>
        <div class="hikuyousya_kaimyo">戒名</div>
        <div class="hikuyousya_ihai">位牌番号</div>
        <div class="hikuyousya_date">納骨日</div>
        <div class="hikuyousya_date">納骨移動日</div>
        <div class="hikuyousya_ihai">納骨番号</div>
        <div class="hikuyousya_column">特記事項</div>
        <div class="hikuyousya_btn"></div>
    </div>

    <div class="search_result_div" style="height:300px;">
        @foreach ($danka_list as $danka)
        <div class="payment_list_column">
            <div class="hikuyousya_id">{{ $danka->id }}</div>
            <div class="hikuyousya_name">{{ $danka->name }}</div>
            <div class="hikuyousya_zokumyo">{{ $danka->common_name }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->posthumous }}</div>
            <div class="hikuyousya_ihai">@if ($danka->ihai_no != 0000) {{ $danka->ihai_no }} @endif</div>
            <div class="hikuyousya_date">{{ $danka->nokotsubi }}</div>
            <div class="hikuyousya_date">{{ $danka->nokotsuidobi }}</div>
            <div class="hikuyousya_ihai">@if ($danka->nokotsu_no != 000000) {{ $danka->nokotsu_no }} @endif</div>
            <div class="hikuyousya_column">{{ $danka->column }}</div>
            <div class="hikuyousya_btn"><a href="{{ route('danka_detail', $danka->id) }}" target="_blank" class="search_view_btn_a">表示</a></div>
        </div>
        @endforeach
    </div>

    @else
    {{ Form::hidden('payment_before', $payment_before) }}
    {{ Form::hidden('payment_after', $payment_after) }}
    {{ Form::hidden('payment_flg', $payment_flg) }}
    {{ Form::hidden('price_min', $price_min) }}
    {{ Form::hidden('price_max', $price_max) }}
    {{ Form::hidden('segaki_flg', $segaki_flg) }}
    {{ Form::hidden('star_flg', $star_flg) }}
    {{ Form::hidden('yakushiji_flg', $yakushiji_flg) }}
    {{ Form::hidden('kaiki_flg', $kaiki_flg) }}
    {{ Form::hidden('mail_flg', $mail_flg) }}
    {{ Form::hidden('item_category_id', $item_category_id) }}
    {{ Form::hidden('event_date_id', $event_date_id) }}
    {{ Form::hidden('event_date_flg', $event_date_flg) }}

    <div class="payment_list_header" style="margin:0;">
        <div class="hikuyousya_id">カルテナンバー</div>
        <div class="hikuyousya_name">施主名</div>
        <div class="hikuyousya_zokumyo">電話番号</div>
        <div class="hikuyousya_address">住所</div>
        <div class="hikuyousya_date">取引作成日</div>
        <div class="hikuyousya_date">支払日</div>
        <div class="hikuyousya_date">金額</div>
        <div class="hikuyousya_btn"></div>
    </div>

    <div class="search_result_div" style="height:300px;">
        @foreach ($danka_list as $danka)
        <div class="payment_list_column">
            <div class="hikuyousya_id">{{ $danka->id }}</div>
            <div class="hikuyousya_name">{{ $danka->name }}</div>
            <div class="hikuyousya_zokumyo">{{ $danka->tel }}</div>
            <div class="hikuyousya_address">{{ $danka->pref }}{{ $danka->city }}{{ $danka->address }}{{ $danka->building }}</div>
            <div class="hikuyousya_date">{{ $danka->created_at->format('Y-m-d') }}</div>
            <div class="hikuyousya_date">{{ $danka->payment_date }}</div>
            <div class="hikuyousya_date">@if($danka->total > 0) {{ number_format($danka->total) }} @endif</div>
            <div class="hikuyousya_btn"><a href="{{ route('danka_detail', $danka->id) }}" target="_blank" class="search_view_btn_a">表示</a></div>
        </div>
        @endforeach
    </div>

    @endif
</form>
<div class="event_regist_btn_list">
    @if($category_id == 1)
    <form id="csv_export_form" name="csv_export_form" action="{{ route('nenki_csv_export') }}" method="post">
    @csrf
    {{ Form::hidden('hikuyousya_id_list', $hikuyousya_id_list) }}
    {{ Form::hidden('sort_item', $sort_item) }}
    {{ Form::hidden('sort_type', $sort_type) }}
    {{ Form::hidden('category_name', $category_name) }}
    {{ Form::hidden('event_name', $event_name) }}
    </form>
    @elseif($category_id == 5)
    <form id="csv_export_form" name="csv_export_form" action="{{ route('noukotsu_csv_export') }}" method="post">
    @csrf
    {{ Form::hidden('hikuyousya_id_list', $hikuyousya_id_list) }}
    {{ Form::hidden('sort_item', $sort_item) }}
    {{ Form::hidden('sort_type', $sort_type) }}
    {{ Form::hidden('category_name', $category_name) }}
    {{ Form::hidden('event_name', $event_name) }}
    </form>
    @else
    <form id="csv_export_form" name="csv_export_form" action="{{ route('star_csv_export') }}" method="post">
    @csrf
    {{ Form::hidden('danka_id_list', $danka_id_list) }}
    {{ Form::hidden('sort_item', $sort_item) }}
    {{ Form::hidden('sort_type', $sort_type) }}
    {{ Form::hidden('category_name', $category_name) }}
    {{ Form::hidden('event_name', $event_name) }}
    </form>
    @endif

    @if($category_id == 1 || $category_id == 5)
    <a href="#!" onclick="clickCsvExportButton({{ $hikuyousya_count }})" class="search_btn_a" style="margin: 10px auto 0;">CSV出力</a>
    @else
    <a href="#!" onclick="clickCsvExportButton({{ $danka_count }})" class="search_btn_a" style="margin: 10px auto 0;">CSV出力</a>
    @endif
    <a href="#!" onclick="clickEventStoreButton()" class="search_btn_a" style="margin: 10px auto 0;">リスト作成</a>
</div>



<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/event_regist_search.js') }}"></script>

@endsection



