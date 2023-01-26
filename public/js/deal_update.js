
var id_input = document.getElementById("id_input");
var name_input = document.getElementById("name");
var kana_input = document.getElementById("kana");


window.addEventListener('DOMContentLoaded',function(){
  var select_item = document.getElementsByClassName('select_item'); // ①
  
  for(let i = 0; i < select_item.length; i++){ // ②
    select_item[i].addEventListener('change',function(){ // ②
      console.log(`${select_item[i].value}がクリックされました！`); // ③
    });
  }
});

function clickAddButton() {

  var max_id = 0;
  let item_array = document.querySelectorAll("[id^='item-']");
  item_array.forEach(item => {
    var item_id = Number(item.id.replace('item-', ''));
    if (max_id < item_id) {
      max_id = item_id;
    }
  });
  next_id = max_id + 1;

  var id_val = 'item-' + next_id;
  var max_id = 'item-' + max_id;

  var clone = $('#'+max_id).clone(true);
  clone.find('input[type="text"]').val('');
  clone.find('select[name="item_id[]"]').val('1');
  clone.find('select[name="quantity[]"]').val('1');
  clone.find('select[name="zokumyo[]"]').val('');
  clone.attr('id', id_val);


  clone.appendTo('#item_form');
};


function clickTextStoreButton() {
  document.forms.danka_store_form.submit();
};

window.addEventListener('DOMContentLoaded', function() {
  $('#item_form').on('click','.minus_btn',function() {
    let id = $(this).parent().attr('id');
    var cnt = $(".minus_btn").length;
    if(cnt > 1) {
      document.getElementById(id).remove();
    }
  });
});

