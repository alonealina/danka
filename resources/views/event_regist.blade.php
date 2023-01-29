@extends('layouts.app')

@section('content')
<div class="content_title">行事新規追加</div>
<div class="text_show_title">{{ $category->name }}</div>
<div class="admin_regist_div">
    <form id="admin_store_form" name="event_store_form" action="{{ route('event_regist_search') }}" method="post">
    @csrf
    {{ Form::hidden('category_id', $category->id) }}
        <div class="flex_column">
            <div class="regist_item_name">行事名</div>
            {{ Form::text('event_name', old('event_name'), ['class' => 'regist_form_text place_text', 'maxlength' => 30, 'placeholder' => '']) }}
        </div>


        <a href="#!" onclick="clickEventStoreButton()" class="text_store_btn_a" style="margin-top: 30px;">登録</a>
    </form>
</div>


<script src="{{ asset('js/event_regist.js') }}"></script>

@endsection



