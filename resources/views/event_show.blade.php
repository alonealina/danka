@extends('layouts.app')

@section('content')
<div class="content_title">行事予定日一覧</div>
<div class="text_show_title">{{ $category->name }}</div>
<div class="text_category_list_div">
    <a href="{{ route('event_regist', $category->id) }}" class="add_btn_a">新規追加</a>
    <div class="category_list_message">{{ session('message') }}</div>
    <div class="category_list" style="margin-top:50px;">
        @foreach($event_dates as $event_date)
        <div class="text_list_column">
            <div class="">{{ $event_date->date }}</div>
            <div class="event_btn_list">
                @if($event_date->max > $event_date->date_id_count && $event_date->date >= date('Y-m-d'))
                <a href="{{ route('event_book_regist', $event_date->id) }}" class="add_btn_a">予約追加</a>
                @else
                <div class="dummy_btn_div"></div>
                @endif
                <a href="{{ route('event_book_show', $event_date->id) }}" class="view_btn_a" style="width:100px;">表示</a>
                @if($event_date->date < date('Y-m-d'))
                <div class="gray_btn_a">終了済</div>
                @elseif($event_date->max > $event_date->date_id_count)
                <div class="delete_btn_a">予約受付中</div>
                @else
                <div class="gray_btn_a">予約終了</div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>

<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



