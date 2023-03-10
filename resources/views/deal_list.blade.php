@extends('layouts.app')

@section('content')
<div class="content_title">取引一覧</div>
<form id="form" name="search_form" action="{{ route('deal_list') }}" method="get">
@csrf
{{ Form::hidden('type', $type) }}
    <div class="danka_search_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">施主名</div>
                {{ Form::text('name', $name, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ</div>
                {{ Form::text('name_kana', $name_kana, ['id' => 'name_kana', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => 'セイ　メイ']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">電話番号</div>
                {{ Form::text('tel', $tel, ['id' => 'tel', 'class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリーワード</div>
                {{ Form::text('freeword', $freeword, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                {{ Form::hidden('gojikaihi_out_flg', 0) }}
                <input type="checkbox" id="gojikaihi_out_flg" name="gojikaihi_out_flg" class="danka_checkbox" value="1"
                @if($gojikaihi_out_flg == 1) checked @endif>
                <label for="gojikaihi_out_flg" class="danka_label">護持会費を除く</label>
            </div>

        </div>

        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">作成日</div>
                {{ Form::date('created_at_before', $created_at_before, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}　～　
                {{ Form::date('created_at_after', $created_at_after, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">支払い履歴</div>
                {{ Form::date('payment_before', $payment_before, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}　～　
                {{ Form::date('payment_after', $payment_after, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">商品カテゴリー</div>
                <select name="item_category_id" class="select_category" style="width: 400px" id="">
                    <option value="">----</option>
                    @foreach ($item_category_list as $item_category)
                    <option value="{{ $item_category->id }}"
                        @if($item_category_id == $item_category->id) selected @endif >{{ $item_category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">商品詳細</div>
                <select name="item_id" class="select_category" style="width: 400px" id="">
                    <option value="">----</option>
                    @foreach ($item_list as $item)
                    <option value="{{ $item->id }}"
                        @if($item_id == $item->id) selected @endif >{{ $item->name }}：{{ $item->detail }}</option>
                    @endforeach
                </select>
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">金額</div>
                {{ Form::text('price_min', $price_min, ['id' => 'tel', 'class' => 'danka_form_text2', 'maxlength' => 7, 'style' => 'width: 110px;']) }}
                <div class="yen_text"> 円　～　</div>
                {{ Form::text('price_max', $price_max, ['id' => 'tel', 'class' => 'danka_form_text2', 'maxlength' => 7, 'style' => 'width: 110px;']) }}
                <div class="yen_text"> 円</div>
            </div>

        </div>
        <div class="search_btn_list">
            <a href="#!" onclick="clickSearchButton()" class="search_btn_a">検索</a>
            <a href="#!" onclick="clickClearButton()" class="clear_btn_a">クリア</a>
        </div>
    </div>
</form>

<div class="category_list_message">{{ session('message') }}</div>

<div class="paginationWrap">
    <div class="pagination_div">
        @include('item.deal_type')
        表示件数　
        @include('item.deal_number')　　
        {{ $deal_list->total() }}件が該当しました
        {{ $deal_list->appends(request()->query())->links('pagination::default') }}
        　　合計金額　{{ number_format($sum_price) }} 円
    </div>
    <form id="form" name="update_form" action="{{ route('deal_csv_export') }}" method="post">
        @csrf
        {{ Form::hidden('type', $type) }}
        {{ Form::hidden('name', $name) }}
        {{ Form::hidden('name_kana', $name_kana) }}
        {{ Form::hidden('tel', $tel) }}
        {{ Form::hidden('item_category_id', $item_category_id) }}
        {{ Form::hidden('item_id', $item_id) }}
        {{ Form::hidden('created_at_before', $created_at_before) }}
        {{ Form::hidden('created_at_after', $created_at_after) }}
        {{ Form::hidden('payment_before', $payment_before) }}
        {{ Form::hidden('payment_after', $payment_after) }}
        {{ Form::hidden('price_min', $price_min) }}
        {{ Form::hidden('price_max', $price_max) }}
        {{ Form::hidden('gojikaihi_out_flg', $gojikaihi_out_flg) }}
        {{ Form::hidden('sort_item', $sort_item) }}
        {{ Form::hidden('sort_type', $sort_type) }}
        {{ Form::hidden('freeword', $freeword) }}
        {{ Form::hidden('number', $number) }}
        <button class="payment_blue_btn_a" onclick="return confirm('{{ $deal_detail_count }}件出力しますがよろしいですか？')" >CSV出力</button>
    </form>
</div>


@include('item.deal_list_header')


<div class="search_result_div">

    @foreach ($deal_list as $deal)
    <div class="payment_list_column">
        <div class="deal_id">{{ $deal->deal_no }}</div>
        <div class="deal_name">{{ $deal->name }}</div>
        <div class="deal_name">{{ $deal->name_kana }}</div>
        <div class="deal_tel">{{ $deal->tel }}</div>
        <div class="deal_price">{{ number_format($deal->total) }}</div>
        <div class="deal_date">{{ $deal->created_at->format('Y-m-d') }}</div>
        <div class="deal_date">{{ $deal->payment_date }}</div>
        <div class="deal_btn">
            @if ($deal->state == "未払い")
            <form id="form" name="update_form" action="{{ route('unclaimed_update') }}" method="post">
                @csrf
                {{ Form::hidden('type', $type) }}
                {{ Form::hidden('id', $deal->id) }}
                {{ Form::hidden('name', $name) }}
                {{ Form::hidden('name_kana', $name_kana) }}
                {{ Form::hidden('tel', $tel) }}
                {{ Form::hidden('item_category_id', $item_category_id) }}
                {{ Form::hidden('item_id', $item_id) }}
                {{ Form::hidden('created_at_before', $created_at_before) }}
                {{ Form::hidden('created_at_after', $created_at_after) }}
                {{ Form::hidden('payment_before', $payment_before) }}
                {{ Form::hidden('payment_after', $payment_after) }}
                {{ Form::hidden('price_min', $price_min) }}
                {{ Form::hidden('price_max', $price_max) }}
                {{ Form::hidden('gojikaihi_out_flg', $gojikaihi_out_flg) }}
                {{ Form::hidden('sort_item', $sort_item) }}
                {{ Form::hidden('sort_type', $sort_type) }}
                {{ Form::hidden('freeword', $freeword) }}
                {{ Form::hidden('number', $number) }}
                <button class="payment_white_btn_a">送付待ちへ</button>
            </form>

            <form id="form" name="update_form" action="{{ route('paid_update') }}" method="post">
                @csrf
                {{ Form::hidden('type', $type) }}
                {{ Form::hidden('id', $deal->id) }}
                {{ Form::hidden('name', $name) }}
                {{ Form::hidden('name_kana', $name_kana) }}
                {{ Form::hidden('tel', $tel) }}
                {{ Form::hidden('item_category_id', $item_category_id) }}
                {{ Form::hidden('item_id', $item_id) }}
                {{ Form::hidden('created_at_before', $created_at_before) }}
                {{ Form::hidden('created_at_after', $created_at_after) }}
                {{ Form::hidden('payment_before', $payment_before) }}
                {{ Form::hidden('payment_after', $payment_after) }}
                {{ Form::hidden('price_min', $price_min) }}
                {{ Form::hidden('price_max', $price_max) }}
                {{ Form::hidden('gojikaihi_out_flg', $gojikaihi_out_flg) }}
                {{ Form::hidden('sort_item', $sort_item) }}
                {{ Form::hidden('sort_type', $sort_type) }}
                {{ Form::hidden('freeword', $freeword) }}
                {{ Form::hidden('number', $number) }}
                <button class="payment_blue_btn_a">支払済へ</button>
            </form>

            <a href="{{ route('deal_detail', ['id' => $deal->id, 'type' => $type]) }}" class="payment_view_btn_a" target="_blank">表示</a>
            @else
            <form id="form" name="update_form" action="{{ route('unpaid_update') }}" method="post">
                @csrf
                {{ Form::hidden('type', $type) }}
                {{ Form::hidden('id', $deal->id) }}
                {{ Form::hidden('name', $name) }}
                {{ Form::hidden('name_kana', $name_kana) }}
                {{ Form::hidden('tel', $tel) }}
                {{ Form::hidden('item_category_id', $item_category_id) }}
                {{ Form::hidden('item_id', $item_id) }}
                {{ Form::hidden('created_at_before', $created_at_before) }}
                {{ Form::hidden('created_at_after', $created_at_after) }}
                {{ Form::hidden('payment_before', $payment_before) }}
                {{ Form::hidden('payment_after', $payment_after) }}
                {{ Form::hidden('price_min', $price_min) }}
                {{ Form::hidden('price_max', $price_max) }}
                {{ Form::hidden('gojikaihi_out_flg', $gojikaihi_out_flg) }}
                {{ Form::hidden('sort_item', $sort_item) }}
                {{ Form::hidden('sort_type', $sort_type) }}
                {{ Form::hidden('freeword', $freeword) }}
                {{ Form::hidden('number', $number) }}
                <button class="payment_red_btn_a" onclick="return confirm('未払いに変更しますか？')" >未払いへ</button>
            </form>

            <a href="{{ route('deal_detail', ['id' => $deal->id, 'type' => $type]) }}" class="payment_view_btn_a" target="_blank">表示</a>
            @endif
        </div>
    </div>


    @endforeach
    
</div>





<script src="{{ asset('js/search.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



