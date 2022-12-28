@extends('layouts.app')

@section('content')
<div class="content_title">請求/支払い一覧</div>

<div class="payment_btn_list">
    <div class="payment_btn_div">未請求</div>
    <a href="#" class="payment_btn_a" style="border-left: 1px solid;border-right: 1px solid;">未払い</a>
    <a href="#" class="payment_btn_a">支払い済</a>
</div>

<div class="payment_list_header">
    <div class="payment_id">ID</div>
    <div class="payment_name">名前</div>
    <div class="payment_num">識別番号</div>
    <div class="payment_tel">電話番号</div>
    <div class="payment_type">支払い種別</div>
    <div class="payment_price">料金</div>
    <div class="payment_btn"></div>
</div>

<div class="payment_list_column">
    <div class="payment_id">kouyasan</div>
    <div class="payment_name">田中太郎</div>
    <div class="payment_num">111-1111</div>
    <div class="payment_tel">090-583-5083</div>
    <div class="payment_type">入檀料</div>
    <div class="payment_price">￥1,000</div>
    <div class="payment_btn"><a href="" class="paid_btn_a">請求済</a></div>
</div>

<div class="payment_list_column">
    <div class="payment_id">kouyasan</div>
    <div class="payment_name">田中太郎</div>
    <div class="payment_num">111-1111</div>
    <div class="payment_tel">090-583-5083</div>
    <div class="payment_type">入檀料</div>
    <div class="payment_price">￥1,000</div>
    <div class="payment_btn"><a href="" class="paid_btn_a">請求済</a></div>
</div>

<div class="payment_list_column">
    <div class="payment_id">kouyasan</div>
    <div class="payment_name">田中太郎</div>
    <div class="payment_num">111-1111</div>
    <div class="payment_tel">090-583-5083</div>
    <div class="payment_type">入檀料</div>
    <div class="payment_price">￥1,000</div>
    <div class="payment_btn"><a href="" class="paid_btn_a">請求済</a></div>
</div>


<script src="{{ asset('js/text_category_list.js') }}"></script>

@endsection



