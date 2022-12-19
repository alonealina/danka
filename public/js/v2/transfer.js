function clickTransferFormButton() {
    if (! document.forms.transfer_form.reportValidity()) {
        return false;
    }
    document.forms.transfer_form.submit();
}