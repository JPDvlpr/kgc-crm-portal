var total = 0.00; //total to diplay and add to @ bottom
var rows = 0; //numbers of line items rows, when 0 header should disappear
var valid = false; //check to see if form is valid on server before submitting to server
var optionsString = "<option selected=\"selected\">0</option>";
for(var i = 1; i <= 10; i++)
    optionsString += "<option>"+i+"</option>";

//create initial dialog box
$( function() {
    $( "#dialog" ).dialog({
        autoOpen: false,
        resizable: false,
        modal: true,
        buttons: [
            {
                text: "Confirm",
                "class": 'btn',
                "id": 'confirm',
                click: function() {
                    //delete row from table and hide
                    //table header if there's no rows left
                    $('#delete').remove();
                    rows--;
                    if(rows == 0)
                        $('#lineItems').addClass('hidden');

                    //update total
                    total = 0.00;
                    $('.price').each(function() {
                        if($(this).html() == 'N/A')
                            total += parseInt(0);
                        else
                            total += parseInt($(this).html().slice(1));
                    });
                    $('#total').html('$'+total);

                    $('#dialog').dialog('close');
                }
            },
            {
                text: "Cancel",
                "class": 'btn',
                "id": 'cancel',
                click: function() {
                    $('.delete').removeAttr('id')
                    $('#dialog').dialog('close');
                }
            }
        ]
    });
});

//function to be used to default
//the date to todays date
function defualtDate() {
    var currentDt = new Date();
    var mm =   ("0" + (currentDt.getMonth() + 1)).slice(-2);
    var dd = ("0" + (currentDt.getDate())).slice(-2);
    var yyyy = currentDt.getFullYear();
    var date = yyyy + "-" + mm + '-' + dd;
    $('#date').val(date);
}
defualtDate();


//add drop down to categories(reasons for deposit)
$(document).on('click', 'label.category', function (){
    var category = $(this).attr('id');
    var me = $(this);
    $.ajax({
        type: "POST",
        url: "views/items_temp.php",
        dataType:"json",
        data: { category: category },
        success: function (data) {
            $('.subCategory').remove();
            $('#add').remove();

            if(category == 'Donation'){
                me.after(
                    "<div class='subCategory'>"+
                        "<select id='donation' name='subCategory' class='form-control'>"+
                            "<option id='item'"+
                            "value='5'>Item</option>"+
                            "<option id='cash'"+
                            "value='5'>Cash</option>"+
                        "</select>"+
                        "<select id='quantity' name='quantity' class='form-control'>"+
                            optionsString+
                        "</select>"+
                        "<input id='itemDonation' type='text' class='form-control' placeholder='Donated Item'>" +
                        "<div class='hidden input-group'>"+
                            "<div class='input-group-prepend'>"+
                                "<span class='input-group-text'>$</span>"+
                            "</div>"+
                            "<input id='cashDonation' type='text' class='form-control'>"+
                        "</div>"+
                    "</div>");
            }
            else {
                me.after(
                    "<div class='subCategory'>" +
                        "<select id='quantity' name='quantity' class='form-control'>" +
                            optionsString +
                        "</select>" +
                        "<select id='subCategory' name='subCategory' class='form-control'></select>" +
                    "</div>");
                for (var i = 0; i < data.length; i++) {
                    $('#subCategory').append(
                        "<option value='" + data[i]['item_id'] + "'> " +
                        data[i]['item_name'] + " - $" + data[i]['item_price'] +
                        "  </option>"
                    );
                }
            }
        },
        error: function(xhr, textStatus, thrownError, data) {
            alert("Error: " + thrownError);
        }
    });
});


//add drop downs for check & credit card payment methods
$(document).on('click', 'input.payMethod', function () {
    $('#checkNum, #paypal, #square').addClass('hidden');

    if($(this).val() == "H"){
        $('#checkNum').removeClass('hidden');
    }
    else if($(this).val() == "R"){
        $('#paypal').removeClass('hidden');
        $('#square').removeClass('hidden');
    }
})


//display add button after subcategory is selected
$(document).on('change input', '#quantity, #cashDonation', function () {
    $('#add').remove();

    if(parseInt($('#quantity').val()) > 0 || $('#cashDonation').val())
        $('#categories').append("<button id='add' class='btn btn-success'>Add</button>");
});


