// /*
//   Need to comment this and continue creating validations.
//   Need to figure out how to test what I have.
//  */
//
// function depositbyValidation(depositBy){
//     var depositBy = document.forms["transactionForm"]["depositby"].value;
//
//     if(!emptyStringPrevalidation(depositBy)){
//         return "Deposit By is required";
//     }
//     if(!alphStringPrevalidation(depositBy) ){
//         return "Name contained nonAlphabetical call"
//     }
// }
//
// function dateValidation(date){
//     var date = document.forms["transactionForm"]["date"].value;
// }
//
// function categoryValidation(category){
//     if(!emptyStringPrevalidation(category)){
//         return "Deposit By is required";
//     }
//     if(!alphStringPrevalidation(category) ){
//         return "Name contained nonAlphabetical call";
//     }
// }
//
// function quantityValidation(quantity){
//     return false;
// }
//
// function descriptionValidation(description){
//     return false;
// }
//
// function unitPriceValidation(unitPrice){
//     return priceValidation(unitPrice);
// }
//
// function totalPriceValidation(totalPrice){
//     return priceValidation(totalPrice);
// }
//
// function amountPaidOrDiscountValidation(amount){
//     return priceValidation(amount);
// }
//
// function paymentTypeValidation(type){
//     var types = ["Cash", "Check", "Credit Card"];
//     if(types.indexOf("type") >= 0){
//         return true;
//     };
//     return false
// }
//
function isInt(integer) {
    if(Math.floor(integer) == integer && $.isNumeric(integer))
        return true;
    else
        return false;
}

function validYear(year) {
    var currentYear = parseInt((new Date).getFullYear());
    year = parseInt(year);

    if(year < 2006 || year > (currentYear+1))
        return false;
    else
        return true;
}

function isPrice(price){

        if(price.match(/^\d+\.?\d{0,2}$/) ){
            return true;
        }
        return false;

}

function isEmptyString(anyString){
    if (anyString == "") {
        return true;
    }
    return false;
}

function isAlphString(anyString){
    if(isEmptyString(anyString)) return false;
    if(anyString.match(/^[a-zA-Z]+$/) ){
        return true;
    }
    return false;
}

//included for debugging use
function sayHelloscript(){
    alert("Hello");
}

function validName(name) {
    if(isEmptyString(name)) return false;
    if(name.match(/^\D(\w|\s|(?:[' -])){0,200}$/)){
        return true;
    }
    return false;
}

function validAddress(address) {
    if(isEmptyString(address)) return false;
    if(address.match(/^(\w|\d|\s|(?:[' . # -])){0,200}$/)){
        return true;
    }
    return false;
}

function validCity(city) {
    if(isEmptyString(city)) return false;
    if(city.match(/^\D(\w|\s){0,45}$/)){
        return true;
    }
    return false;
}

function validZip(zip) {
    if(isEmptyString(zip))return false;
    if(zip.match(/^\d{5}(-?\d{4})?$/)){
        return true;
    }
    return false;
}

function validPhone(phone) {
    if(isEmptyString(phone)) return false;
    if(phone.match(/^\d{10}$/)){
        return true
    }
    return false;
}

function validEmail(email) {
    if(isEmptyString(email)) return false;
    if(email.match(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/)){
        return true;
    }
    return false;
}