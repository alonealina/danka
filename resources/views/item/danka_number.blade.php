<div class="number_select">
    <select class="" name="sort" id="change_number">
        <option value="{{ route('danka_search', [
            'number' => '10',
            'category_id' => $category_id,
            'id' => $id,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'mail' => $mail,
            'freeword' => $freeword,
            'area' => $area,
            'zip' => $zip,
            'pref' => $pref,
            'address' => $address,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            ]) }}"
        @if($number == "10") selected @endif>10件</option>
        <option value="{{ route('danka_search',  [
            'number' => '30',
            'category_id' => $category_id,
            'id' => $id,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'mail' => $mail,
            'freeword' => $freeword,
            'area' => $area,
            'zip' => $zip,
            'pref' => $pref,
            'address' => $address,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            ]) }}"
        @if($number == "30") selected @endif>30件</option>
        <option value="{{ route('danka_search',  [
            'number' => '50',
            'category_id' => $category_id,
            'id' => $id,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'mail' => $mail,
            'freeword' => $freeword,
            'area' => $area,
            'zip' => $zip,
            'pref' => $pref,
            'address' => $address,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            ]) }}"
        @if($number == "50") selected @endif>50件</option>
        <option value="{{ route('danka_search',  [
            'number' => '100',
            'category_id' => $category_id,
            'id' => $id,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'mail' => $mail,
            'freeword' => $freeword,
            'area' => $area,
            'zip' => $zip,
            'pref' => $pref,
            'address' => $address,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            ]) }}"
        @if($number == "100") selected @endif>100件</option>
        <option value="{{ route('danka_search',  [
            'number' => '300',
            'category_id' => $category_id,
            'id' => $id,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'mail' => $mail,
            'freeword' => $freeword,
            'area' => $area,
            'zip' => $zip,
            'pref' => $pref,
            'address' => $address,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            ]) }}"
        @if($number == "300") selected @endif>300件</option>
        <option value="{{ route('danka_search',  [
            'number' => '500',
            'category_id' => $category_id,
            'id' => $id,
            'name' => $name,
            'name_kana' => $name_kana,
            'tel' => $tel,
            'mail' => $mail,
            'freeword' => $freeword,
            'area' => $area,
            'zip' => $zip,
            'pref' => $pref,
            'address' => $address,
            'segaki_flg' => $segaki_flg,
            'star_flg' => $star_flg,
            ]) }}"
        @if($number == "500") selected @endif>500件</option>
    </select>
</div>