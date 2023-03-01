@extends('layouts.app')

@section('content')
<div class="admin_list_message">{{ session('message') }}</div>
<div class="content_title">被供養者CSVテスト</div>

<form id="form" name="regist_form" action="{{ route('hikuyousya_csv_import') }}" method="post" enctype="multipart/form-data">
@csrf
    <input type="file" id="file_btn_main" onclick="fileCheckMain();" name="csv">
    <a href="#!" onclick="ShipmentStoreButton()" class="add_btn_a">アップロード</a>
</form>



<script src="{{ asset('js/danka_csv_test.js') }}"></script>

@endsection



