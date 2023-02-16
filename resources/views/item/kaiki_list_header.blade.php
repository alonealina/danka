<div class="payment_list_header" style="margin:0;">
    <div class="hikuyousya_id">カルテナンバー</div>
    <div class="hikuyousya_name">施主名</div>
    <div class="hikuyousya_zokumyo">俗名</div>
    <div class="hikuyousya_kaimyo">戒名</div>
    <div class="hikuyousya_date">
        命日
        @if ($sort_item == 'meinichi' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'meinichi_month' => $meinichi_month,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'kaiki_flg' => $kaiki_flg,
            'freeword' => $freeword,
            'item_categories' => $item_categories,
            'item_category_id' => $item_category_id,
            'hikuyousya_count' => $hikuyousya_count,
            'danka_count' => $danka_count,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'sort_item' => 'meinichi',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'meinichi' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'meinichi_month' => $meinichi_month,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'kaiki_flg' => $kaiki_flg,
            'freeword' => $freeword,
            'item_categories' => $item_categories,
            'item_category_id' => $item_category_id,
            'hikuyousya_count' => $hikuyousya_count,
            'danka_count' => $danka_count,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'sort_item' => 'meinichi',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_kaiki">回忌</div>
    <div class="hikuyousya_kaiki">発送</div>
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
            'meinichi_month' => $meinichi_month,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'kaiki_flg' => $kaiki_flg,
            'freeword' => $freeword,
            'item_categories' => $item_categories,
            'item_category_id' => $item_category_id,
            'hikuyousya_count' => $hikuyousya_count,
            'danka_count' => $danka_count,
            'category_id' => $category_id,
            'event_name' => $event_name,
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
            'meinichi_month' => $meinichi_month,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'kaiki_flg' => $kaiki_flg,
            'freeword' => $freeword,
            'item_categories' => $item_categories,
            'item_category_id' => $item_category_id,
            'hikuyousya_count' => $hikuyousya_count,
            'danka_count' => $danka_count,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'sort_item' => 'payment_date',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_kaimyo">商品カテゴリー</div>
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
            'meinichi_month' => $meinichi_month,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'kaiki_flg' => $kaiki_flg,
            'freeword' => $freeword,
            'item_categories' => $item_categories,
            'item_category_id' => $item_category_id,
            'hikuyousya_count' => $hikuyousya_count,
            'danka_count' => $danka_count,
            'category_id' => $category_id,
            'event_name' => $event_name,
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
            'meinichi_month' => $meinichi_month,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'payment_before' => $payment_before,
            'payment_after' => $payment_after,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            'yakushiji_flg' => $yakushiji_flg,
            'kaiki_flg' => $kaiki_flg,
            'freeword' => $freeword,
            'item_categories' => $item_categories,
            'item_category_id' => $item_category_id,
            'hikuyousya_count' => $hikuyousya_count,
            'danka_count' => $danka_count,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'sort_item' => 'total',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_btn"></div>
</div>
