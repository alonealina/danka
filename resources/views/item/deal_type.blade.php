<div class="payment_btn_list" style="margin:0 20px 0 0; width:350px;">
    @if ($type == "すべて")
    <div class="payment_btn_div">すべて</div>
    @else
    <a href="{{ route('deal_list', [
            'type' => 'すべて',
            ]) }}"
            class="payment_btn_a">すべて</a>
    @endif

    @if ($type == "送付待ち")
    <div class="payment_btn_div" style="border-left: 1px solid;">送付待ち</div>
    @else
    <a href="{{ route('deal_list', [
            'type' => '送付待ち',
            ]) }}"
            class="payment_btn_a" style="border-left: 1px solid;">送付待ち</a>
    @endif

    @if ($type == "未払い")
    <div class="payment_btn_div" style="border-left: 1px solid;border-right: 1px solid;">未払い</div>
    @else
    <a href="{{ route('deal_list', [
            'type' => '未払い',
            ]) }}"
            class="payment_btn_a" style="border-left: 1px solid;border-right: 1px solid;">未払い</a>
    @endif

    @if ($type == "支払済")
        <div class="payment_btn_div">支払済</div>
    @else
    <a href="{{ route('deal_list', [
            'type' => '支払済',
            ]) }}"
            class="payment_btn_a">支払済</a>
    @endif

</div>