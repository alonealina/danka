function clickLogButton(id) {
    $('.log_view_btn_a').removeClass('current_log_btn');
    $('.log_view_btn_a').html('表示');
    $('#log_btn_'+id).addClass('current_log_btn');
    $('#log_btn_'+id).html('表示中');
    $('.log_list').removeClass('log_list_current');
    $('#log_list_'+id).addClass('log_list_current');

}

