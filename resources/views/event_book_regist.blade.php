@extends('layouts.app')

@section('content')
<div class="content_title">予約追加</div>
<div class="text_show_title">{{ $category->name }}</div>
<div class="event_book_flex">
    <div class="event_book_div">
        <div class="flex_column">
            <div class="regist_item_name">開催日</div>
            <div class="regist_item_name">{{ $event_date->date }}</div>
        </div>
        <div class="flex_column">
            <div class="regist_item_name">開催場所</div>
            <div class="regist_item_name">{{ $event_date->place }}</div>
        </div>
        <div class="flex_column">
            <div class="regist_item_name">予約上限数</div>
            <div class="regist_item_name">{{ $event_date->max }}</div>
        </div>
    </div>

    <div class="event_book_div">
        <form id="admin_store_form" name="event_book_store_form" action="{{ route('event_book_store') }}" method="post">
        @csrf
        {{ Form::hidden('date_id', $event_date->id) }}
            <div class="flex_column">
                <div class="regist_item_name">名前</div>
                {{ Form::text('name', old('name'), ['class' => 'regist_form_text name_text', 'maxlength' => 30, 'placeholder' => '入力してください']) }}
            </div>
            <div class="flex_column" id="name_error">
                <div class="regist_item_name"></div>
                <div class="error_message" id="place_error_text">名前を入力してください</div>
            </div>

            <div class="flex_column">
                <div class="regist_item_name">フリガナ</div>
                {{ Form::text('name_kana', old('name_kana'), ['class' => 'regist_form_text name_kana_text', 'maxlength' => 30, 'placeholder' => '入力してください']) }}
            </div>
            <div class="flex_column" id="name_kana_error">
                <div class="regist_item_name"></div>
                <div class="error_message" id="place_error_text">フリガナを入力してください</div>
            </div>

            <div class="flex_column">
                <div class="regist_item_name">電話番号</div>
                {{ Form::text('tel', old('tel'), ['class' => 'regist_form_text tel_text', 'maxlength' => 30, 'placeholder' => '入力してください']) }}
            </div>
            <div class="flex_column" id="tel_error">
                <div class="regist_item_name"></div>
                <div class="error_message" id="tel_error_text">数字を入力してください</div>
            </div>

            <a href="#!" onclick="clickEventBookStoreButton()" class="text_store_btn_a" style="margin-top: 30px;">追加</a>
        </form>
    </div>
</div>

<script src="{{ asset('js/event_book_regist.js') }}"></script>

@endsection



