@extends('layouts.app')

@section('content')
<div class="content_title">発送物 - {{ $category->name }}</div>

<form id="form" name="regist_form" action="{{ route('shipment_store') }}" method="post" enctype="multipart/form-data">
@csrf
    {{ Form::hidden('category_id', $category->id) }}
    <input type="file" id="file_btn_main" onclick="fileCheckMain();" name="file">
    <a href="#!" onclick="ShipmentStoreButton()" class="add_btn_a">アップロード</a>
</form>

<div class="text_category_list_div">
    <div class="category_list_message">{{ session('message') }}</div>
    <div class="payment_list_header" style="margin:0;">
        <div class="event_view_column">
            <div class="file_view_item">ファイル名</div>
            <div class="family_view_item">アップロード日</div>
        </div>
    </div>

    <div class="search_result_div" style="height: 550px;">
        @foreach ($shipment_list as $shipment)
        <div class="payment_list_column">
            <div class="event_view_column">
                <div class="file_view_item">{{ $shipment->title }}</div>
                <div class="family_view_item">{{ substr($shipment->created_at, 0, 10) }}</div>
            </div>
            <div class="event_btn_list">
                <a href="../../shipment/{{ $category->id }}/{{ $shipment->title }}" class="add_btn_a" download>ダウンロード</a>
                <a href="{{ route('event_date_show', $shipment->id) }}" class="view_btn_100">表示</a>
                <a href="{{ route('shipment_delete', $shipment->id) }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_100">削除</a>
            </div>
        </div>
        @endforeach
    </div>


</div>

<script src="{{ asset('js/shipment_list.js') }}"></script>

@endsection



