function isInt(integer) {
    if(Math.floor(integer) == integer && $.isNumeric(integer))
        return true;
    else
        return false;
}

//validates the year is a valid year
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

//validates that name is valid
function validName(name) {
    if(isEmptyString(name)) return false;
    if(name.match(/^[^ \d \? \!](\s|\w){0,200}$/)){
        return true;
    }
    return false;
}

//validates that address is valid
function validAddress(address) {
    if(isEmptyString(address)) return false;
    if(address.match(/^(\w|\d|\s|(?:[' . # -])){0,200}$/)){
        return true;
    }
    return false;
}

//validates that city is valid
function validCity(city) {
    if(isEmptyString(city)) return false;
    if(city.match(/^(\w|\s)\D{0,45}$/)){
        return true;
    }
    return false;
}

//validates that zip code is valid
function validZip(zip) {
    if(isEmptyString(zip))return false;
    if(zip.match(/^\d{5}(-?\d{4})?$/)){
        return true;
    }
    return false;
}

//validates that phone is valid
function validPhone(phone) {
    if(isEmptyString(phone)) return false;
    if(phone.match(/^\d{10}$/)){
        return true
    }
    return false;
}

//validates that email is valid
function validEmail(email) {
    if(isEmptyString(email)) return false;
    if(email.match(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/)){
        return true;
    }
    return false;
}