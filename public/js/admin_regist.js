function clickAdminStoreButton() {
    error_flg = 0;

    var password_error_text = document.getElementById('password_error_text');
    if (admin_store_form.password.value != admin_store_form.password_confirm.value ){
        $('#password_error').css( 'display', 'flex' );
        $('.pass_text').css( 'background', '#FAF1F1' );
        password_error_text.innerHTML = 'パスワードが一致しません。';
        error_flg = 1;
    } else if (admin_store_form.password.value == "") {
        $('#password_error').css( 'display', 'flex' );
        $('.pass_text').css( 'background', '#FAF1F1' );
        password_error_text.innerHTML = 'パスワードを入力してください。';
        error_flg = 1;
    } else {
        $('#password_error').css( 'display', 'none' );
        $('.pass_text').css( 'background', '#F7F7F7' );
    }

    if (error_flg) {
        error_message.innerHTML = '※不足している項目があります。';
    } else {
        document.forms.admin_store_form.submit();
    }

}

