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
function priceValidation(price){

        if(price.match(/^\d+\.?\d{0,2}$/) ){
            return true;
        }
        return false;

}
//
//
//
// function emptyStringPrevalidation(anyString){
//     if (anyString == "") {
//         return false;
//     }
//     return true;
// }
//
function alphStringPrevalidation(anyString){
    if(anyString.match(/^[a-zA-Z]+$/) ){
        return true;
    }
    return false;
}

function sayHelloscript(){
    alert("Hello");
}
