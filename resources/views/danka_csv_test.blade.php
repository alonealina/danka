@extends('layouts.app')

@section('content')
<div class="content_title">CSVテスト</div>

<form id="form" name="regist_form" action="{{ route('danka_csv_import') }}" method="post" enctype="multipart/form-data">
@csrf
    <input type="file" id="file_btn_main" onclick="fileCheckMain();" name="csv">
    <a href="#!" onclick="ShipmentStoreButton()" class="add_btn_a">アップロード</a>
</form>



<script src="{{ asset('js/danka_csv_test.js') }}"></script>

@endsection



