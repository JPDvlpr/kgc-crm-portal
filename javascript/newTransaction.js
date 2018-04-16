$(document).on('click', 'input.category', function (){
    $.ajax({
        type: "POST",
        url: "something.php",
        data: { category: $(this).val() },
        success: function (data) {
            var stuff = data;
        },
        dataType:"json"
    });
});

$(document).on('click', 'input.payMethod', function () {
    if($(this).val() == "check"){

    }
    else if($(this).val() == "credit"){

    }
});