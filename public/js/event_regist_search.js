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

function clickCsvExportButton(total) {
    const v = confirm(total + '件出力しますがよろしいですか？');
    if(v === true){
        document.forms.csv_export_form.submit();
    }
}
