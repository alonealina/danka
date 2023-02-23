@extends('layouts.app')

@section('content')
<div class="content_title">被供養者検索</div>
<form id="form" name="search_form" action="{{ route('hikuyousya_search') }}" method="get">
@csrf
    <div class="danka_search_div">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">カルテナンバー</div>
                {{ Form::text('danka_id', $danka_id, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">施主名</div>
                {{ Form::text('name', $name, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ(施主名)</div>
                {{ Form::text('name_kana', $name_kana, ['id' => 'name_kana', 'class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => 'セイ　メイ']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">種別</div>
                <select name="type" class="select_category" style="width: 80px;">
                    <option value="">----</option>
                    <option value="故人" @if($type == '故人') selected @endif >故人</option>
                    <option value="ペット" @if($type == 'ペット') selected @endif >ペット</option>
                    <option value="水子" @if($type == '水子') selected @endif >水子</option>
                    <option value="先祖" @if($type == '先祖') selected @endif >先祖</option>
                    <option value="生前" @if($type == '生前') selected @endif >生前</option>
                </select>
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">俗名</div>
                {{ Form::text('common_name', $common_name, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリガナ(俗名)</div>
                {{ Form::text('common_kana', $common_kana, ['class' => 'danka_form_text', 'maxlength' => 20, 'placeholder' => 'セイ　メイ']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">戒名</div>
                {{ Form::text('posthumous', $posthumous, ['class' => 'danka_form_text', 'maxlength' => 50, 'placeholder' => '']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">フリーワード</div>
                {{ Form::text('freeword', $freeword, ['class' => 'danka_form_text', 'maxlength' => 100, 'placeholder' => '骨のぼり']) }}
            </div>
        </div>

        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_regist_name">納骨日</div>
                {{ Form::date('nokotsubi_before', $nokotsubi_before, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}　～　
                {{ Form::date('nokotsubi_after', $nokotsubi_after, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}
            </div>
            <div class="danka_column">
                <div class="danka_regist_name">命日</div>
                {{ Form::date('meinichi_before', $meinichi_before, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}　～　
                {{ Form::date('meinichi_after', $meinichi_after, ['class' => 'danka_form_text2', 'placeholder' => '', 'style' => 'width: 110px;']) }}
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">年忌</div>
                <select name="kaiki_before" class="select_category" style="width: 80px;">
                    <option value="">----</option>
                    <option value="1" @if($kaiki_before == '1') selected @endif >1</option>
                    @for ($i = 3; $i <= 50; $i++)
                    <option value="{{ $i }}" @if($kaiki_before == $i) selected @endif >{{ $i }}</option>
                    @endfor
                </select>　～　
                <select name="kaiki_after" class="select_category" style="width: 80px;">
                    <option value="">----</option>
                    <option value="1" @if($kaiki_after == '1') selected @endif >1</option>
                    @for ($i = 3; $i <= 50; $i++)
                    <option value="{{ $i }}" @if($kaiki_after == $i) selected @endif >{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">位牌番号</div>
                {{ Form::text('ihai_no', $ihai_no, ['class' => 'danka_form_text', 'maxlength' => 4, 'placeholder' => '']) }}
            </div>

            <div class="danka_column">
                <div class="danka_regist_name">遍照閣</div>
                <select name="henjokaku1" class="select_category" style="width: 80px;" id="henjokaku1">
                    <option value="">----</option>
                    <option value="紫雲の間" @if($henjokaku1 == '紫雲の間') selected @endif>紫雲の間</option>
                    <option value="金剛の間" @if($henjokaku1 == '金剛の間') selected @endif>金剛の間</option>
                    <option value="登天の間" @if($henjokaku1 == '登天の間') selected @endif>登天の間</option>
                    <option value="萬燈の間" @if($henjokaku1 == '萬燈の間') selected @endif>萬燈の間</option>
                    <option value="宝珠の間" @if($henjokaku1 == '宝珠の間') selected @endif>宝珠の間</option>
                    <option value="心蓮の間" @if($henjokaku1 == '心蓮の間') selected @endif>心蓮の間</option>
                    <option value="精薫の間" @if($henjokaku1 == '精薫の間') selected @endif>精薫の間</option>
                </select>

                <select name="henjokaku2" class="select_category" style="width: 60px;" id="henjokaku2">
                    <option value="">----</option>
                    <option value="円内" @if($henjokaku2 == '円内') selected @endif>円内</option>
                    <option value="円外" @if($henjokaku2 == '円外') selected @endif>円外</option>
                    <option value="正面" @if($henjokaku2 == '正面') selected @endif>正面</option>
                    @for ($i = 2; $i <= 10; $i++)
                    <option value="{{ $i }}列" @if($henjokaku2 == $i . '列') selected @endif>{{ $i }}列</option>
                    @endfor
                </select>

                <select name="henjokaku3" class="select_category" style="width: 50px;" id="henjokaku3">
                    <option value="">----</option>
                    @for ($i = 1; $i <= 94; $i++)
                    <option value="{{ $i }}" @if($henjokaku3 == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>

                <select name="henjokaku4" class="select_category" style="width: 50px;" id="henjokaku4">
                    <option value="">----</option>
                    <option value="A" @if($henjokaku4 == 'A') selected @endif>A</option>
                    <option value="B" @if($henjokaku4 == 'B') selected @endif>B</option>
                    <option value="C" @if($henjokaku4 == 'C') selected @endif>C</option>
                    <option value="D" @if($henjokaku4 == 'D') selected @endif>D</option>
                    <option value="E" @if($henjokaku4 == 'E') selected @endif>E</option>
                    <option value="F" @if($henjokaku4 == 'F') selected @endif>F</option>
                    <option value="G" @if($henjokaku4 == 'G') selected @endif>G</option>
                    <option value="H" @if($henjokaku4 == 'H') selected @endif>H</option>
                    <option value="I" @if($henjokaku4 == 'I') selected @endif>I</option>
                    <option value="J" @if($henjokaku4 == 'J') selected @endif>J</option>
                    <option value="K" @if($henjokaku4 == 'K') selected @endif>K</option>
                    <option value="L" @if($henjokaku4 == 'L') selected @endif>L</option>
                </select>
                　<input type="checkbox" id="konryu_flg" name="konryu_flg" class="danka_checkbox" value="1"
                @if(isset($konryu_flg)) checked @endif>
            </div>

            <div class="danka_column">
                <input type="checkbox" id="ihai_flg" name="ihai_flg" class="danka_checkbox" value="1"
                @if(isset($ihai_flg)) checked @endif>
                <label for="ihai_flg" class="danka_label">位牌</label>
                <input type="checkbox" id="kaiki_flg" name="kaiki_flg" class="danka_checkbox" value="1"
                @if(isset($kaiki_flg)) checked @endif>
                <label for="kaiki_flg" class="danka_label">回忌</label>
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
        @include('item.hikuyousya_number')　　
        {{ $danka_list->total() }}件が該当しました
        {{ $danka_list->appends(request()->query())->links('pagination::default') }}

    </div>
    <form id="form" name="update_form" action="{{ route('hikuyousya_csv_export') }}" method="post">
        @csrf
        {{ Form::hidden('danka_id', $danka_id) }}
        {{ Form::hidden('name', $name) }}
        {{ Form::hidden('name_kana', $name_kana) }}
        {{ Form::hidden('type', $type) }}
        {{ Form::hidden('common_name', $common_name) }}
        {{ Form::hidden('common_kana', $common_kana) }}
        {{ Form::hidden('posthumous', $posthumous) }}
        {{ Form::hidden('freeword', $freeword) }}
        {{ Form::hidden('nokotsubi_before', $nokotsubi_before) }}
        {{ Form::hidden('nokotsubi_after', $nokotsubi_after) }}
        {{ Form::hidden('meinichi_before', $meinichi_before) }}
        {{ Form::hidden('meinichi_after', $meinichi_after) }}
        {{ Form::hidden('kaiki_before', $kaiki_before) }}
        {{ Form::hidden('kaiki_after', $kaiki_after) }}
        {{ Form::hidden('ihai_no', $ihai_no) }}
        {{ Form::hidden('ihai_flg', $ihai_flg) }}
        {{ Form::hidden('konryu_flg', $konryu_flg) }}
        {{ Form::hidden('kaiki_flg', $kaiki_flg) }}
        {{ Form::hidden('sort_item', $sort_item) }}
        {{ Form::hidden('sort_type', $sort_type) }}
        <button class="payment_blue_btn_a" onclick="return confirm('{{ $danka_list->total() }}件出力しますがよろしいですか？')" >CSV出力</button>
    </form>
</div>

@include('item.hikuyousya_list_header')



<div class="search_result_div" style="height: 240px;">

    @foreach ($danka_list as $danka)
    <div class="payment_list_column">
        <div class="hikuyousya_id">{{ $danka->danka_id }}</div>
        <div class="hikuyousya_name">{{ $danka->name }}</div>
        <div class="hikuyousya_type">{{ $danka->type }}</div>
        <div class="hikuyousya_zokumyo">{{ $danka->common_name }}</div>
        <div class="hikuyousya_zokumyo">{{ $danka->common_kana }}</div>
        <div class="hikuyousya_kaimyo">{{ $danka->posthumous }}</div>
        <div class="hikuyousya_gender">@if($danka->gender_h == 'm') 男 @elseif($danka->gender_h == 'f') 女 @else その他 @endif</div>
        <div class="hikuyousya_date">{{ $danka->meinichi }}</div>
        <div class="hikuyousya_kaiki">@if($danka->kaiki <= 0) 1 @else {{ $danka->kaiki + 2 }} @endif</div>
        <div class="hikuyousya_kaiki">{{ $danka->gyonen }}</div>
        <div class="hikuyousya_ihai">{{ $danka->ihai_no }}</div>
        <div class="hikuyousya_date">{{ $danka->nokotsubi }}</div>
        <div class="hikuyousya_kaimyo">{{ $danka->henjokaku1 }}{{ $danka->henjokaku2 }}{{ $danka->henjokaku3 }}{{ $danka->henjokaku4 }}</div>
        <div class="hikuyousya_btn"><a href="{{ route('danka_detail', $danka->danka_id) }}" class="search_view_btn_a">表示</a></div>
    </div>


    @endforeach
    
</div>





<script src="{{ asset('js/search.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



