function clickEventStoreButton() {
    document.forms.event_store_form.submit();
}

var check_on = document.getElementById("check_on");
var check_off = document.getElementById("check_off");

check_on.addEventListener("change",function(){
    check_off.checked = false;
});

check_off.addEventListener("change",function(){
    check_on.checked = false;
});
