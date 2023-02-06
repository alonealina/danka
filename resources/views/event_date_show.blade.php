@extends('layouts.app')

@section('content')
<div class="content_title">行事表示</div>
<div class="text_show_title">{{ $category_name }} - {{ $event_name }}</div>

<div class="paginationWrap">
    <div class="pagination_div">
        {{ $danka_list->count()}}件 （
        @if($category_id == 1) 被供養者{{ $hikuyousya_count }}人　@endif
        施主{{ $danka_count }}人）が該当しました　

    </div>
    @if($category_id == 1)
    <form id="csv_export_form" name="csv_export_form" action="{{ route('nenki_csv_export') }}" method="post">
    @csrf
    {{ Form::hidden('hikuyousya_id_list', $hikuyousya_id_list) }}
    </form>
    @elseif($category_id == 5)
    <form id="csv_export_form" name="csv_export_form" action="{{ route('noukotsu_csv_export') }}" method="post">
    @csrf
    {{ Form::hidden('hikuyousya_id_list', $hikuyousya_id_list) }}
    </form>
    @else
    <form id="csv_export_form" name="csv_export_form" action="{{ route('star_csv_export') }}" method="post">
    @csrf
    {{ Form::hidden('danka_id_list', $danka_id_list) }}
    </form>
    @endif


    <a href="#!" onclick="clickCsvExportButton()" class="search_btn_a" style="margin:0 10px;">CSV出力</a>
</div>



<form id="regist_form" name="event_store_form" action="{{ route('event_store') }}" method="post">
@csrf
{{ Form::hidden('category_id', $category_id) }}
{{ Form::hidden('category_name', $category_name) }}
{{ Form::hidden('event_name', $event_name) }}
{{ Form::hidden('danka_count', $danka_count) }}
{{ Form::hidden('danka_id_list', $danka_id_list) }}
{{ Form::hidden('freeword', $freeword) }}

    @if($category_id == 1)
    <div class="payment_list_header" style="margin:0;">
        <div class="hikuyousya_id">カルテナンバー</div>
        <div class="hikuyousya_name">施主名</div>
        <div class="hikuyousya_zokumyo">俗名</div>
        <div class="hikuyousya_kaimyo">戒名</div>
        <div class="hikuyousya_date">命日</div>
        <div class="hikuyousya_kaiki">回忌</div>
        <div class="hikuyousya_kaiki"></div>
        <div class="hikuyousya_date">支払日</div>
        <div class="hikuyousya_kaimyo">商品カテゴリー</div>
        <div class="hikuyousya_date">金額</div>
        <div class="hikuyousya_btn"></div>
    </div>

    <div class="search_result_div" style="height:550px;">
        @foreach ($danka_list as $danka)
        <div class="payment_list_column">
            <div class="hikuyousya_id">{{ $danka->id }}</div>
            <div class="hikuyousya_name">{{ $danka->name }}</div>
            <div class="hikuyousya_zokumyo">{{ $danka->common_name }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->posthumous }}</div>
            <div class="hikuyousya_date">{{ $danka->meinichi }}</div>
            <div class="hikuyousya_kaiki">@if($danka->kaiki <= 0) 1 @else {{ $danka->kaiki + 2 }} @endif</div>
            <div class="hikuyousya_kaiki">@if($danka->kaiki_flg) 〇 @endif</div>
            <div class="hikuyousya_date">{{ $danka->payment_date }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->category_name }}</div>
            <div class="hikuyousya_date">@if($danka->total > 0) {{ number_format($danka->total) }} @endif</div>
            <div class="hikuyousya_btn"><a href="{{ route('danka_detail', $danka->id) }}" target="_blank" class="search_view_btn_a">表示</a></div>
        </div>
        @endforeach
    </div>

    @elseif($category_id == 5)
    <div class="payment_list_header" style="margin:0;">
        <div class="hikuyousya_id">カルテナンバー</div>
        <div class="hikuyousya_name">施主名</div>
        <div class="hikuyousya_zokumyo">俗名</div>
        <div class="hikuyousya_kaimyo">戒名</div>
        <div class="hikuyousya_date">納骨日</div>
        <div class="hikuyousya_date">納骨移動日</div>
        <div class="hikuyousya_column">特記事項</div>
        <div class="hikuyousya_btn"></div>
    </div>

    <div class="search_result_div" style="height:550px;">
        @foreach ($danka_list as $danka)
        <div class="payment_list_column">
            <div class="hikuyousya_id">{{ $danka->id }}</div>
            <div class="hikuyousya_name">{{ $danka->name }}</div>
            <div class="hikuyousya_zokumyo">{{ $danka->common_name }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->posthumous }}</div>
            <div class="hikuyousya_date">{{ $danka->nokotsubi }}</div>
            <div class="hikuyousya_date">{{ $danka->nokotsuidobi }}</div>
            <div class="hikuyousya_column">{{ $danka->column }}</div>
            <div class="hikuyousya_btn"><a href="{{ route('danka_detail', $danka->id) }}" target="_blank" class="search_view_btn_a">表示</a></div>
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

    <div class="search_result_div" style="height:550px;">
        @foreach ($danka_list as $danka)
        <div class="payment_list_column">
            <div class="hikuyousya_id">{{ $danka->id }}</div>
            <div class="hikuyousya_name">{{ $danka->name }}</div>
            <div class="hikuyousya_zokumyo">{{ $danka->tel }}</div>
            <div class="hikuyousya_address">{{ $danka->pref }}{{ $danka->city }}{{ $danka->address }}{{ $danka->building }}</div>
            <div class="hikuyousya_date">{{ $danka->created_at->format('Y-m-d') }}</div>
            <div class="hikuyousya_date">{{ $danka->payment_date }}</div>
            <div class="hikuyousya_kaimyo">{{ $danka->category_name }}</div>
            <div class="hikuyousya_date">@if($danka->total > 0) {{ number_format($danka->total) }} @endif</div>
            <div class="hikuyousya_btn"><a href="{{ route('danka_detail', $danka->id) }}" target="_blank" class="search_view_btn_a">表示</a></div>
        </div>
        @endforeach
    </div>

    @endif
</form>



<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/event_regist_search.js') }}"></script>

@endsection



