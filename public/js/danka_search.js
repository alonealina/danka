

function clickSearchButton() {
    document.forms.danka_search_form.submit();
}

function clickClearButton() {
    $('#form input, #form select').each(function(){
        //checkboxまたはradioボタンの時
        if(this.type == 'checkbox' || this.type == 'radio'){
          //一括でチェックを外す
            this.checked = false;
        }
        //checkboxまたはradioボタン以外の時
        else if (this.type == 'select') {
            this.selected = false;
        } else {
          // val値を空にする
          $(this).val('');
        }
    });
}