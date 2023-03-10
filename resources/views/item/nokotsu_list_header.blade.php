<div class="payment_list_header" style="margin:0;">
    <div class="hikuyousya_id">カルテナンバー</div>
    <div class="hikuyousya_name">施主名</div>
    <div class="hikuyousya_zokumyo">俗名</div>
    <div class="hikuyousya_kaimyo">戒名</div>
    <div class="hikuyousya_ihai">
        位牌番号
        @if ($sort_item == 'ihai_no' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'freeword' => $freeword,
            'sort_item' => 'ihai_no',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'ihai_no' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'freeword' => $freeword,
            'sort_item' => 'ihai_no',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_date">
        納骨日
        @if ($sort_item == 'nokotsubi' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'freeword' => $freeword,
            'sort_item' => 'nokotsubi',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'nokotsubi' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'freeword' => $freeword,
            'sort_item' => 'nokotsubi',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif


    </div>
    <div class="hikuyousya_date">
        納骨移動日
        @if ($sort_item == 'nokotsuidobi' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'freeword' => $freeword,
            'sort_item' => 'nokotsuidobi',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'nokotsuidobi' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'freeword' => $freeword,
            'sort_item' => 'nokotsuidobi',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_ihai">
        納骨番号
        @if ($sort_item == 'nokotsu_no' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'freeword' => $freeword,
            'sort_item' => 'nokotsu_no',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'nokotsu_no' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('event_regist_search', [
            'number' => $number,
            'category_id' => $category_id,
            'event_name' => $event_name,
            'category_name' => $category_name,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'freeword' => $freeword,
            'sort_item' => 'nokotsu_no',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif


    </div>
    <div class="hikuyousya_zokumyo">遍照閣</div>
    <div class="hikuyousya_kaimyo">特記事項</div>
    <div class="hikuyousya_btn"></div>
</div>