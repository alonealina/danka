<div class="number_select">
    <select class="" name="sort" id="change_number">
        <option value="{{ route('deal_list', [
            'number' => '10',
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
            'sort_item' => $sort_item,
            'sort_type' => $sort_type,
            'type' => $type,
            ]) }}"
        @if($number == "10") selected @endif>10件</option>
        <option value="{{ route('deal_list',  [
            'number' => '30',
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
            'sort_item' => $sort_item,
            'sort_type' => $sort_type,
            'type' => $type,
            ]) }}"
        @if($number == "30") selected @endif>30件</option>
        <option value="{{ route('deal_list',  [
            'number' => '50',
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
            'sort_item' => $sort_item,
            'sort_type' => $sort_type,
            'type' => $type,
            ]) }}"
        @if($number == "50") selected @endif>50件</option>
        <option value="{{ route('deal_list',  [
            'number' => '100',
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
            'sort_item' => $sort_item,
            'sort_type' => $sort_type,
            'type' => $type,
            ]) }}"
        @if($number == "100") selected @endif>100件</option>
        <option value="{{ route('deal_list',  [
            'number' => '300',
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
            'sort_item' => $sort_item,
            'sort_type' => $sort_type,
            'type' => $type,
            ]) }}"
        @if($number == "300") selected @endif>300件</option>
        <option value="{{ route('deal_list',  [
            'number' => '500',
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
            'sort_item' => $sort_item,
            'sort_type' => $sort_type,
            'type' => $type,
            ]) }}"
        @if($number == "500") selected @endif>500件</option>
    </select>
</div>