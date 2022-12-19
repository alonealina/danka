function clickContactButton() {
    var input_name = document.querySelector("input[name=name]");
    var input_mail = document.querySelector("input[name=mail]");
    var input_title = document.querySelector("input[name=title]");
    var input_message = document.querySelector("textarea[name=message]");
    var name_value = input_name.value;
    var mail_value = input_mail.value;
    var title_value = input_title.value;
    var message_value = input_message.value;

    if (!name_value) {
        input_name.style.backgroundColor = '#FFDFDF';
    } else {
        input_name.style.backgroundColor = '#FFF';
    }
    if (!mail_value) {
        input_mail.style.backgroundColor = '#FFDFDF';
    } else {
        input_mail.style.backgroundColor = '#FFF';
    }
    if (!title_value) {
        input_title.style.backgroundColor = '#FFDFDF';
    } else {
        input_title.style.backgroundColor = '#FFF';
    }
    if (!message_value) {
        input_message.style.backgroundColor = '#FFDFDF';
    } else {
        input_message.style.backgroundColor = '#FFF';
    }

    if (name_value && mail_value && title_value && message_value) {
        $(".contact_div").empty();
        $(".contact_div").append('<div class="title_orange">CONTACT</div><div class="send_comp">お問い合わせを受け付けました</div>');

    } else {
        document.getElementById("error_message").innerHTML = "不足している項目があります";
    }
}

// 口座種類切り替えについて
let indiBtn = document.querySelector(".indi_btn");
let corpBtn = document.querySelector(".corp_btn");
let indiForm = document.getElementById("indi_form");
let corpForm = document.getElementById("corp_form");
let demoForm = document.getElementById("demo_form");
let indiIbName = document.getElementById("indi_ib_name");
let corpIbName = document.getElementById("corp_ib_name");

indiBtn.addEventListener("click", function () {
    indiBtn.classList.remove("not");
    corpBtn.classList.add("not");
    indiForm.hidden = false;
    corpForm.hidden = true;
    indiIbName.value = corpIbName.value;
});

corpBtn.addEventListener("click", function () {
    indiBtn.classList.add("not");
    corpBtn.classList.remove("not");
    indiForm.hidden = true;
    corpForm.hidden = false;
    corpIbName.value = indiIbName.value;
});

$('input[name="doc_id_passport"]').on('change', function () {
    var file = $(this).prop('files')[0];
    $('.indi_file_p1').text(file.name);
});

$('input[name="doc_id_residence_permit"]').on('change', function () {
    var file = $(this).prop('files')[0];
    $('.indi_file_p2').text(file.name);
});

$('input[name="doc_id_passport_ura"]').on('change', function () {
    var file = $(this).prop('files')[0];
    $('.indi_file_p3').text(file.name);
});

// 仮処理
function clickIndiFormButton() {
    indiFile1 = $("#indi_file1").val().length;
    indiFile2 = $("#indi_file2").val().length;
    indiFile3 = $("#indi_file3").val().length;
    indiIbName = $("#indi_ib_name").val();
	
	if(indiFile1 == 0){
		$(".indi_error1").empty();
		$(".indi_error1").append('ファイルを選択してください');
	} else {
        $(".indi_error1").empty();
    }
	if(indiFile2 == 0){
		$(".indi_error2").empty();
		$(".indi_error2").append('ファイルを選択してください');
	} else {
        $(".indi_error2").empty();
    }
	if(indiFile3 == 0){
		$(".indi_error3").empty();
		$(".indi_error3").append('ファイルを選択してください');
	} else {
        $(".indi_error3").empty();
    }
    
    if (! indiForm.reportValidity()) {
        return false;
    }
    document.forms.indi_form.submit();
}

function clickCorpFormButton() {
    corpFile1 = $("#corp_file1").val().length;
    corpFile2 = $("#corp_file2").val().length;
    corpIbName = $("#corp_ib_name").val();
	
	if(corpFile1 == 0){
        $(".corp_error1").empty();
		$(".corp_error1").append('ファイルを選択してください');
	} else {
        $(".corp_error1").empty();
    }
	if(corpFile2 == 0){
        $(".corp_error2").empty();
		$(".corp_error2").append('ファイルを選択してください');
	} else {
        $(".corp_error2").empty();
    }

    if (! corpForm.reportValidity()) {
        return false;
    }
    document.forms.corp_form.submit();
}

function clickDemoFormButton() {
    if (! demoForm.reportValidity()) {
        return false;
    }
    document.forms.demo_form.submit();
}

function clickContactFormButton() {
    if (! contact_form.reportValidity()) {
        return false;
    }
    document.forms.contact_form.submit();
}

function clickLoginFormButton() {
    if (! document.forms.login_form.reportValidity()) {
        return false;
    }
    document.forms.login_form.submit();
}

