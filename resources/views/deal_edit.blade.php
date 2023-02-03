@extends('layouts.app')

@section('content')
<div class="content_title">取引編集</div>
<div class="admin_list_message">{{ session('message') }}</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('deal_edit_confirm') }}" method="post">
@csrf
{{ Form::hidden('deal_id', $deal->id) }}
{{ Form::hidden('danka_id', $danka->id) }}
{{ Form::hidden('payment_method', $payment_method) }}
    <div class="danka_regist_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="deal_regist_name">カルテナンバー</div>
                {{ $danka->id }}
            </div>

            <div class="danka_column">
                <div class="deal_regist_name">施主名</div>
                <div class="" id="name">{{ $danka->name }}</div>
            </div>
            <div class="danka_column">
                <div class="deal_regist_name">フリガナ</div>
                <div class="" id="kana">{{ $danka->name_kana }}</div>
            </div>
            <div class="danka_column">
                <div class="deal_regist_name">決済方法</div>
                {{ $deal->payment_method }}
            </div>
        </div>
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="deal_regist_name">郵便番号</div>
                <div class="" id="zip">{{ $danka->zip }}</div>
            </div>
            <div class="danka_column">
                <div class="deal_regist_name">住所</div>
                <div class="" id="address">{{ $danka->pref }}{{ $danka->city }}{{ $danka->address }}{{ $danka->building }}</div>
            </div>
            <div class="danka_column">
                <div class="deal_regist_name">電話番号</div>
                <div class="" id="tel">{{ $danka->tel }}</div>
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
            <div class="dummy_minus_btn_div"></div>
        </div>
        <div id="item_form" class="danka_family_content" style="height: 300px;">
            @foreach($deal_detail_list as $deal_detail)
            {{ Form::hidden('state[]', $deal_detail->state) }}
            {{ Form::hidden('payment_date[]', $deal_detail->payment_date) }}
            <div id="item-{{ $deal_detail->id }}" class="deal_item_column">
                <div class="deal_item_detail">
                    <select name="item_id[]" class="select_category select_item" style="width: 100%;">
                    @foreach ($item_list as $item)
                        <option value="{{ $item->id }}" @if($item->id == $deal_detail->item_id) selected @endif>{{ $item->name }}：{{ $item->detail }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="deal_item_num">
                    <select name="quantity[]" class="select_category" style="width: 100%;">
                        @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}" @if($i == $deal_detail->quantity) selected @endif>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="deal_item_price">
                    {{ Form::text('price[]', $deal_detail->price, ['id' => 'price', 'class' => 'danka_form_text2', 'maxlength' => 7, 'placeholder' => '', 'style' => 'width:100%']) }}

                </div>
                <div class="deal_item_zokumyo">
                    <select name="zokumyo[]" class="select_category select_zokumyo" style="width:100%;">
                        <option value="">なし</option>
                        @foreach ($hikuyousya_list as $hikuyousya)
                            <option value="{{ $hikuyousya->id }}" @if($hikuyousya->id == $deal_detail->hikuyousya_id) selected @endif>{{ $hikuyousya->common_name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="deal_item_remark">
                    {{ Form::text('remark[]', $deal_detail->remark, ['id' => 'remark', 'class' => 'danka_form_text2', 'maxlength' => 100, 'placeholder' => '', 'style' => 'width:100%']) }}
                </div>
                <a href="#!" class="item_add_btn minus_btn">―</a>
            </div>
            @endforeach
        </div>
        <div class="item_other">
            <a href="#!" onclick="clickAddButton()" class="item_add_btn">＋</a>

        </div>
    </div>


    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">確認画面へ</a>

</form>
<script src="{{ asset('js/deal_update.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



