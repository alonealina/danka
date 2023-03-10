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
            <a href="#!" id="gojikaihi" onclick="clickGojikaihi()" class="danka_tab">護持会費</a>
            <a href="#!" id="payment" onclick="clickPayment()" class="danka_tab">支払い履歴</a>
            <a href="#!" id="nenki" onclick="clickNenki()" class="danka_tab">年忌</a>
            <a href="#!" id="star" onclick="clickStar()" class="danka_tab">星祭り</a>
            <a href="#!" id="segaki" onclick="clickSegaki()" class="danka_tab">施餓鬼</a>
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
                <div class="hikuyousya_kaiki">発送</div>
                <div class="hikuyousya_kaiki">行年</div>
                <div class="hikuyousya_ihai">位牌番号</div>
                <div class="hikuyousya_date">納骨日</div>
                <div class="hikuyousya_zokumyo">遍照閣</div>
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
                    <div class="hikuyousya_kaiki">@if($hikuyousya->kaiki_flg) ✓ @endif</div>
                    <div class="hikuyousya_kaiki">{{ $hikuyousya->gyonen }}</div>
                    <div class="hikuyousya_ihai">{{ $hikuyousya->ihai_no }}</div>
                    <div class="hikuyousya_date">{{ $hikuyousya->nokotsubi }}</div>
                    <div class="hikuyousya_zokumyo">{{ $hikuyousya->henjokaku1 }}{{ $hikuyousya->henjokaku2 }}{{ $hikuyousya->henjokaku3 }}{{ $hikuyousya->henjokaku4 }}</div>
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

        <div class="danka_gojikaihi_content" style="height: 300px; display:none;">
            <form id="admin_store_form" name="gojikaihi_form" action="{{ route('gojikaihi_update') }}" method="post">
            {{ Form::hidden('danka_id', $danka->id) }}
            @csrf
                <div class="payment_list_header" style="margin:0; justify-content: unset;">
                    <div style="width:40px"></div>
                    <div class="hikuyousya_zokumyo">俗名</div>
                    <div class="hikuyousya_zokumyo">遍照閣</div>
                    <div class="hikuyousya_zokumyo">金額</div>
                </div>
                <div class="search_result_div" style="height: 220px;">
                    @foreach ($gojikaihi_list as $gojikaihi)
                    <div class="payment_list_column" style="justify-content: unset;">
                        <input type="hidden" name="gojikaihi_flg[{{ $gojikaihi->id }}]" value="0">    
                        <div style="width:40px"><input type="checkbox" id="segaki_flg" name="gojikaihi_flg[{{ $gojikaihi->id }}]" class="danka_checkbox" value="1" @if($gojikaihi->gojikaihi_flg) checked @endif></div>
                        <div class="hikuyousya_zokumyo">{{ $gojikaihi->common_name }}</div>
                        <div class="hikuyousya_zokumyo">{{ $gojikaihi->henjokaku1 }}{{ $gojikaihi->henjokaku2 }}{{ $gojikaihi->henjokaku3 }}{{ $gojikaihi->henjokaku4 }}</div>
                        <div class="hikuyousya_zokumyo">@if($gojikaihi->henjokaku1 != '精薫の間') 30,000 @else 33,000 @endif</div>
                    </div>
                    @endforeach
                </div>
                <a href="#!" onclick="clickGojikaihiUpdateButton()" class="text_store_btn_a">更新</a>
            </form>
        </div>

        <div class="danka_payment_view" style="display:none;">
            <div class="payment_list_header" style="margin:0;">
                <div class="payment_view_column" style="border:0px;">
                    <div class="danka_payment_date">作成日</div>
                    <div class="danka_payment_date">支払い確認</div>
                    <div class="danka_payment_other">カテゴリ</div>
                    <div class="danka_payment_other">詳細</div>
                    <div class="danka_payment_price">金額</div>
                </div>
                <div class="payment_view_column" style="border:0px;">
                    <div class="danka_payment_date">作成日</div>
                    <div class="danka_payment_date">支払い確認</div>
                    <div class="danka_payment_other">カテゴリ</div>
                    <div class="danka_payment_other">詳細</div>
                    <div class="danka_payment_price">金額</div>
                </div>
            </div>
            <div class="search_result_div" style="height: 223px; padding-left:20px; ">
                <div class="payment_flex_list">
                    @foreach ($payment_list as $payment)
                    <div class="payment_view_column">
                        <div class="danka_payment_date">{{ $payment->created_at->format('Y-m-d') }}</div>
                        <div class="danka_payment_date">{{ $payment->payment_date }}</div>
                        <div class="danka_payment_other">{{ $payment->name }}</div>
                        <div class="danka_payment_other">{{ $payment->detail }}</div>
                        <div class="danka_payment_price">{{ number_format($payment->total) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="danka_nenki_view" style="display:none;">
            <div class="payment_list_header" style="margin:0;">
                <div class="payment_view_column" style="border:0px;">
                    <div class="danka_payment_date">作成日</div>
                    <div class="danka_payment_date">支払い確認</div>
                    <div class="danka_payment_other">カテゴリ</div>
                    <div class="danka_payment_other">詳細</div>
                    <div class="danka_payment_price">金額</div>
                </div>
                <div class="payment_view_column" style="border:0px;">
                    <div class="danka_payment_date">作成日</div>
                    <div class="danka_payment_date">支払い確認</div>
                    <div class="danka_payment_other">カテゴリ</div>
                    <div class="danka_payment_other">詳細</div>
                    <div class="danka_payment_price">金額</div>
                </div>
            </div>
            <div class="search_result_div" style="height: 223px; padding-left:20px; ">
                <div class="payment_flex_list">
                    @foreach ($nenki_list as $nenki)
                    <div class="payment_view_column">
                        <div class="danka_payment_date">{{ $nenki->created_at->format('Y-m-d') }}</div>
                        <div class="danka_payment_date">{{ $nenki->payment_date }}</div>
                        <div class="danka_payment_other">{{ $nenki->name }}</div>
                        <div class="danka_payment_other">{{ $nenki->detail }}</div>
                        <div class="danka_payment_price">{{ number_format($nenki->total) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="danka_star_view" style="display:none;">
            <div class="payment_list_header" style="margin:0;">
                <div class="payment_view_column" style="border:0px;">
                    <div class="danka_payment_date">作成日</div>
                    <div class="danka_payment_date">支払い確認</div>
                    <div class="danka_payment_other">カテゴリ</div>
                    <div class="danka_payment_other">詳細</div>
                    <div class="danka_payment_price">金額</div>
                </div>
                <div class="payment_view_column" style="border:0px;">
                    <div class="danka_payment_date">作成日</div>
                    <div class="danka_payment_date">支払い確認</div>
                    <div class="danka_payment_other">カテゴリ</div>
                    <div class="danka_payment_other">詳細</div>
                    <div class="danka_payment_price">金額</div>
                </div>
            </div>
            <div class="search_result_div" style="height: 223px; padding-left:20px; ">
                <div class="payment_flex_list">
                    @foreach ($star_list as $star)
                    <div class="payment_view_column">
                        <div class="danka_payment_date">{{ $star->created_at->format('Y-m-d') }}</div>
                        <div class="danka_payment_date">{{ $star->payment_date }}</div>
                        <div class="danka_payment_other">{{ $star->name }}</div>
                        <div class="danka_payment_other">{{ $star->detail }}</div>
                        <div class="danka_payment_price">{{ number_format($star->total) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="danka_segaki_view" style="display:none;">
            <div class="payment_list_header" style="margin:0;">
                <div class="payment_view_column" style="border:0px;">
                    <div class="danka_payment_date">作成日</div>
                    <div class="danka_payment_date">支払い確認</div>
                    <div class="danka_payment_other">カテゴリ</div>
                    <div class="danka_payment_other">詳細</div>
                    <div class="danka_payment_price">金額</div>
                </div>
                <div class="payment_view_column" style="border:0px;">
                    <div class="danka_payment_date">作成日</div>
                    <div class="danka_payment_date">支払い確認</div>
                    <div class="danka_payment_other">カテゴリ</div>
                    <div class="danka_payment_other">詳細</div>
                    <div class="danka_payment_price">金額</div>
                </div>
            </div>
            <div class="search_result_div" style="height: 223px; padding-left:20px; ">
                <div class="payment_flex_list">
                    @foreach ($segaki_list as $segaki)
                    <div class="payment_view_column">
                        <div class="danka_payment_date">{{ $segaki->created_at->format('Y-m-d') }}</div>
                        <div class="danka_payment_date">{{ $segaki->payment_date }}</div>
                        <div class="danka_payment_other">{{ $segaki->name }}</div>
                        <div class="danka_payment_other">{{ $segaki->detail }}</div>
                        <div class="danka_payment_price">{{ number_format($segaki->total) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>




    </div>


<script src="{{ asset('js/danka_detail.js') }}"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection



