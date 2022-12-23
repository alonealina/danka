@extends('layouts.app')

@section('content')
<div class="content_title">新規文章作成</div>
<form id="admin_store_form" name="text_store_form" action="{{ route('text_store') }}" method="post">
@csrf
    <div class="text_regist_div">
        <div class="flex_column">
            <div class="text_regist_name">カテゴリ</div>
            <select name="category_id" class="select_category">
                <option value="">選択してください</option>
                @foreach ($text_categories as $category)
                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex_column">
            <div class="text_regist_name">件名</div>
            {{ Form::text('title', old('title'), ['class' => 'text_title_text', 'maxlength' => 30, 'placeholder' => '入力してください']) }}
        </div>
        <div class="flex_column">
            <div class="text_regist_name">内容</div>
            <textarea class="form_textarea" name="content" id="content"></textarea>
        </div>
    </div>
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">作成</a>
</form>
<script src="{{ asset('js/text_regist.js') }}"></script>

@endsection



