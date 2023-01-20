function clickTextStoreButton() {
    error_flg = 0;

    if (danka_store_form.common_name.value == "") {
        $('#common_name').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#common_name').css( 'background', '#fff' );
    }

    if (danka_store_form.common_kana.value == "") {
        $('#common_kana').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#common_kana').css( 'background', '#fff' );
    }

    gyonen = danka_store_form.gyonen.value;
    if ((gyonen > 150 || gyonen < 1) && gyonen != "" || isNaN(gyonen)) {
        $('#gyonen').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#gyonen').css( 'background', '#fff' );
    }

    if (!error_flg) {
        document.forms.danka_store_form.submit();
    }

}
