@extends('layouts.app')

@section('content')
<div class="content_title">お知らせ一覧</div>

<div class="text_category_list_div">

    <div class="category_list_header">行事名</div>
    <div class="category_list_message">{{ session('message') }}</div>
    <div class="category_list">
        @foreach($text_categories as $category)
        <div class="text_list_column">
            <div class="">{{ $category->name }}</div>
            <a href="{{ route('notice_show', $category->id) }}" class="view_btn_a">表示</a>
        </div>
        @endforeach
    </div>

</div>

<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



