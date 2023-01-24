
var id_input = document.getElementById("id_input");
var name_input = document.getElementById("name");
var kana_input = document.getElementById("kana");


id_input.addEventListener("change",function(){
  let id = this.value;
  console.log(id)
  $.ajax({
    type: "GET",
    url: "news_list_get.php",
    data: { "id" : id },
    dataType : "json",
  }).done(function(data){
    if (data) {
        console.log(data)

        $('#name').html(data[0].name)
        $('#kana').html(data[0].name_kana)
        $('#zip').html(data[0].zip)
        $('#tel').html(data[0].tel)
        $('#address').html(data[0].pref)
        $('#address').append(data[0].city)
        $('#address').append(data[0].address)
        $('#address').append(data[0].building)

        $(".select_zokumyo").html('<option value="">なし</option>');

        var zokumyo = data[1];
        for(let i=0; i<zokumyo.length; i++){
          $(".select_zokumyo").append('<option value="'+ zokumyo[i].id +'">'+ zokumyo[i].common_name +'</option>');
        }
    } else {
        console.log(data)
    }
  }).fail(function(XMLHttpRequest, status, e){
    alert("aaa");
    console.log(e)
  });
});

window.addEventListener('DOMContentLoaded',function(){
  var select_item = document.getElementsByClassName('select_item'); // ①
  
  for(let i = 0; i < select_item.length; i++){ // ②
    select_item[i].addEventListener('change',function(){ // ②
      console.log(`${select_item[i].value}がクリックされました！`); // ③
    });
  }
});

function clickAddButton() {
  var cnt = $(".deal_item_column").length + 1;
  var id_val = 'item-' + cnt;

  var clone = $('#item-1').clone(true);
  clone.find('input[type="text"]').val('');


  clone.attr('id', id_val);


  clone.appendTo('#item_form');
};


function clickTextStoreButton() {
  document.forms.danka_store_form.submit();
}
