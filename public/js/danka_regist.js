function clickHikuyousya() {
    $('#hikuyousya').addClass('danka_current');
    $('#family').removeClass('danka_current');
}

function clickFamily() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').addClass('danka_current');
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




function clickTextStoreButton() {
    error_flg = 0;

    if (danka_store_form.name.value == "") {
        $('#name').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name').css( 'background', '#fff' );
    }

    if (danka_store_form.name_kana.value == "") {
        $('#name_kana').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_kana').css( 'background', '#fff' );
    }

    if (danka_store_form.tel.value == "") {
        $('#tel').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#tel').css( 'background', '#fff' );
    }tel

    if (danka_store_form.zip.value == "") {
        $('#zip').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#zip').css( 'background', '#fff' );
    }

    if (danka_store_form.pref.value == "") {
        $('#pref').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#pref').css( 'background', '#fff' );
    }

    if (danka_store_form.city.value == "") {
        $('#city').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#city').css( 'background', '#fff' );
    }

    if (danka_store_form.address.value == "") {
        $('#address').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#address').css( 'background', '#fff' );
    }

    if (danka_store_form.hikuyousya_flg.value == "1") {
        if (danka_store_form.common_name.value == "") {
            $('#common_name').css( 'background', '#FAF1F1' );
            error_flg = 1;
        } else {
            $('#common_name').css( 'background', '#fff' );
        }

        if (danka_store_form.common_kana.value == "") {
            $('#common_kana').css( 'background', '#FAF1F1' );
            error_flg = 1;
        } else {
            $('#common_kana').css( 'background', '#fff' );
        }

        gyonen = danka_store_form.gyonen.value;
        if ((gyonen > 150 || gyonen < 1) && gyonen != "" || isNaN(gyonen)) {
            $('#gyonen').css( 'background', '#FAF1F1' );
            error_flg = 1;
        } else {
            $('#gyonen').css( 'background', '#fff' );
        }

        
    }

    if (!error_flg) {
        document.forms.danka_store_form.submit();
    }

}

