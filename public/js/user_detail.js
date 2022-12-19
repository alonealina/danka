function valueChange(event){
    if (userDetailCheck.checked){
        userDetailSpan.innerText = '▲';
        userDetail.hidden = false;
    }else{
        userDetailSpan.innerText = '▼';
        userDetail.hidden = true;
    }
}

let userDetailCheck = document.getElementById('user_detail_check');
userDetailCheck.addEventListener('change', valueChange);
let userDetail = document.getElementById('user_detail');
let userDetailSpan = document.getElementById('user_detail_span');