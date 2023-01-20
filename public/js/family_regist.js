function clickTextStoreButton() {
    document.forms.danka_store_form.submit();
}

function clickAddButton() {
    var clone = $('#family_item').clone(true);
    clone.find('input[type="text"]').val('');
    clone.appendTo('#family_form');
};