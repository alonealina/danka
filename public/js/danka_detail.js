function clickHikuyousya() {
    $('#hikuyousya').addClass('danka_current');
    $('#family').removeClass('danka_current');
    $('#payment').removeClass('danka_current');
    $('.danka_other_content').show();
    $('.danka_family_content_view').hide();
    $('.danka_payment_view').hide();
}

function clickFamily() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').addClass('danka_current');
    $('#payment').removeClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content_view').show();
    $('.danka_payment_view').hide();
}

function clickPayment() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').removeClass('danka_current');
    $('#payment').addClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content_view').hide();
    $('.danka_payment_view').show();
}

window.addEventListener('DOMContentLoaded', function(){
  
    // input要素を取得
    var meinichi = document.getElementById("meinichi");
  
    // イベントリスナーでイベント「change」を登録
    meinichi.addEventListener("change",function(){

        temp_date = this.value;

        const birthday = {
            year: temp_date.substr(0,4),
            month: temp_date.substr(5,2),
            date:  temp_date.substr(8,2)
        };

        console.log(birthday);
        //今日
        var today = new Date();
    
        //今年の誕生日
        var thisYearsBirthday = new Date(today.getFullYear(), birthday.month-1, birthday.date);
    
        //年齢
        var age = today.getFullYear() - birthday.year;

        if(today < thisYearsBirthday){
            //今年まだ誕生日が来ていない
            age--;
        }

        if (age == 0) {
            age = 1;
        } else {
            age = age + 2;
        }

        console.log(age);
        let kaiki_year = document.getElementById('kaiki_year');
        kaiki_year.value = age;

    });
  
});




