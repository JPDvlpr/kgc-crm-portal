//function to be used to default
//the date to todays date
function myFunction() {
    var currentDt = new Date();
    var mm =   ("0" + (currentDt.getMonth() + 1)).slice(-2);
    var dd = currentDt.getDate();
    var yyyy = currentDt.getFullYear();
    var date = yyyy + "-" + mm + '-' + dd;
    document.getElementById("myDate").defaultValue = date;
}

myFunction();
