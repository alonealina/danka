@extends('layouts.app')

@section('content')
<div class="content_title">お知らせ編集</div>
<form id="admin_store_form" name="text_store_form" action="{{ route('notice_update') }}" method="post">
@csrf
{{ Form::hidden('id', $text->id) }}
    <div class="text_regist_div">
        <div class="flex_column">
            <div class="text_regist_name">カテゴリ</div>
            <select name="category_id" class="select_category">
                <option value="">選択してください</option>
                @foreach ($text_categories as $category)
                <option value="{{ $category->id }}"
                @if(old('category_id') == $category->id) selected 
                            @elseif(empty(old('category_id')) && $category->id == $text->category_id) selected @endif >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex_column">
            <div class="text_regist_name">件名</div>
            {{ Form::text('title', old('title', $text->title), ['class' => 'text_title_text', 'maxlength' => 30, 'placeholder' => '入力してください']) }}
        </div>
        <div class="flex_column">
            <div class="text_regist_name">内容</div>
            {{ Form::textarea('content', old('content', $text->content), ['class' => 'form_textarea', 'maxlength' => 3000]) }}
        </div>
    </div>
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">作成</a>
</form>
<script src="{{ asset('js/text_regist.js') }}"></script>

@endsection



