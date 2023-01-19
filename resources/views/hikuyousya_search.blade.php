@extends('layouts.app')

@section('content')
<div class="content_title">被供養者検索</div>
<form id="form" name="search_form" action="{{ route('danka_search') }}" method="get">
@csrf
    <div class="danka_search_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">カルテナンバー</div>
                {{ Form::text('danka_id', $danka_id, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">施主名</div>
                {{ Form::text('name', $name, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ(施主名)</div>
                {{ Form::text('name_kana', $name_kana, ['id' => 'name_kana', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">種別</div>
                <select name="type" class="select_category" style="width: 80px;">
                    <option value="故人" @if($type == '故人') selected @endif >故人</option>
                    <option value="ペット" @if($type == 'ペット') selected @endif >ペット</option>
                    <option value="水子" @if($type == '水子') selected @endif >水子</option>
                    <option value="先祖" @if($type == '先祖') selected @endif >先祖</option>
                    <option value="生前" @if($type == '生前') selected @endif >生前</option>
                </select>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">俗名</div>
                {{ Form::text('common_name', $common_name, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ(俗名)</div>
                {{ Form::text('common_kana', $common_kana, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">戒名</div>
                {{ Form::text('posthumous', $posthumous, ['class' => 'danka_form_text', 'maxlength' => 50, 'placeholder' => '']) }}
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
                    @foreach (config('const.Areas') as $name)
                    <option value="{{ $name }}"
                        @if($area == $name) selected @endif >{{ $name }}</option>
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
                    @foreach (config('const.Areas') as $name)
                    <option value="{{ $name }}"
                        @if($pref == $name) selected @endif >{{ $name }}</option>
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
            </div>
        </div>
        <div class="search_btn_list">
            <a href="#!" onclick="clickSearchButton()" class="search_btn_a">検索</a>
            <a href="#!" onclick="clickClearButton()" class="clear_btn_a">クリア</a>
        </div>
    </div>

    <div class="paginationWrap">
        <div class="">
            表示件数　
            {{ $danka_list->total() }}件が該当しました
            {{ $danka_list->appends(request()->query())->links('pagination::default') }}
    
        </div>
    </div>

    <div class="search_result_div">
        <div class="payment_list_header" style="margin:0;">
            <div class="payment_id">カルテナンバー</div>
            <div class="payment_name">施主名</div>
            <div class="payment_num">識別番号</div>
            <div class="payment_tel">電話番号</div>
            <div class="payment_address">住所</div>
            <div class="payment_btn"></div>
        </div>

        @foreach ($danka_list as $danka)
        <div class="payment_list_column">
            <div class="payment_id">{{ $danka->id }}</div>
            <div class="payment_name">{{ $danka->name }}</div>
            <div class="payment_num">111-1111</div>
            <div class="payment_tel">090-583-5083</div>
            <div class="payment_address">{{ $danka->pref }}</div>
            <div class="payment_btn"><a href="" class="search_view_btn_a">表示</a></div>
        </div>


        @endforeach
        
    </div>


    

</form>
<script src="{{ asset('js/search.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



