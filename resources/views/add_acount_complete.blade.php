@extends('layouts.app')

@section('content')
<div class="user_content_title">追加口座</div>

<div class="head_title">追加口座を受け付けました。</div>
<div class="complete_text">３営業日以内に処理を致します。</div>
<a href="{{ route('index') }}" class="btn_a"><div class="btn_purple" style="margin-top:50px;">マイページTOP</div></a>

<script src="{{ asset('js/v2/add_acount.js') }}"></script>
@endsection




@section('content_sp')

<div class="user_content_title">追加口座</div>

<div class="head_title_sp">追加口座を受け付けました。</div>
<div class="complete_text">３営業日以内に処理を致します。</div>
<a href="{{ route('index') }}" class="btn_a_sp"><div class="btn_purple_sp" style="margin-top:50px;">マイページTOP</div></a>

<script src="{{ asset('js/v2/add_acount.js') }}"></script>
@endsection

