@extends('layouts.app')

@section('content')
<div class="user_content_title">口座設定</div>
<div class="user_item_flex">
    <div class="user_item">
        <div class="user_item_name">口座番号</div>
        <div class="user_item_content">{{$account_number}}</div>
    </div>
    <div class="user_item">
        <div class="user_item_name">口座残高</div>
        <div class="user_item_content">{{$account_balance}}</div>
    </div>
</div>
<div class="user_item_flex">
    <div class="user_item">
        <div class="user_item_name">有効証拠金</div>
        <div class="user_item_content">{{$effective_margin}}</div>
    </div>
    <div class="user_item">
        <div class="user_item_name">必要証拠金</div>
        <div class="user_item_content">{{$margin_required}}</div>
    </div>
</div>
<div class="user_item_flex">
    <div class="user_item">
        <div class="user_item_name">余剰証拠金</div>
        <div class="user_item_content">{{$surplus_margin}}</div>
    </div>
    <div class="user_item">
        <div class="user_item_name">証拠金維持率</div>
        <div class="user_item_content">{{$margin_rate}}</div>
    </div>
</div>
<div class="user_item_flex">
    <div class="user_item">
        <div class="user_item_name">ステータス</div>
        <div class="user_item_content">@if($status) Active @else No Active @endif</div>
    </div>
    <div class="user_item">
    </div>
</div>


@endsection




@section('content_sp')

<div class="user_content_title">口座設定</div>

<div class="user_item_sp">
    <div class="user_item_name">口座番号</div>
    <div class="user_item_content_sp">{{$account_number}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">口座残高</div>
    <div class="user_item_content_sp">{{$account_balance}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">有効証拠金</div>
    <div class="user_item_content_sp">{{$effective_margin}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">必要証拠金</div>
    <div class="user_item_content_sp">{{$margin_required}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">余剰証拠金</div>
    <div class="user_item_content_sp">{{$surplus_margin}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">証拠金維持率</div>
    <div class="user_item_content_sp">{{$margin_rate}}</div>
</div>
<div class="user_item_sp">
    <div class="user_item_name">ステータス</div>
    <div class="user_item_content_sp">@if($status) Active @else No Active @endif</div>
</div>


@endsection