
function clickTextStoreButton() {
    error_flg = 0;

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

    if (danka_store_form.zip.value == "") {
        $('#zip').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#zip').css( 'background', '#fff' );
    }

    if (danka_store_form.pref.value == "") {
        $('#pref').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#pref').css( 'background', '#fff' );
    }

    if (danka_store_form.city.value == "") {
        $('#city').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#city').css( 'background', '#fff' );
    }

    if (danka_store_form.address.value == "") {
        $('#address').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#address').css( 'background', '#fff' );
    }


    if (!error_flg) {
        document.forms.danka_store_form.submit();
    }

}
