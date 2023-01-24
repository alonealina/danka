function itemStoreButton() {
    error_flg = 0;

    if (item_store_form.detail.value == "") {
        $('#detail_error').css( 'display', 'block' );
        $('.check_error').css( 'display', 'none' );
        $('#detail').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#detail_error').css( 'display', 'none' );
        $('.check_error').css( 'display', 'none' );
        $('#detail').css( 'background', '#FFF' );
    }

    if (item_store_form.price.value == "" || isNaN(item_store_form.price.value)) {
        $('#price_error').css( 'display', 'block' );
        $('.check_error').css( 'display', 'none' );
        $('#price').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#price_error').css( 'display', 'none' );
        $('.check_error').css( 'display', 'none' );
        $('#price').css( 'background', '#FFF' );
    }

    if (!error_flg) {
        document.forms.item_store_form.submit();
    }

}

