function clickTextStoreButton() {
    error_flg = 0;

    if (danka_store_form.name.value == "") {
        $('#family_name').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#family_name').css( 'background', '#fff' );
    }

    if (danka_store_form.name_kana.value == "") {
        $('#family_kana').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#family_kana').css( 'background', '#fff' );
    }

    if (!error_flg) {
        document.forms.danka_store_form.submit();
    }

}
