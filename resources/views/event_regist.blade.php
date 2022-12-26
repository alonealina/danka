@extends('layouts.app')

@section('content')
<div class="content_title">行事予定日新規追加</div>
<div class="text_show_title">{{ $category->name }}</div>
<div class="admin_regist_div">
    <form id="admin_store_form" name="event_store_form" action="{{ route('event_store') }}" method="post">
    @csrf
    {{ Form::hidden('category_id', $category->id) }}
        <div class="flex_column">
            <div class="regist_item_name">開催日</div>
            {{ Form::date('date', date("Y-m-d"), ['class' => 'regist_form_text']) }}
        </div>

        <div class="flex_column">
            <div class="regist_item_name">開催場所</div>
            {{ Form::text('place', old('place'), ['class' => 'regist_form_text place_text', 'maxlength' => 30, 'placeholder' => '入力してください']) }}
        </div>

        <div class="flex_column" id="place_error">
            <div class="regist_item_name"></div>
            <div class="error_message" id="place_error_text">開催場所を入力してください</div>
        </div>

        <div class="flex_column">
            <div class="regist_item_name">予約上限数</div>
            {{ Form::text('max', old('max'), ['class' => 'regist_form_text max_text', 'pattern' => "^[0-9]+$", 'maxlength' => 4, 'placeholder' => '入力してください']) }}
        </div>

        <div class="flex_column" id="max_error">
            <div class="regist_item_name"></div>
            <div class="error_message" id="max_error_text">数字を入力してください</div>
        </div>

        <a href="#!" onclick="clickEventStoreButton()" class="text_store_btn_a" style="margin-top: 30px;">登録</a>
    </form>
</div>


<script src="{{ asset('js/event_regist.js') }}"></script>

@endsection



