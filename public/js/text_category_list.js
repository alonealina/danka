function categoryStoreButton() {
    error_flg = 0;

    if (category_store_form.name.value == "") {
        $('#name_error').css( 'display', 'block' );
        $('.check_error').css( 'display', 'none' );
        $('.category_name_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_error').css( 'display', 'none' );
        $('.check_error').css( 'display', 'none' );
        $('.category_name_text').css( 'background', '#F7F7F7' );
    }

    if (!error_flg) {
        document.forms.category_store_form.submit();
    }

}