//add row to table when add button is clicked
$(document).on('click', '#add', function (e) {
    e.preventDefault();
    var valid = true;
    var category = $('input[name=category]:checked', '#transactionForm').val();
    var desc = $( "select#subCategory option:selected" ).text().split(' - $');
    var selectedId = $( "select#subCategory option:selected" ).val();
    var quantity = 1, price = 'N/A';

    if(category == 'donation'){
        if($("select#donation option:selected").text() == 'Item'){
            quantity = $('select#quantity').val();
            desc = $('#itemDonation').val();
        }

        else {
            price = '$' + $('#cashDonation').val();
            desc = 'Cash'
        }


        if(valid){
            $('#lineItems').after(
                "<tr class='item'>"+
                    "<td class='quantity'>"+quantity+"</td>"+
                    "<td>"+category.substr(0,1).toUpperCase() + category.substr(1)+"</td>"+
                    "<td id='"+selectedId+"' class='selectedId'>"+desc+"</td>"+
                    "<td>"+price+"</td>"+
                    "<td class='price'>"+price+"</td>"+
                    "<td><i class='delete far fa-times-circle'></i></td>"+
                "</tr>"
            );
        }
    }
    else{
        price = desc[1];
        desc = desc[0];
        quantity = $('select#quantity').val();
        if(valid){
            $('#lineItems').after(
                "<tr class='item'>"+
                    "<td class='quantity'>"+quantity+"</td>"+
                    "<td>"+category.substr(0,1).toUpperCase() + category.substr(1)+"</td>"+
                    "<td id='"+selectedId+"' class='selectedId'>"+desc+"</td>"+
                    "<td>$"+price+"</td>"+
                    "<td class='price'>$"+(quantity*price)+"</td>"+
                    "<td><i class='delete far fa-times-circle'></i></td>"+
                "</tr>"
            );
        }
    }

    rows++;
    $('#add').remove();
    $('select#quantity').val(0);
    $('thead#lineItems').removeClass('hidden');
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
    $('#priceError').remove();

    var value = $(this).val(), other;
    if($(this).attr('id') == 'discount')
        other = $('#paid');
    else
        other = $('#discount');


    if(isPrice(value) || $(this).val().length == 0) {
        var value = $(this).val();
        var difference = parseInt($('#total').html().slice(1)) - parseInt(value);
        other.val(difference);
    }
    else{
        $(this).parent().after(
            "<ul id='priceError' class='error'>" +
                "<li>Input must be a number with no more then 2 decimals</li>" +
            "</ul>"
        );
    }

});


//Delete confirmation and functionality
$(document).on('click', '.delete', function () {
    $(this).parent().parent().attr('id', 'delete');
    $('#dialog').dialog('open');
});


// Change text boxes based on if cash or item is selected within donation
$(document).on('change', '#donation', function () {
    $('#add').remove();

    if($(this).find('option:selected').text() == "Item"){
        $('div.subCategory div.input-group').addClass("hidden");

        $('div.subCategory select#quantity').removeClass("hidden");
        $('input#itemDonation').removeClass("hidden");
    }
    else{
        $('div.subCategory select#quantity').addClass("hidden");
        $('input#itemDonation').addClass("hidden");

        $('div.subCategory div.input-group').removeClass('hidden');
    }
});


//validate check number
$(document).on('input', '#checkNum', function () {
    $('#checkError').remove();

    if(!$(this).val().match(/^\d+$/) && $(this).val().length > 0){
        $(this).after(
            "<ul id='checkError' class='error'>" +
                "<li>Input must be a number with no special characters</li>" +
            "</ul>"
        );
    }
});


//validate input before submitting to server
$(document).on('click', '#submit', function (e) {
    //prevent submittion of form
    e.preventDefault()


    //store data in variables
    var adminId, contactId, transDate, transactionItems, transType,
        checkNum, ccType, transDesc, size = 1;

    adminId = $('#adminId').val();
    contactId = $('#contactId').val();
    transDate = $('#date').val();
    transType = $('input[name="payMethod"]:checked').val();
    checkNum = $('#checkNum').val();
    ccType = $('input[name="credit"]:checked').val();
    transDesc = $('#notes').val();


    //get number of transaction items
    $('.item').each(function () {
        size++;
    });

    //initialize 2D array
    transactionItems = new Array(size);
    for (var i = 0; i < size; i++) {
        transactionItems[i] = new Array(2);
    }

    //loop over and retrieve transaction item values
    size = 0;
    $('.item').each(function () {
        $(this).children('td').each(function () {
            if($(this).attr("class") == 'quantity')
                transactionItems[size][0] = $(this).html();
            else if($(this).attr("class") == 'selectedId')
                transactionItems[size][1] = $(this).attr("id");
        });
        size++;
    });
    //add discount to end of array
    transactionItems[transactionItems.length-1][0] = $('#discount').val();
    transactionItems[transactionItems.length-1][1] = 'discount';


    //call validation functions



    if(true){
        $.ajax({
            type: "POST",
            url: "process.php",
            dataType:"json",
            data: { adminId: adminId,
                    contactId: contactId,
                    transDate: transDate,
                    transactionItems: transactionItems,
                    transType: transType,
                    checkNum: checkNum,
                    ccType: ccType,
                    transDesc: transDesc},
            success: function (data) {
                $.each( data, function( i, element ){
                    console.log( element ); // you can see this in the console.
                    // your code here
                });



                //check if any error messages were returned


                //if(valid)
                    //refresh page OR clear all selected fields


                    //display success message

                //else
                    //display errors
            },
            error: function(xhr, textStatus, thrownError, data) {
                alert("Error: " + thrownError);
            }
        });
    }
});