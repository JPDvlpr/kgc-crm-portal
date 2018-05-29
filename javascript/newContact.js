$(document).on('input', '#contactName', function () {
    $("#validName").remove();
    if(!validName($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='validName' class='error'>" +
                "<li>Name cannot have numbers in it</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactAddress', function () {
    $("#addressErrors").remove();
    if(!validAddress($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='addressErrors' class='error'>" +
                "<li>Address must be less than 200 characters and can't have Quotes in it</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactCity', function () {
    $("#cityErrors").remove();
    if(!validCity($(this).val()) && $(this).val().length > 0){
        $("#contactZipCode").after("<ul id='cityErrors' class='error'>" +
                "<li>City must be less than 45 characters with no numbers</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactZipCode', function () {
    $("#zipCodeErrors").remove();
    if(!validZip($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='zipCodeErrors' class='error'>" +
                "<li>Zip can't be less thane 5 or more than 10 numbers and can't contain letters</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactCellPhone', function () {
    $("#cellPhoneError").remove();
    if(!validPhone($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='cellPhoneError' class='error'>" +
                "<li>Phone number cannot contain letters</li>" +
            "</ul>")
    }
});

$(document).on('input', '#contactPhone', function () {
    $("#otherPhoneError").remove();
    if(!validPhone($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='otherPhoneError' class='error'>" +
            "<li>Phone number cannot contain letters</li>" +
            "</ul>")
    }
});

$(document).on('input', '#altPhone', function () {
    $("#altPhoneError").remove();
    if(!validPhone($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='altPhoneError' class='error'>" +
            "<li>Phone number cannot contain letters</li>" +
            "</ul>")
    }
});

$(document).on('input', '#contactEmail', function () {
    $("#emailError").remove();
    if(!validEmail($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='emailError' class='error'>" +
            "<li>Invalid Email</li>" +
            "</ul>")
    }
});

$(document).on('input', '#contactAltName', function () {
    $("#altNameError").remove();
    if(!validName($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='altNameError' class='error'>" +
            "<li>Name cannot have numbers in it</li>" +
            "</ul>");
    }
});

$(document).on('click', '#submint', function (e) {

    valid = true;

    if($('.error').length)
        valid = false;

    if(!valid)
        e.preventDefault();

});