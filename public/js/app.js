function clickMenu1() {
    if ($('#menu1').css('display') == 'none') {
        // 非表示の場合の処理
        $('#menu1').css( 'display', 'block' );
        $('#up1').css( 'display', 'block' );
        $('#down1').css( 'display', 'none' );
    } else {
        // 表示されている場合の処理
        $('#menu1').css( 'display', 'none' );
        $('#up1').css( 'display', 'none' );
        $('#down1').css( 'display', 'block' );
        
    }
}

function clickMenu2() {
    if ($('#menu2').css('display') == 'none') {
        // 非表示の場合の処理
        $('#menu2').css( 'display', 'block' );
        $('#up2').css( 'display', 'block' );
        $('#down2').css( 'display', 'none' );
    } else {
        // 表示されている場合の処理
        $('#menu2').css( 'display', 'none' );
        $('#up2').css( 'display', 'none' );
        $('#down2').css( 'display', 'block' );
        
    }
}

function clickMenu3() {
    if ($('#menu3').css('display') == 'none') {
        // 非表示の場合の処理
        $('#menu3').css( 'display', 'block' );
        $('#up3').css( 'display', 'block' );
        $('#down3').css( 'display', 'none' );
    } else {
        // 表示されている場合の処理
        $('#menu3').css( 'display', 'none' );
        $('#up3').css( 'display', 'none' );
        $('#down3').css( 'display', 'block' );
        
    }
}

function clickMenu4() {
    if ($('#menu4').css('display') == 'none') {
        // 非表示の場合の処理
        $('#menu4').css( 'display', 'block' );
        $('#up4').css( 'display', 'block' );
        $('#down4').css( 'display', 'none' );
    } else {
        // 表示されている場合の処理
        $('#menu4').css( 'display', 'none' );
        $('#up4').css( 'display', 'none' );
        $('#down4').css( 'display', 'block' );
        
    }
}

function clickMenu5() {
    if ($('#menu5').css('display') == 'none') {
        // 非表示の場合の処理
        $('#menu5').css( 'display', 'block' );
        $('#up5').css( 'display', 'block' );
        $('#down5').css( 'display', 'none' );
    } else {
        // 表示されている場合の処理
        $('#menu5').css( 'display', 'none' );
        $('#up5').css( 'display', 'none' );
        $('#down5').css( 'display', 'block' );
        
    }
}

function clickMenu6() {
    if ($('#menu6').css('display') == 'none') {
        // 非表示の場合の処理
        $('#menu6').css( 'display', 'block' );
        $('#up6').css( 'display', 'block' );
        $('#down6').css( 'display', 'none' );
    } else {
        // 表示されている場合の処理
        $('#menu6').css( 'display', 'none' );
        $('#up6').css( 'display', 'none' );
        $('#down6').css( 'display', 'block' );
        
    }
}

function clickLoginFormButton() {
    error_flg = 0;
    if (login_form.login_id.value == "") {
        $('#id_error').css( 'display', 'block' );
        $('.login_id_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#id_error').css( 'display', 'none' );
        $('.login_id_text').css( 'background', '#F7F7F7' );
    }

    if (login_form.password.value == "") {
        $('#password_error').css( 'display', 'block' );
        $('.password_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#password_error').css( 'display', 'none' );
        $('.password_text').css( 'background', '#F7F7F7' );
    }

    if (!error_flg) {
        document.forms.login_form.submit();
    }

}

