@extends('layouts.app')

@section('content')
<div class="content_title">檀家詳細</div>
<div class="admin_list_message">{{ session('message') }}</div>

    <div class="danka_regist_div" style="padding:0;">
        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_detail_name">カルテナンバー</div>
                {{ $danka->id }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">施主名</div>
                {{ $danka->name }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">フリガナ</div>
                {{ $danka->name_kana }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">性別</div>
                @if($danka->gender == 'm') 男 @elseif($danka->gender == 'f') 女 @else その他 @endif
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">電話番号</div>
                {{ $danka->tel }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">携帯番号</div>
                {{ $danka->mobile }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">メールアドレス</div>
                {{ $danka->mail }}
            </div>
            <div class="danka_column">
                <div class="@if($danka->segaki_flg) search_btn_a @else clear_btn_a @endif">施餓鬼</div>
                <div class="@if($danka->star_flg) search_btn_a @else clear_btn_a @endif">星祭り</div>
                <div class="@if($danka->yakushiji_flg) search_btn_a @else clear_btn_a @endif">薬師寺霊園</div>
            </div>


        </div>

        <div class="danka_form_div">
            <div class="danka_column">
                <div class="danka_detail_name">郵便番号</div>
                {{ $danka->zip }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">都道府県</div>
                {{ $danka->pref }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">住所</div>
                {{ $danka->city }}{{ $danka->address }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">マンション等</div>
                {{ $danka->building }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">紹介者</div>
                {{ $danka->introducer }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">特記事項</div>
                <div class="danka_notices">{{ $danka->notices }}</div>
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">登録日</div>
                {{ $danka->created_at }}
            </div>
            <div class="danka_column">
                <div class="danka_detail_name">最終更新日</div>
                {{ $danka->updated_at }}
            </div>

        </div>
    </div>
    <div class="danka_column">
        <a href="{{ route('danka_edit', $danka->id) }}" class="create_btn_a">檀家編集</a>
        <a href="{{ route('hikuyousya_regist', $danka->id) }}" class="create_btn_a">被供養者追加</a>
        <a href="{{ route('family_regist', $danka->id) }}" class="create_btn_a">家族情報追加</a>
    </div>

    <div class="danka_other_div">
        <div class="danka_other_tab">
            <a href="#!" id="hikuyousya" onclick="clickHikuyousya()" class="danka_tab danka_current">被供養者</a>
            <a href="#!" id="family" onclick="clickFamily()" class="danka_tab">家族情報</a>
            <a href="#!" id="payment" onclick="clickPayment()" class="danka_tab">支払い履歴</a>
            <div class="danka_space"></div>
        </div>
        <div class="danka_other_content" style="height: 300px;">
            <div class="payment_list_header" style="margin:0;">
                <div class="hikuyousya_type">種別</div>
                <div class="hikuyousya_zokumyo">俗名</div>
                <div class="hikuyousya_zokumyo">フリガナ</div>
                <div class="hikuyousya_kaimyo">戒名</div>
                <div class="hikuyousya_gender">性別</div>
                <div class="hikuyousya_date">命日</div>
                <div class="hikuyousya_kaiki">回忌</div>
                <div class="hikuyousya_kaiki">行年</div>
                <div class="hikuyousya_ihai">位牌番号</div>
                <div class="hikuyousya_date">建立日</div>
                <div class="hikuyousya_kaimyo">特記事項</div>
                <div class="hikuyousya_btn"></div>
            </div>
            <div class="search_result_div" style="height: 240px;">
                @foreach ($hikuyousya_list as $hikuyousya)
                <div class="payment_list_column">
                    <div class="hikuyousya_type">{{ $hikuyousya->type }}</div>
                    <div class="hikuyousya_zokumyo">{{ $hikuyousya->common_name }}</div>
                    <div class="hikuyousya_zokumyo">{{ $hikuyousya->common_kana }}</div>
                    <div class="hikuyousya_kaimyo_view">{{ $hikuyousya->posthumous }}</div>
                    <div class="hikuyousya_gender">@if($hikuyousya->gender_h == 'm') 男 @elseif($hikuyousya->gender_h == 'f') 女 @else その他 @endif</div>
                    <div class="hikuyousya_date">{{ $hikuyousya->meinichi }}</div>
                    <div class="hikuyousya_kaiki">@if($hikuyousya->kaiki <= 0) 1 @else {{ $hikuyousya->kaiki + 2 }} @endif</div>
                    <div class="hikuyousya_kaiki">{{ $hikuyousya->gyonen }}</div>
                    <div class="hikuyousya_ihai">{{ $hikuyousya->ihai_no }}</div>
                    <div class="hikuyousya_date">{{ $hikuyousya->konryubi }}</div>
                    <div class="hikuyousya_kaimyo_view">{{ $hikuyousya->column }}</div>
                    <div class="hikuyousya_btn"><a href="{{ route('hikuyousya_edit', $hikuyousya->id) }}" class="search_view_btn_a">編集</a></div>
                </div>
                @endforeach
            </div>
        </div>

        <div id="family_form" class="danka_family_content_view" style="display:none;">
            <div class="payment_list_header" style="margin:0;">
                <div class="family_view_column">
                    <div class="family_view_item">氏名</div>
                    <div class="family_view_item">フリガナ</div>
                    <div class="family_view_item">続柄</div>
                    <div class="family_view_item">電話番号</div>
                </div>
                <div class="hikuyousya_btn"></div>
            </div>
            <div class="search_result_div" style="height: 240px;">
                @foreach ($family_list as $family)
                <div class="payment_list_column">
                    <div class="family_view_column">
                        <div class="family_view_item">{{ $family->name }}</div>
                        <div class="family_view_item">{{ $family->name_kana }}</div>
                        <div class="family_view_item">{{ $family->relationship }}</div>
                        <div class="family_view_item">{{ $family->tel }}</div>
                    </div>
                    <div class="hikuyousya_btn"><a href="{{ route('family_edit', $family->id) }}" class="search_view_btn_a">編集</a></div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="danka_payment_view" style="display:none;">


        </div>
    </div>


<script src="{{ asset('js/danka_detail.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



