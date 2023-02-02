@extends('layouts.app')

@section('content')
<div class="content_title">行事一覧</div>

<div class="text_category_list_div">

    <div class="category_list_header">カテゴリー</div>
    <div class="category_list_message">{{ session('message') }}</div>
    <div class="category_list" style="height: calc(100vh - 350px);">
        @foreach($text_categories as $category)
        <div class="text_list_column">
            <div class="">{{ $category->name }}</div>
            <a href="{{ route('event_show', $category->id) }}" class="view_btn_a">表示</a>
        </div>
        @endforeach
    </div>

</div>

<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



