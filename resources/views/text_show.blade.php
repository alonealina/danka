@extends('layouts.app')

@section('content')
<div class="content_title">文章一覧</div>

<div class="text_show_title">{{ $category->name }}</div>

@foreach($text_list as $text)
<div class="text_regist_div">
    <div class="flex_column_space">
        <div class="text_title">{{ $text->title }}</div>
        <a href="{{ route('text_edit', $text->id) }}" class="add_btn_a">編集</a>
    </div>
    <div class="flex_column_space">
        <div class="text_content">{!! nl2br($text->content) !!}</div>
        <a href="{{ route('text_delete', $text->id) }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
    </div>
</div>
@endforeach

<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



