@extends('layouts.app')

@section('content')
<div class="content_title">予約一覧</div>
<div class="text_show_title">{{ $category->name }}</div>
<div class="event_book_flex">
    <div class="event_book_detail">
        <div class="flex_column">
            <div class="book_item_name">開催日</div>
            <div class="book_item_content">{{ $event_date->date }}</div>
        </div>
        <div class="flex_column">
            <div class="book_item_name">開催場所</div>
            <div class="book_item_content">{{ $event_date->place }}</div>
        </div>
        <div class="flex_column">
            <div class="book_item_name">予約上限数</div>
            <div class="book_item_content">{{ $event_date->max }}</div>
        </div>
        <div class="flex_column">
            <div class="book_item_name">予約数</div>
            <div class="book_item_content">{{ $event_books->count() }}</div>
        </div>
        @if($event_date->max > $event_books->count())
        <a href="{{ route('event_book_regist', $category->id) }}" class="book_add_btn_a">予約追加</a>
        @endif
    </div>
    

    <div class="event_book_list">
        @foreach($event_books as $book)
        <div class="event_book_column">{{ $book->name }}　{{ $book->tel }}</div>
        @endforeach
    </div>
</div>


<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



