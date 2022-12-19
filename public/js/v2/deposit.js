let bankBtn2 = document.querySelector(".bank_btn2");
let cryptoBtn2 = document.querySelector(".crypto_btn2");
let bankDiv2 = document.getElementById("bank_div2");
let cryptoDiv2 = document.getElementById("crypto_div2");

bankBtn2.addEventListener("click", function () {
    bankBtn2.classList.remove("not");
    cryptoBtn2.classList.add("not");
    bankDiv2.hidden = false;
    cryptoDiv2.hidden = true;
});

cryptoBtn2.addEventListener("click", function () {
    bankBtn2.classList.add("not");
    cryptoBtn2.classList.remove("not");
    bankDiv2.hidden = true;
    cryptoDiv2.hidden = false;
});

function clickCryptoPaymentFormButton() {
    document.forms.crypto_payment_form.submit();
}

function clickTxidButton() {
    if (! document.forms.txid_form.reportValidity()) {
        return false;
    }
    document.forms.txid_form.submit();
}

function clickBankWithdrawFormButton() {
    if (! document.forms.bank_withdraw_form.reportValidity()) {
        return false;
    }
    document.forms.bank_withdraw_form.submit();
}

function clickCryptoWithdrawFormButton() {
    document.forms.crypto_withdraw_form.submit();
}