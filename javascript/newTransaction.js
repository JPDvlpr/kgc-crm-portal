var optionsString = "<option selected=\"selected\">0</option>";
var total = 0.00;
for(var i = 1; i <= 10; i++)
    optionsString += "<option>"+i+"</option>";


//function to be used to default
//the date to todays date
function myFunction() {
    var currentDt = new Date();
    var mm =   ("0" + (currentDt.getMonth() + 1)).slice(-2);
    var dd = currentDt.getDate();
    var yyyy = currentDt.getFullYear();
    var date = yyyy + "-" + mm + '-' + dd;
    $('#date').val(date);
}
myFunction();


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
            $('#add').remove();
            if(category == 'class' || category == 'event'){
                $('#' + category).after(
                    "<div class='subCategory'>"+
                        "<select id='quantity' name='quantity' class='form-control'>" +
                            optionsString +
                        "</select>"+
                        "<select id='subCategory' name='subCategory' class='form-control'></select>"+
                    "</div>");
                for(var i = 0; i < data.length; i++) {
                    $('#subCategory').append(
                        "<option value='" + data[i]['sku_id'] + "'> " +
                            data[i]['name'] + " - $" + data[i]['price'] +
                        "  </option>"
                    );
                }
            }
            else if(category == 'donation'){
                $('#'+category).after(
                    "<div class='radio subCategory'>"+
                        "<label><input id='cash' type='radio' name='subCategory' "+
                        "value='"+data[1]['sku_id']+"' desc='" +
                        data[1]['name']+"'> "+data[1]['name']+"  </label>"+
                        "<div class='input-group'>"+
                            "<div class='input-group-prepend'>"+
                                "<span class='input-group-text'>$</span>"+
                            "</div>"+
                            "<input id='cashDonation' type='text' class='form-control'>"+
                        "</div>"+
                    "</div>");
                $('#'+category).after(
                    "<div class='radio subCategory'>"+
                        "<label><input id='item' type='radio' name='subCategory' "+
                        "value='"+data[0]['sku_id']+"' desc='" +
                        data[0]['name']+"'> "+data[0]['name']+"  </label>"+
                        "<select id='quantity' name='quantity'>"+
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
$(document).on('change', '#quantity', function () {
    if(parseInt($('#quantity').val()) > 0) {
        $('#add').remove();
        $('#categories').append("<button id='add' class='btn btn-success'>Add</button>");
    }
});


//add row to table when add button is clicked
$(document).on('click', '#add', function (e) {
    e.preventDefault();
    var valid = true;
    var category = $('input[name=category]:checked', '#transactionForm').val();
    var desc = $( "#quantity option:selected" ).text().split(' - $');
    alert(desc);
    var quantity = 1, price = 'N/A';

    if(category == 'donation'){
        if(desc == 'Item'){
            quantity = $('select#quantity').val();
            desc = $('#itemDonation').val();
        }

        else
            price = '$' + $('#cashDonation').val();

        // alert(category + " : " + id + " : " + desc + " : " + quantity + " : " + price);

        if(valid){
            $('#lineItems').after(
                "<tr>"+
                    "<td>"+quantity+"</td>"+
                    "<td>"+category+"</td>"+
                    "<td>"+desc+"</td>"+
                    "<td>"+price+"</td>"+
                    "<td class='price'>"+price+"</td>"+
                    "<td class='delete'>X</td>"+
                "</tr>"
            );
        }
    }
    else{
        price = $('input[name=subCategory]:checked', '#transactionForm').attr('price');
        quantity = $('select#quantity').val();
        if(valid){
            $('#lineItems').after(
                "<tr>"+
                "<td>"+quantity+"</td>"+
                "<td>"+category+"</td>"+
                "<td>"+desc+"</td>"+
                "<td>$"+price+"</td>"+
                "<td class='price'>$"+(quantity*price)+"</td>"+
                "<td class='delete'>X</td>"+
                "</tr>"
            );
        }
    }

    $('#add').remove();
    $('select#quatity').val(0);
    $('thead.hidden').removeClass('hidden');
    total = 0.00;
    $('.price').each(function() {
        if($(this).html() == 'N/A')
            total += parseInt(0);
        else
            total += parseInt($(this).html().slice(1));
    });
    $('#total').html('$'+total);
});


//auto generate discount/amount paid based on the others input
$(document).on('input', '#paid, #discount', function () {
    var value = $(this).val();
    var other = parseInt($('#total').html().slice(1)) - parseInt(value);
    if($(this).attr('id') == 'discount')
        $('#paid').val(other);
    else
        $('#discount').val(other);
});