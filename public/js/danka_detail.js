function clickHikuyousya() {
    $('#hikuyousya').addClass('danka_current');
    $('#family').removeClass('danka_current');
    $('#gojikaihi').removeClass('danka_current');
    $('#payment').removeClass('danka_current');
    $('#nenki').removeClass('danka_current');
    $('#star').removeClass('danka_current');
    $('#segaki').removeClass('danka_current');
    $('.danka_other_content').show();
    $('.danka_family_content_view').hide();
    $('.danka_gojikaihi_content').hide();
    $('.danka_payment_view').hide();
    $('.danka_nenki_view').hide();
    $('.danka_star_view').hide();
    $('.danka_segaki_view').hide();
}

function clickFamily() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').addClass('danka_current');
    $('#gojikaihi').removeClass('danka_current');
    $('#payment').removeClass('danka_current');
    $('#nenki').removeClass('danka_current');
    $('#star').removeClass('danka_current');
    $('#segaki').removeClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content_view').show();
    $('.danka_gojikaihi_content').hide();
    $('.danka_payment_view').hide();
    $('.danka_nenki_view').hide();
    $('.danka_star_view').hide();
    $('.danka_segaki_view').hide();
}

function clickGojikaihi() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').removeClass('danka_current');
    $('#gojikaihi').addClass('danka_current');
    $('#payment').removeClass('danka_current');
    $('#nenki').removeClass('danka_current');
    $('#star').removeClass('danka_current');
    $('#segaki').removeClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content_view').hide();
    $('.danka_gojikaihi_content').show();
    $('.danka_payment_view').hide();
    $('.danka_nenki_view').hide();
    $('.danka_star_view').hide();
    $('.danka_segaki_view').hide();
}

function clickPayment() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').removeClass('danka_current');
    $('#gojikaihi').removeClass('danka_current');
    $('#payment').addClass('danka_current');
    $('#nenki').removeClass('danka_current');
    $('#star').removeClass('danka_current');
    $('#segaki').removeClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content_view').hide();
    $('.danka_gojikaihi_content').hide();
    $('.danka_payment_view').show();
    $('.danka_nenki_view').hide();
    $('.danka_star_view').hide();
    $('.danka_segaki_view').hide();
}

function clickNenki() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').removeClass('danka_current');
    $('#gojikaihi').removeClass('danka_current');
    $('#payment').removeClass('danka_current');
    $('#nenki').addClass('danka_current');
    $('#star').removeClass('danka_current');
    $('#segaki').removeClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content_view').hide();
    $('.danka_payment_view').hide();
    $('.danka_nenki_view').show();
    $('.danka_star_view').hide();
    $('.danka_segaki_view').hide();
}

function clickStar() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').removeClass('danka_current');
    $('#gojikaihi').removeClass('danka_current');
    $('#payment').removeClass('danka_current');
    $('#nenki').removeClass('danka_current');
    $('#star').addClass('danka_current');
    $('#segaki').removeClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content_view').hide();
    $('.danka_gojikaihi_content').hide();
    $('.danka_payment_view').hide();
    $('.danka_nenki_view').hide();
    $('.danka_star_view').show();
    $('.danka_segaki_view').hide();
}

function clickSegaki() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').removeClass('danka_current');
    $('#gojikaihi').removeClass('danka_current');
    $('#payment').removeClass('danka_current');
    $('#nenki').removeClass('danka_current');
    $('#star').removeClass('danka_current');
    $('#segaki').addClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content_view').hide();
    $('.danka_gojikaihi_content').hide();
    $('.danka_payment_view').hide();
    $('.danka_nenki_view').hide();
    $('.danka_star_view').hide();
    $('.danka_segaki_view').show();
}

window.addEventListener('DOMContentLoaded', function(){
  
    // input???????????????
    var meinichi = document.getElementById("meinichi");
  
    // ??????????????????????????????????????????change????????????
    meinichi.addEventListener("change",function(){

        temp_date = this.value;

        const birthday = {
            year: temp_date.substr(0,4),
            month: temp_date.substr(5,2),
            date:  temp_date.substr(8,2)
        };

        console.log(birthday);
        //??????
        var today = new Date();
    
        //??????????????????
        var thisYearsBirthday = new Date(today.getFullYear(), birthday.month-1, birthday.date);
    
        //??????
        var age = today.getFullYear() - birthday.year;

        if(today < thisYearsBirthday){
            //???????????????????????????????????????
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


function clickGojikaihiUpdateButton() {
    document.forms.gojikaihi_form.submit();
};

