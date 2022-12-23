@extends('layouts.app')

@section('content')
<div class="content_title">文章一覧</div>

<div class="text_show_title">{{ $category->name }}</div>

@foreach($text_list as $text)
<div class="text_regist_div">
    <div class="text_content">{{ $text->title }}</div>
    <div class="text_content">{{ $text->content }}</div>
</div>
@endforeach

<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



