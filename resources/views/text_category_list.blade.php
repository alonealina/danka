@extends('layouts.app')

@section('content')
<div class="content_title">カテゴリ一覧</div>

<div class="text_category_list_div">
    <form id="admin_store_form" name="category_store_form" action="{{ route('text_category_store') }}" method="post">
    @csrf
        <div class="flex_column">
            {{ Form::text('name', old('name'), ['class' => 'category_name_text', 'maxlength' => 30, 'placeholder' => 'カテゴリ名を入力してください']) }}
            <a href="#!" onclick="categoryStoreButton()" class="add_btn_a">新規追加</a>
        </div>
        <div class="error_message" id="name_error">カテゴリ名を入力してください。</div>
        @if($errors->has('name'))
        <div class="error_message check_error">{{ $errors->first('name') }}</div>
        @endif
    </form>

    <div class="category_list_header">カテゴリ名</div>
    <div class="category_list_message">{{ session('message') }}</div>
    <div class="category_list">
        @foreach($text_categories as $category)
        <div class="text_list_column">
            <div class="">{{ $category->name }}</div>
            <a href="text_category_delete/{{ $category->id }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
        </div>
        @endforeach
    </div>

</div>

<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



