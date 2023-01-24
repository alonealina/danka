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
                {{ Form::text('name', $name, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ</div>
                {{ Form::text('name_kana', $name_kana, ['id' => 'name_kana', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">電話番号</div>
                {{ Form::text('tel', $tel, ['id' => 'tel', 'class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '']) }}
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
                <div class="danka_regist_name">商品</div>
                <select name="area" class="select_category" style="width: 400px" id="area">
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

    <div class="paginationWrap">
        <div class="pagination_div">
            @include('item.deal_type')
            表示件数　
            @include('item.deal_number')　　
            {{ $deal_list->total() }}件が該当しました
            {{ $deal_list->appends(request()->query())->links('pagination::default') }}
        </div>
    </div>

    <div class="payment_list_header" style="margin:0;">
        <div class="deal_id">取引番号</div>
        <div class="deal_name">施主名</div>
        <div class="deal_name">フリガナ</div>
        <div class="deal_tel">電話番号</div>
        <div class="deal_item">取引内容</div>
        <div class="deal_price">金額</div>
        <div class="deal_date">支払い確認</div>
        <div class="deal_date">作成日</div>
        <div class="deal_btn"></div>
    </div>

    <div class="search_result_div">

        @foreach ($deal_list as $deal)
        <div class="payment_list_column">
            <div class="deal_id">{{ $deal->id }}</div>
            <div class="deal_name">{{ $deal->name }}</div>
            <div class="deal_name">{{ $deal->name_kana }}</div>
            <div class="deal_tel">{{ $deal->tel }}</div>
            <div class="deal_item">{{ $deal->detail }}</div>
            <div class="deal_price">{{ number_format($deal->total) }}</div>
            <div class="deal_date">{{ $deal->payment_date }}</div>
            <div class="deal_date">{{ $deal->created_at->format('Y-m-d') }}</div>
            <div class="deal_btn">
                @if ($deal->state == "未払い")
                <a href="{{ route('unclaimed_update', $deal->deal_detail_id) }}" class="payment_white_btn_a">送付待ちへ</a>
                <a href="{{ route('paid_update', $deal->deal_detail_id) }}" class="payment_blue_btn_a">支払済へ</a>
                <a href="{{ route('danka_detail', $deal->id) }}" class="payment_view_btn_a">表示</a>
                @else
                <a href="{{ route('unpaid_update', $deal->deal_detail_id) }}" class="payment_red_btn_a">未払いへ</a>
                <a href="{{ route('danka_detail', $deal->id) }}" class="payment_view_btn_a">表示</a>
                @endif
            </div>
        </div>


        @endforeach
        
    </div>


    

</form>
<script src="{{ asset('js/search.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



