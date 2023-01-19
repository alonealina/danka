

function clickSearchButton() {
    document.forms.search_form.submit();
}

function clickClearButton() {
    $('#form input, #form select').each(function(){
        //checkboxまたはradioボタンの時
        if(this.type == 'checkbox' || this.type == 'radio'){
          //一括でチェックを外す
            this.checked = false;
        }
        //checkboxまたはradioボタン以外の時
        else if (this.type == 'select' && this.id != 'change_number') {
            this.selected = false;
        } else if (this.id != 'change_number') {
          // val値を空にする
          $(this).val('');
        }
    });
}

selected = document.getElementById("change_number");
selected.onchange = function() {
window.location.href = selected.value;
};