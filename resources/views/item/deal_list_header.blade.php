<div class="payment_list_header" style="margin:0;">
    <div class="deal_id">取引番号</div>
    <div class="deal_name">施主名</div>
    <div class="deal_name">フリガナ</div>
    <div class="deal_tel">電話番号</div>
    <div class="deal_price">
        金額
        @if ($sort_item == 'total' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('deal_list', [
            'number' => $number,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'item_category_id' => $item_category_id,
            'created_at_before' => $created_at_before,
            'created_at_after' => $created_at_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'gojikaihi_out_flg' => $gojikaihi_out_flg,
            'sort_item' => 'total',
            'sort_type' => 'asc',
            'type' => $type,
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'total' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('deal_list', [
            'number' => $number,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'item_category_id' => $item_category_id,
            'created_at_before' => $created_at_before,
            'created_at_after' => $created_at_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'gojikaihi_out_flg' => $gojikaihi_out_flg,
            'sort_item' => 'total',
            'sort_type' => 'desc',
            'type' => $type,
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif
    </div>
    <div class="deal_date">
        作成日
        @if ($sort_item == 'created_at' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('deal_list', [
            'number' => $number,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'item_category_id' => $item_category_id,
            'created_at_before' => $created_at_before,
            'created_at_after' => $created_at_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'gojikaihi_out_flg' => $gojikaihi_out_flg,
            'sort_item' => 'created_at',
            'sort_type' => 'asc',
            'type' => $type,
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'created_at' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('deal_list', [
            'number' => $number,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'item_category_id' => $item_category_id,
            'created_at_before' => $created_at_before,
            'created_at_after' => $created_at_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'gojikaihi_out_flg' => $gojikaihi_out_flg,
            'sort_item' => 'created_at',
            'sort_type' => 'desc',
            'type' => $type,
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif
    </div>
    <div class="deal_date">
        支払確認日
        @if ($sort_item == 'payment_date' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('deal_list', [
            'number' => $number,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'item_category_id' => $item_category_id,
            'created_at_before' => $created_at_before,
            'created_at_after' => $created_at_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'gojikaihi_out_flg' => $gojikaihi_out_flg,
            'sort_item' => 'payment_date',
            'sort_type' => 'asc',
            'type' => $type,
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'payment_date' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('deal_list', [
            'number' => $number,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'item_category_id' => $item_category_id,
            'created_at_before' => $created_at_before,
            'created_at_after' => $created_at_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'gojikaihi_out_flg' => $gojikaihi_out_flg,
            'sort_item' => 'payment_date',
            'sort_type' => 'desc',
            'type' => $type,
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}">
        </a>
        @endif

    </div>
    <div class="deal_btn"></div>
</div>
