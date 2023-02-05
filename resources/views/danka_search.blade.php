@extends('layouts.app')

@section('content')
<div class="content_title">檀家検索</div>
<form id="form" name="search_form" action="{{ route('danka_search') }}" method="get">
@csrf
    <div class="danka_search_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">カルテナンバー</div>
                {{ Form::text('id', $id, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">施主名</div>
                {{ Form::text('name', $name, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ</div>
                {{ Form::text('name_kana', $name_kana, ['id' => 'name_kana', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">電話番号</div>
                {{ Form::text('tel', $tel, ['id' => 'tel', 'class' => 'danka_form_text', 'maxlength' => 15, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">メールアドレス</div>
                {{ Form::text('mail', $mail, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリーワード</div>
                {{ Form::text('freeword', $freeword, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>
        </div>

        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">地域</div>
                <select name="area" class="select_category" style="width: 180px" id="area">
                    <option value="">----</option>
                    @foreach (config('const.Areas') as $area_name)
                    <option value="{{ $area_name }}"
                        @if($area == $area_name) selected @endif >{{ $area_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">郵便番号</div>
                {{ Form::text('zip', $zip, ['id' => 'zip', 'class' => 'danka_form_text', 'maxlength' => 7, 'placeholder' => '0000000', 'style' => 'width: 180px',
                        'onkeyup' => "AjaxZip3.zip2addr(this, '', 'pref', 'address')"]) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">都道府県</div>
                <select name="pref" class="select_category" style="width: 180px" id="pref">
                    <option value="">----</option>
                    @foreach (config('const.Prefs') as $pref_name)
                    <option value="{{ $pref_name }}"
                        @if($pref == $pref_name) selected @endif >{{ $pref_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">住所</div>
                {{ Form::text('address', $address, ['id' => 'city', 'class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '']) }}
            </div>

            <div class="danka_column">
                <input type="checkbox" id="segaki_flg" name="segaki_flg" class="danka_checkbox" value="1"
                @if(isset($segaki_flg)) checked @endif>
                <label for="segaki_flg" class="danka_label">施餓鬼</label>
                <input type="checkbox" id="star_flg" name="star_flg" class="danka_checkbox" value="1"
                @if(isset($star_flg)) checked @endif>
                <label for="star_flg" class="danka_label">星祭り</label>
                <input type="checkbox" id="yakushiji_flg" name="yakushiji_flg" class="danka_checkbox" value="1"
                @if(isset($yakushiji_flg)) checked @endif>
                <label for="yakushiji_flg" class="danka_label">薬師寺霊園</label>
            </div>
        </div>
        <div class="search_btn_list">
            <a href="#!" onclick="clickSearchButton()" class="search_btn_a">検索</a>
            <a href="#!" onclick="clickClearButton()" class="clear_btn_a">クリア</a>
        </div>
    </div>

</form>

<div class="paginationWrap">
    <div class="pagination_div">
        表示件数　
        @include('item.danka_number')　　
        {{ $danka_list->total() }}件が該当しました
        {{ $danka_list->appends(request()->query())->links('pagination::default') }}

    </div>
    <form id="form" name="update_form" action="{{ route('danka_csv_export') }}" method="post">
        @csrf
        {{ Form::hidden('id', $id) }}
        {{ Form::hidden('name', $name) }}
        {{ Form::hidden('name_kana', $name_kana) }}
        {{ Form::hidden('tel', $tel) }}
        {{ Form::hidden('mail', $mail) }}
        {{ Form::hidden('freeword', $freeword) }}
        {{ Form::hidden('area', $area) }}
        {{ Form::hidden('zip', $zip) }}
        {{ Form::hidden('pref', $pref) }}
        {{ Form::hidden('address', $address) }}
        {{ Form::hidden('segaki_flg', $segaki_flg) }}
        {{ Form::hidden('star_flg', $star_flg) }}
        {{ Form::hidden('yakushiji_flg', $yakushiji_flg) }}
        <button class="payment_blue_btn_a">CSV出力</button>
    </form>
</div>

<div class="payment_list_header" style="margin:0;">
    <div class="payment_id">カルテナンバー</div>
    <div class="payment_name">施主名</div>
    <div class="payment_tel">電話番号</div>
    <div class="hikuyousya_address">住所</div>
    <div class="payment_btn"></div>
</div>

<div class="search_result_div" >

    @foreach ($danka_list as $danka)
    <div class="payment_list_column">
        <div class="payment_id">{{ $danka->id }}</div>
        <div class="payment_name">{{ $danka->name }}</div>
        <div class="payment_tel">{{ $danka->tel }}</div>
        <div class="hikuyousya_address">{{ $danka->pref }}</div>
        <div class="payment_btn"><a href="{{ route('danka_detail', $danka->id) }}" class="search_view_btn_a">表示</a></div>
    </div>


    @endforeach
    
</div>


    

<script src="{{ asset('js/search.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



