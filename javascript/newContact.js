$(document).on('input', '#contactName', function () {
    $("#validName").remove();
    $("#reqName").remove();
    if(!validName($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='validName' class='error'>" +
                "<li>Name cannot have numbers in it</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactAddress', function () {
    $("#addressErrors").remove();
    $("#reqAddress").remove();
    if(!validAddress($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='addressErrors' class='error'>" +
                "<li>Address must be less than 200 characters and can't have Quotes in it</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactCity', function () {
    $("#cityErrors").remove();
    $("#reqCity").remove();
    if(!validCity($(this).val()) && $(this).val().length > 0){
        $("#contactZipCode").after("<ul id='cityErrors' class='error'>" +
                "<li>City must be less than 45 characters with no numbers</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactZipCode', function () {
    $("#zipCodeErrors").remove();
    $("#reqZip").remove();
    if(!validZip($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='zipCodeErrors' class='error'>" +
                "<li>Zip can't be less than 5 or more than 10 numbers and can't contain letters</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactCellPhone', function () {
    $("#cellPhoneError").remove();
    $("#reqPhone").remove();
    if(!validPhone($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='cellPhoneError' class='error'>" +
                "<li>Phone number cannot contain letters</li>" +
            "</ul>")
    }
});

$(document).on('input', '#contactPhone', function () {
    $("#otherPhoneError").remove();
    $("#reqPhone").remove();
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
    $("#reqEmail").remove();
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

$(document).on('click', '#submit', function (e) {

    valid = true;

    if($('.error').length)
        valid = false;

    if(isEmptyString($('#contactName').val())){
        $("#reqName").remove();
        $('#contactName').after("<ul id='reqName' class='error'>" +
            "<li>Name is required</li>" +
            "</ul>");

        valid = false;
    }

    if(isEmptyString($('#contactAddress').val())){
        $("#reqAddress").remove();
        $('#contactAddress').after("<ul id='reqAddress' class='error'>" +
            "<li>Address is required</li>" +
            "</ul>");

        valid = false;
    }

    if(isEmptyString($('#contactCity').val())){
        $("#reqCity").remove();
        $('#contactCity').after("<ul id='reqCity' class='error'>" +
            "<li>City is required</li>" +
            "</ul>");

        valid = false;
    }

    if(isEmptyString($('#contactZipCode').val())){
        $("#reqZip").remove();
        $('#contactZipCode').after("<ul id='reqZip' class='error'>" +
            "<li>Zip code is required</li>" +
            "</ul>");

        valid = false;
    }

    if(isEmptyString($('#contactCellPhone').val() && isEmptyString($('#contactPhone').val()))){
        $("#reqPhone").remove();
        $('#contactPhone').after("<ul id='reqPhone' class='error'>" +
            "<li>At least one phone number is required</li>" +
            "</ul>");

        valid = false;
    }

    if(isEmptyString($('#contactEmail').val())){
        $("#reqEmail").remove();
        $('#contactEmail').after("<ul id='reqEmail' class='error'>" +
            "<li>Email is required</li>" +
            "</ul>");

        valid = false;
    }

    if(!valid)
        e.preventDefault();
    else
        alert('Your form was submitted successfully.');

});