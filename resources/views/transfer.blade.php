@extends('layouts.app')

@section('content')
<div class="user_content_title">資金移動</div>

<form id="transfer_form" name="transfer_form" action="{{ route('transfer_confirm') }}" method="post">
@csrf
    <div class="withdraw_box">
        <div class="deposit_item_flex">
            <div class="deposit_item2">
                <div class="user_item_name">出金元口座番号</div>
                <div class="deposit_item_content">{{ $account_number }}</div>
            </div>
            <div class="deposit_item2">
                <div class="user_item_name"><span class="required">＊</span>移動先口座番号</div>
                {{ Form::text('toaccount', old('toaccount'), ['class' => 'withdraw_input_text', 'maxlength' => 10, 'placeholder' => '', 'required']) }}
            </div>
        </div>
        <div class="deposit_item_flex">
            <div class="deposit_item2">
                <div class="user_item_name"><span class="required">＊</span>移動申請金額</div>
                {{ Form::text('amount', old('amount'), ['class' => 'withdraw_input_text', 'maxlength' => 10, 'placeholder' => '', 'required', 'style' => 'width: 83%;']) }}
                <span style="vertical-align: bottom;">USD</span>
            </div>
        </div>
        <div class="checkbox_item">
            <input type="checkbox" id="check_policy" value="1" required>
            <span>利用規則に同意する</span>
        </div>
    </div>

    <a onclick="clickTransferFormButton()" class="btn_a">
        <div class="btn_purple" style="margin-top:50px;">資金移動する</div>
    </a>
</form>

<script src="{{ asset('js/v2/transfer.js') }}"></script>
@endsection




@section('content_sp')

<div class="user_content_title">資金移動</div>

<form id="transfer_form" name="transfer_form" action="{{ route('transfer_confirm') }}" method="post">
@csrf
    <div class="deposit_item_sp">
        <div class="user_item_name">出金元口座番号</div>
        <div class="deposit_item_content">{{ $account_number }}</div>
    </div>
    <div class="deposit_item_sp">
        <div class="user_item_name"><span class="required">＊</span>移動先口座番号</div>
        {{ Form::text('toaccount', old('toaccount'), ['class' => 'withdraw_input_text', 'maxlength' => 10, 'placeholder' => '', 'required']) }}
    </div>
    <div class="deposit_item_sp">
        <div class="user_item_name"><span class="required">＊</span>移動申請金額</div>
        {{ Form::text('amount', old('amount'), ['class' => 'withdraw_input_text', 'maxlength' => 10, 'placeholder' => '', 'required']) }}
        <span style="float: right;">USD</span>
    </div>

    <div class="checkbox_item" style="margin:20px;">
        <input type="checkbox" id="check_policy" value="1" required>
        <span>利用規則に同意する</span>
    </div>

    <a onclick="clickTransferFormButton()" class="btn_a_sp">
        <div class="btn_purple_sp" style="margin-top:50px;">資金移動する</div>
    </a>
</form>

<script src="{{ asset('js/v2/transfer.js') }}"></script>
@endsection

