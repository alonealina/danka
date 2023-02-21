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

    henjokaku1 = danka_store_form.henjokaku1.value;
    henjokaku2 = danka_store_form.henjokaku2.value;
    henjokaku3 = danka_store_form.henjokaku3.value;
    henjokaku4 = danka_store_form.henjokaku4.value;
    if ( !(henjokaku1 == "" && henjokaku2 == "" && henjokaku3 == "" && henjokaku4 == "") && 
        !(henjokaku1 != "" && henjokaku2 != "" && henjokaku3 != "" && henjokaku4 != "")  ) {
        error_flg = 1;

        if (henjokaku1 == "") {
            $('#henjokaku1').css( 'background', '#FAF1F1' );
        } else {
            $('#henjokaku1').css( 'background', '#fff' );
        }

        if (henjokaku2 == "") {
            $('#henjokaku2').css( 'background', '#FAF1F1' );
        } else {
            $('#henjokaku2').css( 'background', '#fff' );
        }

        if (henjokaku3 == "") {
            $('#henjokaku3').css( 'background', '#FAF1F1' );
        } else {
            $('#henjokaku3').css( 'background', '#fff' );
        }

        if (henjokaku4 == "") {
            $('#henjokaku4').css( 'background', '#FAF1F1' );
        } else {
            $('#henjokaku4').css( 'background', '#fff' );
        }

    } else {
        $('#henjokaku1').css( 'background', '#fff' );
        $('#henjokaku2').css( 'background', '#fff' );
        $('#henjokaku3').css( 'background', '#fff' );
        $('#henjokaku4').css( 'background', '#fff' );
    }

    if (!error_flg) {
        document.forms.danka_store_form.submit();
    }

}
