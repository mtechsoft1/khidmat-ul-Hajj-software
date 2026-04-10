document.addEventListener('turbo:load', createEditProduct);

function createEditProduct() {
    loadSelect2Dropdown()
    toggleHotelRoomFields();
}

function loadSelect2Dropdown() {
    let categorySelect2 = $('#categoryId, #adminCategoryId');
    if (!categorySelect2.length) {
        return false;
    }

    if ($('#categoryId').hasClass("select2-hidden-accessible") || $('#adminCategoryId').hasClass("select2-hidden-accessible")) {
        $('.select2-container').remove();
    }

    $('#categoryId, #adminCategoryId').select2({
        width: '100%',
    });
}

listenChange('#categoryId, #adminCategoryId', function () {
    toggleHotelRoomFields();
});

function toggleHotelRoomFields() {
    let categoryInput = $('#categoryId').length ? $('#categoryId') : $('#adminCategoryId');
    if (!categoryInput.length || !$('#hotelRoomProductFields').length) {
        return;
    }

    let selectedText = categoryInput.find('option:selected').text() || '';
    let isHotelReservation = selectedText.trim().toLowerCase() === 'hotel reservation';
    $('#hotelRoomProductFields').toggleClass('d-none', !isHotelReservation);
}

listenClick('.remove-image', function () {
    defaultAvatarImagePreview('#previewImage', 1);
});

