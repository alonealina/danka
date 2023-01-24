@extends('layouts.app')

@section('content')
<div class="content_title">商品編集</div>
<form id="admin_store_form" name="item_store_form" action="{{ route('item_update') }}" method="post">
@csrf
{{ Form::hidden('id', $item->id) }}
    <div class="danka_other_div">
        <div class="danka_other_content" style="height: 80px;">
            <div id="family_form" class="">
                <div id="family_item" class="family_item">
                    <div class="family_column">
                        <div class="danka_regist_name2">カテゴリ</div>
                        <select name="category_id" class="select_category" style="width: 200px; margin-right:10px;">
                            @foreach ($item_categories as $category)
                                <option value="{{ $category->id }}" 
                                @if(old('category_id') == $category->id) selected 
                                @elseif($item->category_id == $category->id) selected 
                                @endif >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="family_column">
                        <div class="danka_regist_name2">詳細</div>
                        {{ Form::text('detail', $item->detail, ['id' => 'detail', 'class' => 'item_name_text', 'maxlength' => 20, 'placeholder' => '詳細']) }}

                    </div>
                    <div class="family_column">
                        <div class="danka_regist_name2">単価</div>
                        {{ Form::text('price', $item->price, ['id' => 'price', 'class' => 'item_name_text', 'maxlength' => 7, 'placeholder' => '単価']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="error_message check_error" style="text-align:center; margin-bottom:10px;">{{ $errors->first('detail') }}</div>

    
    <a href="#!" onclick="itemStoreButton()" class="text_store_btn_a">編集</a>
</form>
<script src="{{ asset('js/item_list.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



