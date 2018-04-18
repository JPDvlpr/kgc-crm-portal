var optionsString = ""
for(var i = 1; i <= 10; i++)
    optionsString += "<option>"+i+"</option>";

//add drop down to categories(reasons for deposit)
$(document).on('click', 'label.category', function (){
    var category = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "http://troemer.greenriverdev.com/355/kgc-crm-portal-team/views/skus_temp.php",
        dataType:"json",
        data: { category: category },
        success: function (data) {
            $('.subCategory').remove();
            if(category == 'class' || category == 'event'){
                for(var i = 0; i < data.length; i++) {
                    $('#' + category).after(
                        "<div class='radio subCategory'>" +
                            "<label><input type='radio' name='class' " +
                                "value='" + data[i]['sku_id'] + "'> " +
                                data[i]['name'] + " - $" + data[i]['price'] +
                            "  </label>" +
                            "<select name='quantity'>" +
                                optionsString +
                            "</select>" +
                        "</div>");
                }
            }
            else if(category == 'donation'){
                $('#'+category).after(
                    "<div class='radio subCategory'>"+
                        "<label class=''><input id='cash' type='radio' name='donation' "+
                        "value='"+data[1]['sku_id']+"'> "+data[1]['name']+"  </label>"+
                        "<div class='input-group'>"+
                            "<div class='input-group-prepend'>"+
                                "<span class='input-group-text'>$</span>"+
                            "</div>"+
                            "<input id='cashDonation' type='text' class='form-control'>"+
                        "</div>"+
                    "</div>");
                $('#'+category).after(
                    "<div class='radio subCategory'>"+
                        "<label><input id='item' type='radio' name='donation' "+
                        "value='"+data[0]['sku_id']+"'> "+data[0]['name']+"  </label>"+
                        "<select name='quantity'>"+
                            optionsString+
                        "</select>"+
                        "<input id='itemDonation' type='text' class='form-control' placeholder='Donated Item'> "+
                    "</div>");
            };
        },
        error: function(xhr, textStatus, thrownError, data) {
            alert("Error: " + thrownError);
        }
    });
});

//when amount/description is typed in for item or cash donation it will
//automatically click radio button(if it isn't already).
$(document).on('input', '#itemDonation, #cashDonation', function () {
    var radioButton = $(this).attr('id').substring(0,4);
    $("#"+radioButton).prop("checked", true);
});

//add drop downs for check & credit card payment methods
$(document).on('click', 'input.payMethod', function () {
    $('.hidden').css("display", "none");

    if($(this).val() == "check"){
        $('#checkNum').css("display", "block");
    }
    else if($(this).val() == "credit"){
        $('#paypal').css("display", "block");
        $('#square').css("display", "block");
    }
})

//display add button after subcategory is selected
$(document).on('click', '.subcategory', function () {

});