@extends('layouts.app')

@section('content')
<div class="user_content_title">履 歴</div>
<div class="user_item_flex">
    <div class="history_box">
        <div class="history_header">
            <div class="history_column_item order_number">注文番号</div>
            <div class="history_column_item order_time">発注時刻</div>
            <div class="history_column_item order_type">注文<br>種類</div>
            <div class="history_column_item order_size">サイズ</div>
            <div class="history_column_item order_brand">銘柄</div>
            <div class="history_column_item order_price">発注<br>価格</div>
            <div class="history_column_item s_l">S/L</div>
            <div class="history_column_item t_p">T/P</div>
            <div class="history_column_item settle_time">決済時刻</div>
            <div class="history_column_item settle_price">決済<br>価格</div>
            <div class="history_column_item commission">手数料</div>
            <div class="history_column_item swap">スワ<br>ップ</div>
            <div class="history_column_item profit">Profit</div>
        </div>
        @foreach($closedOrders as $closedOrder)
        
        <div class="history_column">
            <div class="history_column_item order_number">{{$closedOrder['order']}}</div>
            <div class="history_column_item order_time">{{$closedOrder['open_time']}}</div>
            <div class="history_column_item order_type">{{$closedOrder['type']}}</div>
            <div class="history_column_item order_size">{{$closedOrder['volume']}}</div>
            <div class="history_column_item order_brand">{{$closedOrder['symbol']}}</div>
            <div class="history_column_item order_price">{{$closedOrder['open_price']}}</div>
            <div class="history_column_item s_l">{{$closedOrder['SL']}}</div>
            <div class="history_column_item t_p">{{$closedOrder['TP']}}</div>
            <div class="history_column_item settle_time">{{$closedOrder['close_time']}}</div>
            <div class="history_column_item settle_price">{{$closedOrder['close_price']}}</div>
            <div class="history_column_item commission">{{$closedOrder['commission']}}</div>
            <div class="history_column_item swap">{{$closedOrder['swap']}}</div>
            <div class="history_column_item profit">{{$closedOrder['profit']}}</div>
        </div>

        @endforeach
    </div>
    <div class="history_item">

        <div class="history_item_name" style="bottom: 360px;">ご入金</div>
        <div class="history_item_content"style="bottom: 320px;">{{$peyment}}</div>

        <div class="history_item_name" style="bottom: 280px;">出金額</div>
        <div class="history_item_content"style="bottom: 240px;">{{$withdraw}}</div>

        <div class="history_item_name" style="bottom: 200px;">ADJ</div>
        <div class="history_item_content"style="bottom: 160px;">{{$adj}}</div>

        <div class="history_item_name" style="bottom: 120px;">スワップ</div>
        <div class="history_item_content"style="bottom: 80px;">{{$swap}}</div>

        <div class="history_item_name" style="bottom: 40px;">確定損益</div>
        <div class="history_item_content"style="bottom: 0px;">{{$fixed_pl}}</div>

    </div>

</div>

<div class="pagenate"> 
    @if ($page > 1) <a href="?page={{ $page - 1 }}"><</a>. @endif
    <span class="page_current">{{ $page }}</span>.
    @if ($closedOrdersAreMore) <a href="?page={{ $page + 1 }}">></a> @endif     
</div>

@endsection




@section('content_sp')

<div class="user_content_title">履 歴</div>

<div class="history_box_sp">
    <div class="history_header" style="font: normal normal bold 12px/14px Open Sans;">
        <div class="history_column_item order_number_sp">注文番号</div>
        <div class="history_column_item order_time_sp">発注時刻</div>
        <div class="history_column_item order_type_sp">注文<br>種類</div>
        <div class="history_column_item order_size_sp">サイズ</div>
        <div class="history_column_item order_brand_sp">銘柄</div>
        <div class="history_column_item order_price_sp">発注価格</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
    <div class="history_column">
        <div class="history_column_item order_number_sp">20132650</div>
        <div class="history_column_item order_time_sp">2022-02-21 23:30:01</div>
        <div class="history_column_item order_type_sp">BUY</div>
        <div class="history_column_item order_size_sp">0.02</div>
        <div class="history_column_item order_brand_sp">XAUUSD</div>
        <div class="history_column_item order_price_sp">1910.45</div>
    </div>
</div>
<div class="pagenate_sp">
    @if ($page > 1) <a href="?page={{ $page - 1 }}"><</a>. @endif
    <span class="page_current">{{ $page }}</span>.
    @if ($closedOrdersAreMore) <a href="?page={{ $page + 1 }}">></a> @endif         
</div>

<div class="user_item_sp">
    <div class="user_item_name">ご入金</div>
    <div class="user_item_content_sp">{{$peyment}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">出金額</div>
    <div class="user_item_content_sp">{{$withdraw}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">ADJ</div>
    <div class="user_item_content_sp">{{$adj}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">スワップ</div>
    <div class="user_item_content_sp">{{$swap}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">確定損益</div>
    <div class="user_item_content_sp">{{$fixed_pl}}</div>
</div>


@endsection