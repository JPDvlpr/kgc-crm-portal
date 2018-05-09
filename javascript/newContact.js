$(document).on('input', '#contactName', function () {
    $("#validName").remove();
    if(!validName($(this).val())){
        $(this).after("<p id='validName'>Checking</p>");
    }
});

$(document).on('input', '#contactAddress', function () {
    $("#errors").remove();
    if(!validAddress($(this).val())){
        $(this).after("<p id='errors'>Checking</p>");
    }
});