@extends('layouts.app')

@section('content')
<div class="content_title">行事新規追加</div>
<div class="text_show_title">{{ $category_name }} - {{ $event_name }}</div>
<form id="form" name="search_form" action="{{ route('danka_search') }}" method="post">
@csrf
{{ Form::hidden('category_id', $category_id) }}
{{ Form::hidden('category_name', $category_name) }}
{{ Form::hidden('event_name', $event_name) }}
<div class="danka_search_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">命日</div>
                {{ Form::date('meinichi_before', $meinichi_before, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}　～　
                {{ Form::date('meinichi_after', $meinichi_after, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}
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

            <div class="danka_column">
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
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">フリーワード</div>
                {{ Form::text('freeword', $freeword, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
        </div>

        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">支払い履歴</div>
                {{ Form::date('payment_before', $payment_before, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}　～　
                {{ Form::date('payment_after', $payment_after, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">商品</div>
                <select name="area" class="select_category" style="width: 400px" id="area">
                    <option value="">----</option>
                    @foreach ($item_categories as $item_category)
                    <option value="{{ $item_category->id }}"
                        @if($item_category_id == $item_category->id) selected @endif >{{ $item_category->name }}</option>
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
            表示件数　
            {{ $danka_list->total() }}件が該当しました
            {{ $danka_list->appends(request()->query())->links('pagination::default') }}
    
        </div>
    </div>
    <div class="payment_list_header" style="margin:0;">
        <div class="hikuyousya_id">カルテナンバー</div>
        <div class="hikuyousya_name">施主名</div>
        <div class="hikuyousya_zokumyo">俗名</div>
        <div class="hikuyousya_kaimyo">戒名</div>
        <div class="hikuyousya_date">命日</div>
        <div class="hikuyousya_kaiki">回忌</div>
        <div class="hikuyousya_date">最終支払日</div>
        <div class="hikuyousya_ihai">位牌番号</div>
        <div class="hikuyousya_date">建立日</div>
        <div class="hikuyousya_kaimyo">特記事項</div>
        <div class="hikuyousya_btn"></div>
    </div>

    <div class="search_result_div" style="height: 240px;">

        @foreach ($danka_list as $danka)
        <div class="payment_list_column">
            <div class="hikuyousya_id">{{ $danka->danka_id }}</div>
            <div class="hikuyousya_name">{{ $danka->name }}</div>
            <div class="hikuyousya_zokumyo">{{ $danka->common_name }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->posthumous }}</div>
            <div class="hikuyousya_date">{{ $danka->meinichi }}</div>
            <div class="hikuyousya_kaiki">@if($danka->kaiki <= 0) 1 @else {{ $danka->kaiki + 2 }} @endif</div>
            <div class="hikuyousya_date">{{ $danka->payment_date }}</div>
            <div class="hikuyousya_ihai">{{ $danka->ihai_no }}</div>
            <div class="hikuyousya_date">{{ $danka->konryubi }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->column }}</div>
            <div class="hikuyousya_btn"><a href="" class="search_view_btn_a">表示</a></div>
        </div>


        @endforeach
        
    </div>

</form>



<script src="{{ asset('js/event_regist.js') }}"></script>

@endsection



