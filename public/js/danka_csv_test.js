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





function ShipmentStoreButton() {
    error_flg = 0;

    if (regist_form.csv.value == "") {
        error_flg = 1;
    }

    if (!error_flg) {
        document.forms.regist_form.submit();
    }

}

