function clickEventStoreButton() {
    error_flg = 0;

    if (event_store_form.place.value == "") {
        $('#place_error').css( 'display', 'flex' );
        $('.place_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#place_error').css( 'display', 'none' );
        $('.place_text').css( 'background', '#F7F7F7' );
    }

    if (!event_store_form.max.value.match(/^[0-9]+$/)) {
        $('#max_error').css( 'display', 'flex' );
        $('.max_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#max_error').css( 'display', 'none' );
        $('.max_text').css( 'background', '#F7F7F7' );
    }




    if (!error_flg) {
        document.forms.event_store_form.submit();
    }

}

