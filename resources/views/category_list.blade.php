@extends('layouts.app')

@section('content')
<div class="content_title">カテゴリ一覧</div>

<div class="text_category_list_div">
    <form id="admin_store_form" name="category_store_form" action="{{ route('category_store') }}" method="post">
    @csrf
        <div class="flex_column" style="justify-content: end;">
            <select name="type" class="select_category" style="width: 80px; margin-right:10px;">
                <option value="発送物" @if(old('type') == '発送物') selected @endif >発送物</option>
                <option value="商品" @if(old('type') == '商品') selected @endif >商品</option>
                <option value="行事" @if(old('type') == '行事') selected @endif >行事</option>
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
        <a id="shipment_btn" href="#!" onclick="ShipmentButton()" class="category_btn_a current_category">発送物</a>
        <a id="item_btn" href="#!" onclick="ItemButton()" class="category_btn_a" style="border-left: 1px solid;border-right: 1px solid;">商品</a>
        <a id="text_btn" href="#!" onclick="TextButton()" class="category_btn_a">行事</a>
    </div>

    <div class="category_list_message">{{ session('message') }}</div>

    <div class="category_list_header">カテゴリ名</div>

    <div class="category_list">
        <div id="shipment_div">
            @foreach($shipment_categories as $category)
            <div class="text_list_column">
                <div class="">{{ $category->name }}</div>
                @if($category->id > 16)
                <a href="shipment_category_delete/{{ $category->id }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
                @endif
            </div>
            @endforeach
        </div>
        <div id="item_div" hidden>
            @foreach($item_categories as $category)
            <div class="text_list_column">
                <div class="">{{ $category->name }}</div>
                @if($category->id > 11)
                <a href="item_category_delete/{{ $category->id }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
                @endif
            </div>
            @endforeach
        </div>
        <div id="text_div" hidden>
            @foreach($text_categories as $category)
            <div class="text_list_column">
                <div class="">{{ $category->name }}</div>
                @if($category->id > 9)
                <a href="text_category_delete/{{ $category->id }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
                @endif
            </div>
            @endforeach
        </div>
    </div>

</div>

<script src="{{ asset('js/category_list.js') }}"></script>

@endsection



