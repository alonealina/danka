function valueChange(event){
    if (userDetailCheckSp.checked){
        userDetailSpanSp.innerText = '▲';
        userDetailSp.hidden = false;
        userContentSp.hidden = true;
    }else{
        userDetailSpanSp.innerText = '▼';
        userDetailSp.hidden = true;
        userContentSp.hidden = false;
    }
}

let userDetailCheckSp = document.getElementById('user_detail_check_sp');
userDetailCheckSp.addEventListener('change', valueChange);
let userDetailSp = document.getElementById('user_detail_sp');
let userContentSp = document.getElementById('user_content_sp');
let userDetailSpanSp = document.getElementById('user_detail_span_sp');