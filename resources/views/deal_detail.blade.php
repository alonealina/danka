@extends('layouts.app')

@section('content')
<div class="content_title">取引詳細</div>
<div class="admin_list_message">{{ session('message') }}</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('deal_store') }}" method="post">
@csrf
{{ Form::hidden('danka_id', $danka->id) }}
    <div class="danka_regist_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="deal_regist_name">カルテナンバー</div>
                {{ $danka->id }}
            </div>

            <div class="danka_column">
                <div class="deal_regist_name">施主名</div>
                <div class="" id="name">{{ $danka->name }}</div>
            </div>
            <div class="danka_column">
                <div class="deal_regist_name">フリガナ</div>
                <div class="" id="kana">{{ $danka->name_kana }}</div>
            </div>
            <div class="danka_column">
                <div class="deal_regist_name">決済方法</div>
                {{ $deal->payment_method }}
            </div>
        </div>
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="deal_regist_name">郵便番号</div>
                <div class="" id="zip">{{ $danka->zip }}</div>
            </div>
            <div class="danka_column">
                <div class="deal_regist_name">住所</div>
                <div class="" id="address">{{ $danka->pref }}{{ $danka->city }}{{ $danka->address }}{{ $danka->building }}</div>
            </div>
            <div class="danka_column">
                <div class="deal_regist_name">電話番号</div>
                <div class="" id="tel">{{ $danka->tel }}</div>
            </div>
        </div>
    </div>

    <div class="danka_other_div">
        <div class="item_header">
            <div class="deal_item_detail">商品</div>
            <div class="deal_item_num">数量</div>
            <div class="deal_item_price">単価</div>
            <div class="deal_item_price">金額</div>
            <div class="deal_item_zokumyo">俗名</div>
            <div class="deal_item_zokumyo">戒名</div>
            <div class="deal_item_date">命日</div>
            <div class="deal_item_kaiki">行年</div>
            <div class="deal_item_kaiki">回忌</div>
        </div>
        <div id="item_form" class="danka_family_content" style="height: 300px;">
            @foreach ($item_list as $item)
            <div id="item-1" class="deal_item_column">
                <div class="deal_item_detail">{{ $item['item_name'] }}</div>
                <div class="deal_item_num">{{ $item['quantity'] }}</div>
                <div class="deal_item_price">{{ number_format($item['price']) }}</div>
                <div class="deal_item_price">{{ number_format($item['total']) }}</div>
                <div class="deal_item_zokumyo">{{ $item['zokumyo'] }}</div>
                <div class="deal_item_zokumyo">{{ $item['kaimyo'] }}</div>
                <div class="deal_item_date">{{ $item['meinichi'] }}</div>
                <div class="deal_item_kaiki">{{ $item['gyonen'] }}</div>
                <div class="deal_item_kaiki">@if($item['kaiki'] == 'なし') なし @elseif($item['kaiki'] <= 0) 1 @else {{ $item['kaiki'] + 2 }} @endif</div>
            </div>
            <div id="item-1" class="deal_item_column">
                　備考：{{ $item['remark'] }}
            </div>
            @endforeach
        </div>
        <div class="item_other">
            <div></div>
            <div class="family_column" style="margin: 0 15px;">
                <div class="" style="font-weight: bold;">合計　</div>
                {{ number_format($total) }} 円
            </div>
        </div>
    </div>

    <div class="search_btn_list">
        <a href="{{ route('deal_edit', $deal->id) }}" class="text_store_btn_a" style="margin:0 10px;">編集</a>
        <a href="{{ route('deal_delete', $deal->id) }}" onclick="return confirm('本当に削除しますか？')" class="text_delete_btn_a" style="margin:0 10px;">削除</a>

    </div>

</form>
<script src="{{ asset('js/deal_regist.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



