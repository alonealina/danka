@extends('layouts.app')

@section('content')
<div class="user_content_title">口座追加</div>

<div class="head_title">口座追加に失敗しました.</div>
<div class="complete_text">紹介者コードが不正です.以下を確認してください.
(1)紹介者コードが正しく入力されていること (2)該当する紹介者コードに対するアフィリエイトグループが作成されていること (3)該当する紹介者コードに対応する取引プラットフォームを選択していること</div>
<a href="{{ route('index') }}" class="btn_a"><div class="btn_purple" style="margin-top:50px;">マイページTOP</div></a>

<script src="{{ asset('js/v2/transfer.js') }}"></script>
@endsection




@section('content_sp')

<div class="user_content_title">口座追加</div>

<div class="head_title_sp">口座追加に失敗しました.</div>
<div class="complete_text">紹介者コードが不正です.以下を確認してください.
(1)紹介者コードが正しく入力されていること (2)該当する紹介者コードに対するアフィリエイトグループが作成されていること (3)該当する紹介者コードに対応する取引プラットフォームを選択していること</div>
<a href="{{ route('index') }}" class="btn_a_sp"><div class="btn_purple_sp" style="margin-top:50px;">マイページTOP</div></a>

<script src="{{ asset('js/v2/transfer.js') }}"></script>
@endsection

