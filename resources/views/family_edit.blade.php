@extends('layouts.app')

@section('content')
<div class="content_title">家族編集</div>
<form id="admin_store_form" name="danka_store_form" action="{{ route('family_update') }}" method="post">
@csrf
{{ Form::hidden('family_id', $family->id) }}
{{ Form::hidden('danka_id', $family->danka_id) }}
    <div class="danka_other_div">
        <div class="danka_other_content" style="height: 80px;">
            <div id="family_form" class="">
                <div id="family_item" class="family_item">
                    <div class="family_column">
                        <div class="danka_regist_name2">氏名</div>
                        {{ Form::text('name', $family->name, ['id' => 'family_name', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => '姓　名']) }}
                    </div>
                    <div class="family_column">
                        <div class="danka_regist_name2">フリガナ</div>
                        {{ Form::text('name_kana', $family->name_kana, ['id' => 'family_kana', 'class' => 'danka_form_text2', 'maxlength' => 20, 'placeholder' => 'フリガナ']) }}
                    </div>
                    <div class="family_column">
                        <div class="danka_regist_name2" style="width: 50px;">続柄</div>
                        {{ Form::text('relationship', $family->relationship, ['id' => 'relationship', 'class' => 'danka_form_text2', 'maxlength' => 10, 'placeholder' => '', 'style' => 'width: 100px;']) }}
                    </div>
                    <div class="family_column">
                        <div class="danka_regist_name2">電話番号</div>
                        {{ Form::text('tel', $family->tel, ['id' => 'family_tel', 'class' => 'danka_form_text2', 'maxlength' => 15, 'placeholder' => '09011112222']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>




    
    <a href="#!" onclick="clickTextStoreButton()" class="text_store_btn_a">更新</a>
</form>
<script src="{{ asset('js/family_edit.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



