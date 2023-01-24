@extends('layouts.app')

@section('content')
<div class="content_title">商品一覧</div>

<form id="admin_store_form" name="item_store_form" action="{{ route('item_store') }}" method="post">
@csrf
    <div class="flex_column" style="justify-content: end;">
        <select name="category_id" class="select_category" style="width: 200px; margin-right:10px;">
            @foreach ($item_categories as $category)
            <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif >{{ $category->name }}</option>
            @endforeach
        </select>
        {{ Form::text('detail', old('detail'), ['id' => 'detail', 'class' => 'item_name_text', 'maxlength' => 20, 'placeholder' => '詳細']) }}
        {{ Form::text('price', old('price'), ['id' => 'price', 'class' => 'item_name_text', 'maxlength' => 7, 'placeholder' => '単価']) }}
        <a href="#!" onclick="itemStoreButton()" class="add_btn_a">新規追加</a>
    </div>
    <div class="error_message" id="detail_error" style="text-align: right;">商品名を入力してください。</div>
    <div class="error_message" id="price_error" style="text-align: right;">単価を入力してください。</div>
    @if($errors->has('detail'))
    <div class="error_message check_error" style="text-align: right;">{{ $errors->first('detail') }}</div>
    @endif
</form>

<div class="category_list_message">{{ session('message') }}</div>

<div class="payment_list_header" style="margin:0;">
    <div class="item_view_column">
        <div class="family_view_item">カテゴリ</div>
        <div class="family_view_item">詳細</div>
        <div class="family_view_item">単価</div>
    </div>
</div>

<div class="search_result_div" style="height: 600px;">
    @foreach ($item_list as $item)
    <div class="payment_list_column">
        <div class="item_view_column">
            <div class="family_view_item">{{ $item->name }}</div>
            <div class="family_view_item">{{ $item->detail }}</div>
            <div class="family_view_item">{{ $item->price }}</div>
        </div>
        <div class="item_btn_list">
            <a href="{{ route('item_edit', $item->id) }}" class="edit_btn_a">編集</a>
            <a href="{{ route('item_delete', $item->id) }}" onclick="return confirm('本当に削除しますか？')" class="delete_btn_a">削除</a>
        </div>
    </div>
    @endforeach
</div>

<script src="{{ asset('js/item_list.js') }}"></script>

@endsection



