
function clickTextStoreButton() {
    error_flg = 0;
    tel_error_flg = 0;
    mobile_error_flg = 0;
    zip_error_flg = 0;
    mail_error_flg = 0;

    if (danka_store_form.name.value == "") {
        $('#name').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name').css( 'background', '#fff' );
    }

    if (danka_store_form.name_kana.value == "") {
        $('#name_kana').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_kana').css( 'background', '#fff' );
    }

    if (error_flg) {
        $('#danka_error').html('檀家情報の必須項目を入力してください');
    } else {
        $('#danka_error').html('');
    }

    if (!danka_store_form.tel.value.match(/^[0-9]*$/)) {
        $('#tel').css( 'background', '#FAF1F1' );
        $('#danka_tel_error').html('固定番号に半角数字以外が含まれています');
        tel_error_flg = 1;
    } else {
        $('#tel').css( 'background', '#fff' );
        $('#danka_tel_error').html('');
    }

    if (!danka_store_form.mobile.value.match(/^[0-9]*$/)) {
        $('#mobile').css( 'background', '#FAF1F1' );
        $('#mobile_error').html('携帯番号に半角数字以外が含まれています');
        mobile_error_flg = 1;
    } else {
        $('#mobile').css( 'background', '#fff' );
        $('#mobile_error').html('');
    }

    if (!danka_store_form.zip.value.match(/^[0-9]*$/)) {
        $('#zip').css( 'background', '#FAF1F1' );
        $('#zip_error').html('郵便番号に半角数字以外が含まれています');
        zip_error_flg = 1;
    } else {
        $('#zip').css( 'background', '#fff' );
        $('#zip_error').html('');
    }

    if (!danka_store_form.mail.value.match(/^[a-zA-Z0-9!-/:-@¥[-`{-~]*$/)) {
        $('#mail').css( 'background', '#FAF1F1' );
        $('#mail_error').html('メールアドレスに全角文字が含まれています');
        mail_error_flg = 1;
    } else {
        $('#mail').css( 'background', '#fff' );
        $('#mail_error').html('');
    }

    if (!error_flg && !tel_error_flg && !mobile_error_flg && !zip_error_flg && !mail_error_flg) {
        document.forms.danka_store_form.submit();
    }

}
