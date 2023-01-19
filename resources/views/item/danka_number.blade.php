<div class="number_select">
    <select class="" name="sort" id="change_number">
        <option value="{{ route('danka_search', [
            'number' => '5',
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
        @if($number == "5") selected @endif>5件</option>
        <option value="{{ route('danka_search', [
            'number' => '10',
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