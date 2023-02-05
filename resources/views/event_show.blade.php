@extends('layouts.app')

@section('content')
<div class="content_title">行事リスト一覧</div>
<div class="text_show_title" style="margin: 20px 0;">{{ $category->name }}</div>
<a href="{{ route('event_regist', $category->id) }}" class="add_btn_a" style="margin-bottom:20px;">新規追加</a>
<div class="text_category_list_div" style="padding:0;">
    <div class="category_list_message">{{ session('message') }}</div>
    <div class="payment_list_header" style="margin:0;">
        <div class="event_view_column">
            <div class="family_view_item">行事名</div>
            <div class="family_view_item">リスト作成日</div>
            <div class="family_view_item">人数</div>
        </div>
    </div>

    <div class="search_result_div" style="height: 550px;">
        @foreach ($event_dates as $event_date)
        <div class="payment_list_column">
            <div class="event_view_column">
                <div class="family_view_item">{{ $event_date->name }}</div>
                <div class="family_view_item">{{ substr($event_date->created_at, 0, 10) }}</div>
                <div class="family_view_item">{{ $event_date->danka_count }}</div>
            </div>
            <div class="event_btn_list">
                @if($event_date->send_flg)
                <a href="{{ route('event_wait_update', $event_date->id) }}" class="gray_btn_a">発送済み</a>
                @else
                <a href="{{ route('event_send_update', $event_date->id) }}" class="add_btn_a">発送待ち</a>
                @endif
                <a href="{{ route('item_edit', $event_date->id) }}" class="view_btn_100">表示</a>
                <a href="{{ route('event_date_delete', $event_date->id) }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_100">削除</a>
            </div>
        </div>
        @endforeach
    </div>


</div>

<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



