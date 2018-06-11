var total = 0.00; //total to diplay and add to @ bottom
var rows = 0; //numbers of line items rows, when 0 header should disappear
var valid = false; //check to see if form is valid on server before submitting to server
var currentYear = parseInt((new Date).getFullYear()); //get current year for future display
var contacts = [], admins = []; //variable to store contacts & admins (2d array) from database

//create string to generate options for quantity select tags
var optionsString = "<option selected=\"selected\">Qty</option>";
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

//Get initial contacts and add them to datalist
$.ajax({
    type: "POST",
    url: "views/getContacts.php",
    dataType: "json",
    success: function (data) {
        for(var i = 0; i < data.length; i++){
            $('#contacts').append("<option value='"+data[i]['name']+"'></option>");
            contacts.push(data[i]);
        }
    },
    error: function (xhr, textStatus, thrownError, data) {
        alert("Error: " + thrownError);
    }
});


//wait for user to enter contact then fill in
//the contacts information
$(document).on('input', '#chosenContact', function () {
    for(var i = 0; i < contacts.length; i++){
        if($(this).val() == contacts[i]['name']){
            $('#contactIdError').html('');
            $('#contactIdError').addClass('hidden');

            $('#conEmail').html("Email: "+contacts[i]['email']);
            $('#conCell').html("Cell Phone: "+contacts[i]['cell']);
            $('#conPhone').html("Other Phone: "+contacts[i]['phone']);
            $('#conAddress').html("Address: "+contacts[i]['address']);
            $('#altName').html("Alternate Contact Name: "+contacts[i]['altName']);
            $('#altPhone').html("Alternate Contact Phone: "+contacts[i]['altPhone']);
            $('#conEmail').removeClass('hidden');
            $('#conCell').removeClass('hidden');
            $('#conPhone').removeClass('hidden');
            $('#conAddress').removeClass('hidden');
            $('#altName').removeClass('hidden');
            $('#altPhone').removeClass('hidden');
            break;
        }
        else{
            $('#conEmail').html('');
            $('#conCell').html('');
            $('#conPhone').html('');
            $('#conAddress').html('');
            $('#altName').html('');
            $('#altPhone').html('');
            $('#conEmail').addClass('hidden');
            $('#conCell').addClass('hidden');
            $('#conPhone').addClass('hidden');
            $('#conAddress').addClass('hidden');
            $('#altName').addClass('hidden');
            $('#altPhone').addClass('hidden');
        }
    }
});


