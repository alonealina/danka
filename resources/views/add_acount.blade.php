@extends('layouts.app')

@section('content')
<div class="user_content_title">追加口座</div>

<form id="add_form" name="add_form" action="{{ route('add_confirm') }}" method="post">
@csrf
    <div class="withdraw_box">
        <div class="deposit_item_flex">
            <div class="deposit_item2">
                <div class="user_item_name">お名前（ローマ字）</div>
                <div class="deposit_item_content">{{ $name }}</div>
            </div>
            <div class="deposit_item2">
                <div class="user_item_name">メールアドレス</div>
                <div class="deposit_item_content">{{ $mail }}</div>
            </div>
        </div>
        <div class="deposit_item_flex">
            <div class="deposit_item2">
                <div class="user_item_name">取引プラットフォーム</div>
                <select name="basic_information[platform]" style="width: 100%;" required>
                    <option value="" selected="" disabled="">選択してください</option>
                    <option value="メタトレーダー4">メタトレーダー 4</option>
                </select>
            </div>
            <div class="deposit_item2">
                <div class="user_item_name">レバレッジ</div>
                <select name="basic_information[leverage]" style="width: 100%;" required>
                    <option value="">選択してください</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
            </div>
        </div>
        <div class="deposit_item_flex">
            <div class="deposit_item2">
                <div class="user_item_name">口座種類</div>
                <select name="basic_information[currency]" style="width: 100%;" required>
                    <option value="">選択して下さい</option>
                    <option value="USD">USD</option>
                </select>
            </div>
            <div class="deposit_item2">
                <div class="user_item_name">紹介者コード</div>
                <div class="deposit_item_content">{{ $introducer }}</div>
            </div>
        </div>
        <div class="checkbox_item">
            <input type="checkbox" id="check_policy" value="1" required>
            <span>利用規則に同意する</span>
        </div>
    </div>


    <a onclick="clickAddAcountFormButton()" class="btn_a">
        <div class="btn_purple" style="margin-top:50px;">追加口座申請</div>
    </a>
</form>
<script src="{{ asset('js/v2/add_acount.js') }}"></script>
@endsection




@section('content_sp')

<div class="user_content_title">追加口座</div>

<form id="add_form" name="add_form" action="{{ route('add_confirm') }}" method="post">
@csrf
    <div class="deposit_item_sp">
        <div class="user_item_name">お名前（ローマ字）</div>
        <div class="deposit_item_content">{{ $name }}</div>
    </div>
    <div class="deposit_item_sp">
        <div class="user_item_name">メールアドレス</div>
        <div class="deposit_item_content">{{ $mail }}</div>
    </div>
    <div class="deposit_item_sp">
        <div class="user_item_name">取引プラットフォーム</div>
        <select name="basic_information[platform]" style="width: 100%;" required>
            <option value="" selected="" disabled="">選択してください</option>
            <option value="メタトレーダー4">メタトレーダー 4</option>
        </select>
    </div>
    <div class="deposit_item_sp">
        <div class="user_item_name">レバレッジ</div>
        <select name="basic_information[leverage]" style="width: 100%;" required>
            <option value="">選択してください</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
        </select>
    </div>
    <div class="deposit_item_sp">
        <div class="user_item_name">口座種類</div>
        <select name="basic_information[currency]" style="width: 100%;" required>
            <option value="">選択して下さい</option>
            <option value="USD">USD</option>
        </select>
    </div>
    <div class="deposit_item_sp">
        <div class="user_item_name">紹介者コード</div>
        <div class="deposit_item_content">{{ $account_number }}</div>
    </div>



    <div class="checkbox_item" style="margin:30px;">
        <input type="checkbox" id="check_policy" value="1" required>
        <span>利用規則に同意する</span>
    </div>

    <a onclick="clickAddAcountFormButton()" class="btn_a_sp">
        <div class="btn_purple_sp" style="margin-top:50px;">追加口座申請</div>
    </a>
</form>

<script src="{{ asset('js/v2/add_acount.js') }}"></script>
@endsection

