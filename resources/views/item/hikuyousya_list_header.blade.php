<div class="payment_list_header" style="margin:0;">
    <div class="hikuyousya_id">カルテナンバー</div>
    <div class="hikuyousya_name">施主名</div>
    <div class="hikuyousya_type">種別</div>
    <div class="hikuyousya_zokumyo">俗名</div>
    <div class="hikuyousya_zokumyo">フリガナ</div>
    <div class="hikuyousya_kaimyo">戒名</div>
    <div class="hikuyousya_gender">性別</div>
    <div class="hikuyousya_date">
        命日
        @if ($sort_item == 'meinichi' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('hikuyousya_search', [
            'number' => $number,
            'id_before' => $id_before,
            'id_after' => $id_after,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            'sort_item' => 'meinichi',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'meinichi' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('hikuyousya_search', [
            'number' => $number,
            'id_before' => $id_before,
            'id_after' => $id_after,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            'sort_item' => 'meinichi',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_kaiki">回忌</div>
    <div class="hikuyousya_kaiki">行年</div>
    <div class="hikuyousya_ihai">
        位牌番号
        @if ($sort_item == 'ihai_no' && $sort_type == 'asc')
        <img src="{{ asset('img/up_current.png') }}" class="">
        @else
        <a href="{{ route('hikuyousya_search', [
            'number' => $number,
            'id_before' => $id_before,
            'id_after' => $id_after,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            'sort_item' => 'ihai_no',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'ihai_no' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('hikuyousya_search', [
            'number' => $number,
            'id_before' => $id_before,
            'id_after' => $id_after,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
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
        <a href="{{ route('hikuyousya_search', [
            'number' => $number,
            'id_before' => $id_before,
            'id_after' => $id_after,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            'sort_item' => 'nokotsubi',
            'sort_type' => 'asc',
            ]) }}" class="sort_a"><img src="{{ asset('img/up.png') }}" class="">
        </a>
        @endif

        @if ($sort_item == 'nokotsubi' && $sort_type == 'desc')
        <img src="{{ asset('img/down_current.png') }}" class="">
        @else
        <a href="{{ route('hikuyousya_search', [
            'number' => $number,
            'id_before' => $id_before,
            'id_after' => $id_after,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'nokotsubi_before' => $nokotsubi_before,
            'nokotsubi_after' => $nokotsubi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'henjokaku1' => $henjokaku1,
            'henjokaku2' => $henjokaku2,
            'henjokaku3' => $henjokaku3,
            'henjokaku4' => $henjokaku4,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            'sort_item' => 'nokotsubi',
            'sort_type' => 'desc',
            ]) }}" class="sort_a"><img src="{{ asset('img/down.png') }}" class="">
        </a>
        @endif

    </div>
    <div class="hikuyousya_kaimyo">遍照閣</div>
    <div class="hikuyousya_btn"></div>
</div>