<div class="number_select">
    <select class="" name="sort" id="change_number">
        <option value="{{ route('event_regist_search', [
            'number' => '10',
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
            ]) }}"
        @if($number == "10") selected @endif>10件</option>
        <option value="{{ route('event_regist_search',  [
            'number' => '30',
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
            ]) }}"
        @if($number == "30") selected @endif>30件</option>
        <option value="{{ route('event_regist_search',  [
            'number' => '50',
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
            ]) }}"
        @if($number == "50") selected @endif>50件</option>
        <option value="{{ route('event_regist_search',  [
            'number' => '100',
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
            ]) }}"
        @if($number == "100") selected @endif>100件</option>
        <option value="{{ route('event_regist_search',  [
            'number' => '300',
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
            ]) }}"
        @if($number == "300") selected @endif>300件</option>
        <option value="{{ route('event_regist_search',  [
            'number' => '500',
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
            ]) }}"
        @if($number == "500") selected @endif>500件</option>
    </select>
</div>