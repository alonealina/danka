function clickAddAcountFormButton() {
    if (! document.forms.add_form.reportValidity()) {
        return false;
    }
    document.forms.add_form.submit();
}

