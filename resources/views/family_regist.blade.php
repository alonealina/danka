@extends('layouts.app')

@section('content')
<div class="content_title">家族追加</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('family_store') }}" method="post">
@csrf
{{ Form::hidden('danka_id', $danka_id) }}
    <div class="danka_other_div">
        <div class="danka_other_content" style="height: 250px;">
            <div id="family_form" class="danka_family_content">
                <a href="#!" onclick="clickAddButton()" class="family_add_btn">＋</a>
                <div id="family_item" class="family_item">
                    <div class="family_column">
                        <div class="danka_regist_name2">氏名</div>
                        {{ Form::text('family_name[]', old('family_name'), ['id' => 'family_name', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
                    </div>
                    <div class="family_column">
                        <div class="danka_regist_name2">フリガナ</div>
                        {{ Form::text('family_kana[]', old('family_kana'), ['id' => 'family_kana', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => 'フリガナ']) }}
                    </div>
                    <div class="family_column">
                        <div class="danka_regist_name2" style="width: 50px;">続柄</div>
                        {{ Form::text('relationship[]', old('relationship'), ['id' => 'relationship', 'class' => 'danka_form_text2', 'maxlength' => 10, 'placeholder' => '', 'style' => 'width: 100px;']) }}
                    </div>
                    <div class="family_column">
                        <div class="danka_regist_name2">電話番号</div>
                        {{ Form::text('family_tel[]', old('family_tel'), ['id' => 'family_tel', 'class' => 'danka_form_text2', 'maxlength' => 15, 'placeholder' => '09011112222']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>




    
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">作成</a>
</form>
<script src="{{ asset('js/family_regist.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



