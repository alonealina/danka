function clickHikuyousya() {
    $('#hikuyousya').addClass('danka_current');
    $('#family').removeClass('danka_current');
    $('.danka_other_content').show();
    $('.danka_family_content').hide();

}

function clickFamily() {
    $('#hikuyousya').removeClass('danka_current');
    $('#family').addClass('danka_current');
    $('.danka_other_content').hide();
    $('.danka_family_content').show();

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
    hi_error_flg = 0;
    tel_error_flg = 0;
    mobile_error_flg = 0;
    zip_error_flg = 0;
    mail_error_flg = 0;
    hen_error_flg = 0;

    if (danka_store_form.name1.value == "") {
        $('#name1').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name1').css( 'background', '#fff' );
    }

    if (danka_store_form.name2.value == "") {
        $('#name2').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name2').css( 'background', '#fff' );
    }

    if (danka_store_form.name_kana1.value == "") {
        $('#name_kana1').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_kana1').css( 'background', '#fff' );
    }

    if (danka_store_form.name_kana2.value == "") {
        $('#name_kana2').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_kana2').css( 'background', '#fff' );
    }

    if (document.getElementById('hikuyousya_flg').checked) {
        if (danka_store_form.common_name1.value == "") {
            $('#common_name1').css( 'background', '#FAF1F1' );
            hi_error_flg = 1;
        } else {
            $('#common_name1').css( 'background', '#fff' );
        }

        if (danka_store_form.common_name2.value == "") {
            $('#common_name2').css( 'background', '#FAF1F1' );
            hi_error_flg = 1;
        } else {
            $('#common_name2').css( 'background', '#fff' );
        }

        if (danka_store_form.common_kana1.value == "") {
            $('#common_kana1').css( 'background', '#FAF1F1' );
            hi_error_flg = 1;
        } else {
            $('#common_kana1').css( 'background', '#fff' );
        }

        if (danka_store_form.common_kana2.value == "") {
            $('#common_kana2').css( 'background', '#FAF1F1' );
            hi_error_flg = 1;
        } else {
            $('#common_kana2').css( 'background', '#fff' );
        }

        gyonen = danka_store_form.gyonen.value;
        if ((gyonen > 150 || gyonen < 1) && gyonen != "" || isNaN(gyonen)) {
            $('#gyonen').css( 'background', '#FAF1F1' );
            hi_error_flg = 1;
        } else {
            $('#gyonen').css( 'background', '#fff' );
        }

        henjokaku1 = danka_store_form.henjokaku1.value;
        henjokaku2 = danka_store_form.henjokaku2.value;
        henjokaku3 = danka_store_form.henjokaku3.value;
        henjokaku4 = danka_store_form.henjokaku4.value;
        if ( !(henjokaku1 == "" && henjokaku2 == "" && henjokaku3 == "" && henjokaku4 == "") && 
            !(henjokaku1 != "" && henjokaku2 != "" && henjokaku3 != "" && henjokaku4 != "")  ) {
            hen_error_flg = 1;
            $('#hen_error').html('遍照閣の項目が一部未入力です');

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
            $('#hen_error').html('');
            $('#henjokaku1').css( 'background', '#fff' );
            $('#henjokaku2').css( 'background', '#fff' );
            $('#henjokaku3').css( 'background', '#fff' );
            $('#henjokaku4').css( 'background', '#fff' );
        }



    }

    if (error_flg) {
        $('#danka_error').html('檀家情報の必須項目を入力してください');
    } else {
        $('#danka_error').html('');
    }

    if (hi_error_flg) {
        $('#hikuyousya_error').html('被供養者情報の必須項目を入力してください');
    } else {
        $('#hikuyousya_error').html('');
    }

    if (!danka_store_form.tel.value.match(/^[0-9]*$/)) {
        $('#tel').css( 'background', '#FAF1F1' );
        $('#danka_tel_error').html('固定番号に半角数字以外が含まれています');
        tel_error_flg = 1;
    } else {
        $('#tel').css( 'background', '#fff' );
        $('#danka_tel_error').html('');
    }

    if (!danka_store_form.mobile.value.match(/^[0-9]*$/)) {
        $('#mobile').css( 'background', '#FAF1F1' );
        $('#mobile_error').html('携帯番号に半角数字以外が含まれています');
        mobile_error_flg = 1;
    } else {
        $('#mobile').css( 'background', '#fff' );
        $('#mobile_error').html('');
    }

    if (!danka_store_form.zip.value.match(/^[0-9]*$/)) {
        $('#zip').css( 'background', '#FAF1F1' );
        $('#zip_error').html('郵便番号に半角数字以外が含まれています');
        zip_error_flg = 1;
    } else {
        $('#zip').css( 'background', '#fff' );
        $('#zip_error').html('');
    }

    if (!danka_store_form.mail.value.match(/^[a-zA-Z0-9!-/:-@¥[-`{-~]*$/)) {
        $('#mail').css( 'background', '#FAF1F1' );
        $('#mail_error').html('メールアドレスに全角文字が含まれています');
        mail_error_flg = 1;
    } else {
        $('#mail').css( 'background', '#fff' );
        $('#mail_error').html('');
    }



    if (!error_flg && !hi_error_flg && !tel_error_flg && !mobile_error_flg && !zip_error_flg && !mail_error_flg && !hen_error_flg) {
        document.forms.danka_store_form.submit();
    }

}



function clickAddButton() {
    var clone = $('#family_item').clone(true);
    clone.find('input[type="text"]').val('');
    clone.appendTo('#family_form');
};