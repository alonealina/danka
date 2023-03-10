var event_date_id = document.getElementById("event_date_id");

event_date_id.addEventListener("change",function(){
    let id = this.value;
    console.log(id)
    $.ajax({
      type: "GET",
      url: "event_date_get.php",
      data: { "id" : id },
      dataType : "json",
    }).done(function(data){
      if (data) {
          console.log(data[0].payment_before);
  
          document.getElementById("payment_before").value = data[0].payment_before;
          document.getElementById("payment_after").value = data[0].payment_after;
      } else {
          console.log(data)
      }
    }).fail(function(XMLHttpRequest, status, e){
      alert("aaa");
      console.log(e)
    });
  });
  