$(document).on('input', '#contactName', function () {
    $("#validName").remove();
    if(!validName($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='validName' class='text-danger'>" +
                "<li>Name cannot have numbers in it</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactAddress', function () {
    $("#errors").remove();
    if(!validAddress($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='errors' class='text-danger'>" +
                "<li>Address must be less than 200 characters</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactCity', function () {
    $("#errors").remove();
    if(!validCity($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='errors' class='text-danger'>" +
                "<li>City must be less than 45 characters with no numbers</li>" +
            "</ul>");
    }
});

$(document).on('input', '#contactZipCode', function () {
    $("#errors").remove();
    if(!validZip($(this).val()) && $(this).val().length > 0){
        $(this).after("<ul id='errors' class='text-danger'>" +
                "<li>Zip can't be more than 10 numbers and can't contain letters</li>" +
            "</ul>");
    }
});