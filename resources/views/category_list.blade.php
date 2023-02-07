@extends('layouts.app')

@section('content')
<div class="content_title">カテゴリ一覧</div>

<div class="text_category_list_div">
    <form id="admin_store_form" name="category_store_form" action="{{ route('category_store') }}" method="post">
    @csrf
        <div class="flex_column" style="justify-content: end;">
            <select name="type" class="select_category" style="width: 80px; margin-right:10px;">
                <option value="item" @if(old('type') == 'item') selected @endif >商品</option>
                <option value="text" @if(old('type') == 'text') selected @endif >行事</option>
                <option value="shipment" @if(old('type') == 'shipment') selected @endif >発送物</option>
            </select>
            {{ Form::text('name', old('name'), ['class' => 'category_name_text', 'maxlength' => 30, 'placeholder' => 'カテゴリ名を入力してください']) }}
            <a href="#!" onclick="categoryStoreButton()" class="add_btn_a">新規追加</a>
        </div>
        <div class="error_message" id="name_error" style="text-align: right;">カテゴリ名を入力してください。</div>
        @if($errors->has('name'))
        <div class="error_message check_error" style="text-align: right;">{{ $errors->first('name') }}</div>
        @endif
    </form>
    <div class="payment_btn_list">
        <a id="item_btn" href="#!" onclick="ItemButton()" class="category_btn_a
        @if ($type != 'shipment' && $type != 'text') current_category @endif">商品</a>
        <a id="text_btn" href="#!" onclick="TextButton()" class="category_btn_a
        @if ($type == 'text') current_category @endif" style="border-left: 1px solid;border-right: 1px solid;">行事</a>
        <a id="shipment_btn" href="#!" onclick="ShipmentButton()" class="category_btn_a
        @if ($type == 'shipment') current_category @endif">発送物</a>
    </div>

    <div class="category_list_message">{{ session('message') }}</div>

    <div class="category_list_header">カテゴリ名</div>

    <div class="category_list">
        <div id="item_div" @if ($type == 'text' || $type == 'shipment') hidden @endif>
            @foreach($item_categories as $category)
            <div class="text_list_column">
                <div class="">{{ $category->name }}</div>
                @if($category->id > 14)
                <a href="item_category_delete/{{ $category->id }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
                @endif
            </div>
            @endforeach
        </div>
        <div id="text_div" @if ($type != 'text') hidden @endif>
            @foreach($text_categories as $category)
            <div class="text_list_column">
                <div class="">{{ $category->name }}</div>
                @if($category->id > 9)
                <a href="text_category_delete/{{ $category->id }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
                @endif
            </div>
            @endforeach
        </div>
        <div id="shipment_div" @if ($type != 'shipment') hidden @endif>
            @foreach($shipment_categories as $category)
            <div class="text_list_column">
                <div class="">{{ $category->name }}</div>
                @if($category->id > 13)
                <a href="shipment_category_delete/{{ $category->id }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
                @endif
            </div>
            @endforeach
        </div>

    </div>

</div>

<script src="{{ asset('js/category_list.js') }}"></script>

@endsection



