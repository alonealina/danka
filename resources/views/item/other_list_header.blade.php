<div class="payment_list_header" style="margin:0;">
    <div class="hikuyousya_id">カルテナンバー</div>
    <div class="hikuyousya_name">施主名</div>
    <div class="hikuyousya_zokumyo">電話番号</div>
    <div class="hikuyousya_address">住所</div>
    <div class="hikuyousya_date">
        取引作成日
        @if ($sort_item == 'created_at' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'payment_flg' => $payment_flg,
            'event_date_id' => $event_date_id,
            'event_date_flg' => $event_date_flg,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'freeword' => $freeword,
            'item_category_id' => $item_category_id,
            'sort_item' => 'created_at',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'created_at' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'payment_flg' => $payment_flg,
            'event_date_id' => $event_date_id,
            'event_date_flg' => $event_date_flg,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'freeword' => $freeword,
            'item_category_id' => $item_category_id,
            'sort_item' => 'created_at',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_date">
        支払日
        @if ($sort_item == 'payment_date' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'payment_flg' => $payment_flg,
            'event_date_id' => $event_date_id,
            'event_date_flg' => $event_date_flg,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'freeword' => $freeword,
            'item_category_id' => $item_category_id,
            'sort_item' => 'payment_date',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'payment_date' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'payment_flg' => $payment_flg,
            'event_date_id' => $event_date_id,
            'event_date_flg' => $event_date_flg,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'freeword' => $freeword,
            'item_category_id' => $item_category_id,
            'sort_item' => 'payment_date',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif


    </div>
    <div class="hikuyousya_date">
        金額
        @if ($sort_item == 'total' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'payment_flg' => $payment_flg,
            'event_date_id' => $event_date_id,
            'event_date_flg' => $event_date_flg,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'freeword' => $freeword,
            'item_category_id' => $item_category_id,
            'sort_item' => 'total',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'total' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'payment_flg' => $payment_flg,
            'event_date_id' => $event_date_id,
            'event_date_flg' => $event_date_flg,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'freeword' => $freeword,
            'item_category_id' => $item_category_id,
            'sort_item' => 'total',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_btn"></div>
</div>