//add drop down to categories(reasons for deposit)
$(document).on('click', 'label.category', function (){
    var category = $(this).attr('id');
    var me = $(this);
    $.ajax({
        type: "POST",
        url: "views/items.php",
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
    $('#checkNum, #paypal, #square, #checkNumError').addClass('hidden');
    $('#transTypeError').html('');
    $('#transTypeError').addClass('hidden');

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

    if(category == 'Donation'){
        selectedId = $( "select#donation option:selected" ).val();
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
    $('#itemError').html('');
    $('#itemError').addClass('hidden');
    $('#add').remove();
    $('select#quantity').val('Qty');
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
    $('#'+$(this).attr('id')+'Error').remove();
    $('#amountError').html('');
    $('#amountError').addClass('hidden');

    var value = $(this).val(), other;
    if($(this).attr('id') == 'discount')
        other = $('#paid');
    else
        other = $('#discount');


    if(isPrice(value) || $(this).val().length == 0) {
        var value = $(this).val();
        var difference = parseFloat($('#total').html().slice(1)) - parseFloat(value);
        if(isNaN(difference) && !value.length){
            other.val('');
            $('#'+other.attr('id')+'Error').remove();
        }
        else if(!isNaN(difference))
            other.val(Math.round(difference * 100) / 100);
    }
    else{
        $(this).parent().after(
            "<ul id='"+$(this).attr('id')+"Error' class='error'>" +
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


//Date validation on input
$(document).on('change', '#date', function () {
    //remove existing error message
    $('#dateError').remove();

    //get date from element
    var date = $(this).val().split("-", 3);
    valid = true

    //check that day, month, and year are integers
    for(var i = 0; i < 3; i++){
        if(!isInt(date[i])){
            valid = false;
            break;
        }
    }

    //check that year is resonable
    if(valid && !validYear(date[0]))
        valid = false;


    //if invalid date, display error
    if(!valid){
        $(this).after(
            "<ul id='dateError' class='error'>" +
                "<li>Date must be valid with a year between 2006 and "+(currentYear+1)+"</li>" +
            "</ul>"
        );
    }
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
    valid = true;


    //store data in variables
    var adminId, contactId, transDate, transactionItems, amountPaid,
        transType, checkNum, ccType, transDesc, size = 1;


    adminId = $('#adminId').val();

    contactId = -1;
    for(var i = 0; i < contacts.length; i++) {
        if ($('#chosenContact').val() == contacts[i]['name'])
            contactId = contacts[i]['id'];
    }
    transDate = $('#date').val();
    amountPaid = $('#paid').val();
    transType = $('input[name="payMethod"]:checked').val();
    checkNum = $('#checkNum').val();
    ccType = $('input[name="credit"]:checked').val();
    transDesc = $('#notes').val();

    //get info for check #
    if(transType == 'H')
        checkNum = $('#checkNum').val();
    else
        checkNum = 'N/A';
    //get info for credit
    if(transType == 'R')
        ccType = $('input[name="credit"]:checked').val();
    else
        ccType = 'N/A';

    //get number of transaction items
    $('.item').each(function () {
        size++;
    });

    //initialize 2D array
    transactionItems = new Array(size);
    for (var i = 0; i < size; i++) {
        transactionItems[i] = new Array(4);
    }

    //loop over and retrieve transaction item values
    size = 0;
    $('.item').each(function () {
        $(this).children('td').each(function () {
            if($(this).attr("class") == 'quantity')
                transactionItems[size][1] = $(this).html();
            else if($(this).attr("class") == 'price'){
                if($(this).html() == 'N/A')
                    transactionItems[size][2] = 0;
                else
                    transactionItems[size][2] = $(this).html().slice(1);
            }
            else if($(this).attr("class") == 'selectedId') {
                transactionItems[size][0] = $(this).attr("id");
                if($(this).attr("id") == 5)
                    transactionItems[size][3] = $(this).html();
                else
                    transactionItems[size][3] = '';
            }
        });
        size++;
    });
    //add discount to end of array
    transactionItems[transactionItems.length-1][0] = 17; // transaction id is 1 for discount
    transactionItems[transactionItems.length-1][1] = 1; // quantity is 1 for discount
    transactionItems[transactionItems.length-1][2] = $('#discount').val(); // amount is variable for discount
    transactionItems[transactionItems.length-1][3] = ''; // description is discount

    //check to see if any error messages are displaying
    $('.error').each(function () {
        if($(this).html().trim() != '')
            valid = false;
    });

    //TODO - validate that required fields are filled in


    //submit to database if passed validation
    if(valid){
        $.ajax({
            type: "POST",
            url: "controller/processTransaction.php",
            dataType:"json",
            data: { adminId: adminId,
                    contactId: contactId,
                    transDate: transDate,
                    transactionItems: transactionItems,
                    amountPaid: amountPaid,
                    transType: transType,
                    checkNum: checkNum,
                    ccType: ccType,
                    transDesc: transDesc },
            success: function (data) {
                if(data === 1){
                    //refresh page OR clear all selected fields
                    location.reload();

                    //display success message
                    //TODO - format success message to look nicer/be more user friendly
                    alert("Your form was submitted successfully.");
                }
                else{
                    //display errors
                    $('.error').each(function () {
                        if($(this).attr('id') in data){
                            $(this).html("<li>"+data[$(this).attr('id')]+"</li>");
                            $(this).removeClass('hidden');
                        }
                        else{
                            $(this).addClass('hidden');
                        }
                    });
                }
            },
            error: function(xhr, textStatus, thrownError, data) {
                alert("Error: " + thrownError);
            }
        });
    }
});