<div class="number_select">
    <select class="" name="sort" id="change_number">
        <option value="{{ route('hikuyousya_search', [
            'number' => '10',
            'danka_id' => $danka_id,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            ]) }}"
        @if($number == "10") selected @endif>10件</option>
        <option value="{{ route('hikuyousya_search',  [
            'number' => '30',
            'danka_id' => $danka_id,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            ]) }}"
        @if($number == "30") selected @endif>30件</option>
        <option value="{{ route('hikuyousya_search',  [
            'number' => '50',
            'danka_id' => $danka_id,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            ]) }}"
        @if($number == "50") selected @endif>50件</option>
        <option value="{{ route('hikuyousya_search',  [
            'number' => '100',
            'danka_id' => $danka_id,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            ]) }}"
        @if($number == "100") selected @endif>100件</option>
        <option value="{{ route('hikuyousya_search',  [
            'number' => '300',
            'danka_id' => $danka_id,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            ]) }}"
        @if($number == "300") selected @endif>300件</option>
        <option value="{{ route('hikuyousya_search',  [
            'number' => '500',
            'danka_id' => $danka_id,
            'name' => $name,
            'name_kana' => $name_kana,
            'type' => $type,
            'common_name' => $common_name,
            'common_kana' => $common_kana,
            'posthumous' => $posthumous,
            'freeword' => $freeword,
            'meinichi_before' => $meinichi_before,
            'meinichi_after' => $meinichi_after,
            'kaiki_before' => $kaiki_before,
            'kaiki_after' => $kaiki_after,
            'ihai_no' => $ihai_no,
            'ihai_flg' => $ihai_flg,
            'konryu_flg' => $konryu_flg,
            'kaiki_flg' => $kaiki_flg,
            ]) }}"
        @if($number == "500") selected @endif>500件</option>
    </select>
</div>