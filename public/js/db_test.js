
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
        } else {
            console.log(data)
        }
      }).fail(function(XMLHttpRequest, status, e){
        alert("aaa");
        console.log(e)
      });
});


