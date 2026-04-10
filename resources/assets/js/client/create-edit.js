document.addEventListener('turbo:load', createEditClient);

function createEditClient() {
    loadSelect2Dropdown()
    setEditCountryId()
}

function loadSelect2Dropdown() {
    let countyIdDropdownSelector = $('#countryID');
    if (!countyIdDropdownSelector.length) {
        return false;
    }

    if ($('#countryID').hasClass("select2-hidden-accessible")) {
        $('.select2-container').remove();
    }
    if ($('#stateID').hasClass("select2-hidden-accessible")) {
        $('.select2-container').remove();
    }

    $('#countryID').select2({
        width: '100%',
    });
}

listenClick('.remove-image', function () {
    defaultAvatarImagePreview('#previewImage', 1);
});

listenSubmit('#clientForm, #editClientForm', function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus();
        return false;
    }
});

function setEditCountryId() {
    if ($('#countryId').val()) {
        $('#countryId').val($('#countryId').val()).trigger('change');
    }
}
