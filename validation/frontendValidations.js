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
