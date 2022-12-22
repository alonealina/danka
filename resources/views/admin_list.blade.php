@extends('layouts.app')

@section('content')
<div class="content_title">管理者一覧</div>

<div class="content_flex">
    <div class="admin_user_list">
        <div class="admin_user_header">
            <div class="admin_user_id">ID</div>
            <div class="admin_user_name">名前</div>
            <div class="admin_user_date">追加日</div>
            <div class="admin_user_date">最終ログイン</div>
            <div class="admin_user_btn"></div>
        </div>
        @foreach($admin_users as $user)
        <div class="admin_user_column">
            <div class="admin_user_id">{{ $user->login_id }}</div>
            <div class="admin_user_name">{{ $user->name }}</div>
            <div class="admin_user_date">{{ $user->created_at }}</div>
            <div class="admin_user_date">{{ $user->max_time }}</div>
            <div class="admin_user_btn">
                @if ($user === reset($admin_users))
                <a href="#!" id="log_btn_{{ $user->user_id }}" onclick="clickLogButton({{ $user->user_id }})" class="log_view_btn_a current_log_btn">表示中</a>
                @else
                <a href="#!" id="log_btn_{{ $user->user_id }}" onclick="clickLogButton({{ $user->user_id }})" class="log_view_btn_a">表示</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="login_log_list_div">
        <div class="login_log_header">ログイン履歴</div>
        <div class="login_log_list">
        @foreach($admin_users as $user)
            <div class="log_list @if ($user === reset($admin_users)) log_list_current @endif" id="log_list_{{ $user->user_id }}">
                @foreach($login_logs as $log)
                    @if($log->login_id == $user->login_id)
                    <div class="login_log_column">{{ $log->login_time }}</div>
                    @endif
                @endforeach
            </div>
        @endforeach
        </div>
    </div>

</div>


<script src="{{ asset('js/admin_list.js') }}"></script>

@endsection



