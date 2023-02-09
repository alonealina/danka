
var id_input = document.getElementById("id_input");
var name_input = document.getElementById("name");
var kana_input = document.getElementById("kana");


window.addEventListener('DOMContentLoaded',function(){
  priceChange();
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
  clone.find('select[name="item_id[]"]').prop("selectedIndex", 0);
  clone.find('select[name="quantity[]"]').val('1');
  clone.find('select[name="zokumyo[]"]').val('');
  clone.find('select[name="price[]"]').val('');
  clone.attr('id', id_val);

  clone.appendTo('#item_form');
  
  priceChange();
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

function priceChange() {
  var select_item = document.getElementsByClassName('select_item');
  
  for(let i = 0; i < select_item.length; i++){
    select_item[i].addEventListener('change',function(){
      let parent = select_item[i].parentElement.parentElement;
      let id = select_item[i].value;
      $.ajax({
        type: "GET",
        url: "../item_price_get.php",
        data: { "id" : id },
        dataType : "json",
      }).done(function(data){
        if (data) {
          $('#' + parent.id).find('input[name="price[]"]').val(data[0].price);
        } else {
            console.log(data)
        }
      }).fail(function(XMLHttpRequest, status, e){
        alert("aaa");
        console.log(e)
      });
    });
  }

}