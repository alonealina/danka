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
            <div class="yen_text"> 月</div>
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
        @else
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
        @endif



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
            @if($category_id != 3)
            <input type="checkbox" id="segaki_flg" name="segaki_flg" class="danka_checkbox" value="1"
            @if(isset($segaki_flg)) checked @endif>
            <label for="segaki_flg" class="danka_label">施餓鬼</label>
            <input type="checkbox" id="star_flg" name="star_flg" class="danka_checkbox" value="1"
            @if(isset($star_flg)) checked @endif>
            <label for="star_flg" class="danka_label">星祭り</label>
            <input type="checkbox" id="yakushiji_flg" name="yakushiji_flg" class="danka_checkbox" value="1"
            @if(isset($yakushiji_flg)) checked @endif>
            <label for="yakushiji_flg" class="danka_label">薬師寺霊園</label>
            <input type="checkbox" id="kaiki_flg" name="kaiki_flg" class="danka_checkbox" value="1"
            @if(isset($kaiki_flg)) checked @endif>
            <label for="kaiki_flg" class="danka_label">回忌</label>
            @else
            <input type="checkbox" id="star_flg" name="star_flg" class="danka_checkbox" value="1"
            @if(isset($star_flg)) checked @endif>
            <label for="star_flg" class="danka_label">星祭り</label>
            @endif
        </div>

    </div>
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
        @elseif($category_id == 3)

        @else

        @endif
        {{ $danka_list->total()}}件 （被供養者{{ $hikuyousya_count }}人　施主{{ $danka_count }}人）が該当しました　
        {{ $danka_list->appends(request()->query())->links('pagination::default') }}

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

    @if($category_id == 1)
    <div class="payment_list_header" style="margin:0;">
        <div class="hikuyousya_id">カルテナンバー</div>
        <div class="hikuyousya_name">施主名</div>
        <div class="hikuyousya_zokumyo">俗名</div>
        <div class="hikuyousya_kaimyo">戒名</div>
        <div class="hikuyousya_date">命日</div>
        <div class="hikuyousya_kaiki">回忌</div>
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
            <div class="hikuyousya_date">{{ $danka->payment_date }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->category_name }}</div>
            <div class="hikuyousya_date">@if($danka->total > 0) {{ number_format($danka->total) }} @endif</div>
            <div class="hikuyousya_btn"><a href="" class="search_view_btn_a">表示</a></div>
        </div>
        @endforeach
    </div>

    @else
    <div class="payment_list_header" style="margin:0;">
        <div class="hikuyousya_id">カルテナンバー</div>
        <div class="hikuyousya_name">施主名</div>
        <div class="hikuyousya_zokumyo">電話番号</div>
        <div class="hikuyousya_address">住所</div>
        <div class="hikuyousya_date">取引作成日</div>
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
            <div class="hikuyousya_zokumyo">{{ $danka->tel }}</div>
            <div class="hikuyousya_address">{{ $danka->pref }}{{ $danka->city }}{{ $danka->address }}{{ $danka->building }}</div>
            <div class="hikuyousya_date">{{ $danka->meinichi }}</div>
            <div class="hikuyousya_date">{{ $danka->payment_date }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->category_name }}</div>
            <div class="hikuyousya_date">@if($danka->total > 0) {{ number_format($danka->total) }} @endif</div>
            <div class="hikuyousya_btn"><a href="" class="search_view_btn_a">表示</a></div>
        </div>
        @endforeach
    </div>

    @endif
</form>
<a href="#!" onclick="clickEventStoreButton()" class="search_btn_a" style="margin: 10px auto 0;">リスト作成</a>



<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/event_regist_search.js') }}"></script>

@endsection



