@extends('layouts.app')

@section('content')
<div class="content_title">取引作成</div>
<div class="admin_list_message">{{ session('message') }}</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('deal_confirm') }}" method="post">
@csrf
    <div class="danka_regist_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">カルテナンバー</div>
                {{ Form::text('danka_id', old('danka_id'), ['id' => 'id_input', 'class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '']) }}
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">施主名</div>
                <div class="" id="name"></div>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ</div>
                <div class="" id="kana"></div>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">決済方法</div>
                <select name="payment_method" class="select_category">
                    <option value="現金書留">現金書留</option>
                    <option value="銀行振込">銀行振込</option>
                    <option value="クレジット">クレジット</option>
                    <option value="コード決済">コード決済</option>
                    <option value="電子決済">電子決済</option>
                </select>
            </div>
        </div>
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">郵便番号</div>
                <div class="" id="zip"></div>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">住所</div>
                <div class="" id="address"></div>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">電話番号</div>
                <div class="" id="tel"></div>
            </div>
        </div>
    </div>

    <div class="danka_other_div">
        <div class="item_header">
            <div class="deal_item_detail">商品</div>
            <div class="deal_item_num">数量</div>
            <div class="deal_item_price">単価</div>
            <div class="deal_item_zokumyo">俗名</div>
            <div class="deal_item_remark">備考</div>
        </div>
        <div id="item_form" class="danka_family_content">
            <div id="item-1" class="deal_item_column">
                <div class="deal_item_detail">
                    <select name="item_id[]" class="select_category select_item" style="width: 100%;">
                    @foreach ($item_list as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}：{{ $item->detail }}</option>

                    @endforeach
                    </select>
                </div>

                <div class="deal_item_num">
                    <select name="quantity[]" class="select_category" style="width: 100%;">
                        @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="deal_item_price">
                    {{ Form::text('price[]', old('price'), ['id' => 'price', 'class' => 'danka_form_text2', 'maxlength' => 7, 'placeholder' => '', 'style' => 'width:100%']) }}

                </div>
                <div class="deal_item_zokumyo">
                    <select name="zokumyo[]" class="select_category select_zokumyo" style="width:100%;">
                        <option value="">なし</option>

                    </select>

                </div>
                <div class="deal_item_remark">
                    {{ Form::text('remark[]', old('remark'), ['id' => 'remark', 'class' => 'danka_form_text2', 'maxlength' => 100, 'placeholder' => '', 'style' => 'width:100%']) }}
                </div>
            </div>
        </div>
        <div class="item_other">
            <a href="#!" onclick="clickAddButton()" class="item_add_btn">＋</a>

        </div>
    </div>


    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">確認画面へ</a>
</form>
<script src="{{ asset('js/deal_regist.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



