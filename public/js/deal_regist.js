
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

  var clone = $('#item-1').clone(true);
  clone.find('input[type="text"]').val('');
  clone.find('select[name="item_id[]"]').val('1');
  clone.find('select[name="quantity[]"]').val('1');
  clone.find('select[name="zokumyo[]"]').val('');
  clone.find('.dummy_minus_btn_div').remove();

  var newElement = document.createElement("a"); // p要素作成
  var newContent = document.createTextNode("―"); // テキストノードを作成
  newElement.appendChild(newContent); // p要素にテキストノードを追加
  newElement.setAttribute("href","#!"); // p要素にidを設定
  newElement.setAttribute("class","item_add_btn minus_btn"); // p要素にidを設定
  clone.append(newElement);

  clone.attr('id', id_val);


  clone.appendTo('#item_form');
};


function clickTextStoreButton() {
  error_flg = 0;

  if (danka_store_form.danka_id.value == "") {
      $('#id_input').css( 'background', '#FAF1F1' );
      error_flg = 1;
  } else {
      $('#id_input').css( 'background', '#fff' );
  }

  if (!error_flg ) {
      document.forms.danka_store_form.submit();
  }
};

window.addEventListener('DOMContentLoaded', function() {
  $('#item_form').on('click','.minus_btn',function() {
    let id = $(this).parent().attr('id');
    var cnt = $(".minus_btn").length;
    document.getElementById(id).remove();
  });
});

