function clickEventBookStoreButton() {
    error_flg = 0;

    if (event_book_store_form.name.value == "") {
        $('#name_error').css( 'display', 'flex' );
        $('.name_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_error').css( 'display', 'none' );
        $('.name_text').css( 'background', '#F7F7F7' );
    }

    if (event_book_store_form.name_kana.value == "") {
        $('#name_kana_error').css( 'display', 'flex' );
        $('.name_kana_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_kana_error').css( 'display', 'none' );
        $('.name_kana_text').css( 'background', '#F7F7F7' );
    }

    if (!event_book_store_form.tel.value.match(/^[0-9]+$/)) {
        $('#tel_error').css( 'display', 'flex' );
        $('.tel_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#tel_error').css( 'display', 'none' );
        $('.tel_text').css( 'background', '#F7F7F7' );
    }




    if (!error_flg) {
        document.forms.event_book_store_form.submit();
    }

}

