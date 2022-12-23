function clickTextStoreButton() {
    error_flg = 0;

    if (text_store_form.category_id.value == "") {
        $('#name_error').css( 'display', 'block' );
        $('.select_category').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_error').css( 'display', 'none' );
        $('.select_category').css( 'background', '#fff' );
    }

    if (text_store_form.title.value == "") {
        $('#name_error').css( 'display', 'block' );
        $('.text_title_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_error').css( 'display', 'none' );
        $('.text_title_text').css( 'background', '#fff' );
    }

    if (text_store_form.content.value == "") {
        $('#name_error').css( 'display', 'block' );
        $('.form_textarea').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_error').css( 'display', 'none' );
        $('.form_textarea').css( 'background', '#fff' );
    }

    if (!error_flg) {
        document.forms.text_store_form.submit();
    }

}

