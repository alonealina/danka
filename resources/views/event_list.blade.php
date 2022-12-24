@extends('layouts.app')

@section('content')
<div class="content_title">行事一覧</div>

<div class="text_category_list_div">
    <form id="admin_store_form" name="category_store_form" action="{{ route('text_category_store') }}" method="post">
    @csrf
        <div class="flex_column">
            {{ Form::text('name', old('name'), ['class' => 'category_name_text', 'maxlength' => 30, 'placeholder' => '行事名を入力してください']) }}
            <a href="#!" onclick="categoryStoreButton()" class="add_btn_a">新規追加</a>
        </div>
        <div class="error_message" id="name_error">行事名を入力してください。</div>
        @if($errors->has('name'))
        <div class="error_message check_error">{{ $errors->first('name') }}</div>
        @endif
    </form>

    <div class="category_list_header">行事名</div>
    <div class="category_list_message">{{ session('message') }}</div>
    <div class="category_list">
        @foreach($text_categories as $category)
        <div class="text_list_column">
            <div class="">{{ $category->name }}</div>
            <a href="" class="view_btn_a">表示</a>
        </div>
        @endforeach
    </div>

</div>

<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



