// 以下情報バー切り替えについて
let shipmentBtn = document.getElementById("shipment_btn");
let itemBtn = document.getElementById("item_btn");
let textBtn = document.getElementById("text_btn");
let shipmentDiv = document.getElementById("shipment_div");
let itemDiv = document.getElementById("item_div");
let textDiv = document.getElementById("text_div");

function ShipmentButton() {
    shipmentBtn.classList.add("current_category");
    itemBtn.classList.remove("current_category");
    textBtn.classList.remove("current_category");
    shipmentDiv.hidden = false;
    itemDiv.hidden = true;
    textDiv.hidden = true;
};

function ItemButton() {
    shipmentBtn.classList.remove("current_category");
    itemBtn.classList.add("current_category");
    textBtn.classList.remove("current_category");
    shipmentDiv.hidden = true;
    itemDiv.hidden = false;
    textDiv.hidden = true;
};

function TextButton() {
    shipmentBtn.classList.remove("current_category");
    itemBtn.classList.remove("current_category");
    textBtn.classList.add("current_category");
    shipmentDiv.hidden = true;
    itemDiv.hidden = true;
    textDiv.hidden = false;
};





function categoryStoreButton() {
    error_flg = 0;

    if (category_store_form.name.value == "") {
        $('#name_error').css( 'display', 'block' );
        $('.check_error').css( 'display', 'none' );
        $('.category_name_text').css( 'background', '#FAF1F1' );
        error_flg = 1;
    } else {
        $('#name_error').css( 'display', 'none' );
        $('.check_error').css( 'display', 'none' );
        $('.category_name_text').css( 'background', '#F7F7F7' );
    }

    if (!error_flg) {
        document.forms.category_store_form.submit();
    }

}

