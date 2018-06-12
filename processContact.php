<?php
//    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

function processContact(&$errors)
{
    //include class object
    include_once "classes/contact.php";
    include_once "validation/backendValidations.php";

    if (isset($_POST['submit'])) {
        $date = date("Y-m-d H:i:s");

        //store data from $_POST array to individual variables
        $contCreatedBy = $_POST['contactCreatedBy'];
        $contactName = $_POST['name'];
        $contactAddress = $_POST['address'];
        $contactCity = $_POST['city'];
        $contactState = $_POST['state'];
        $contactZip = $_POST['zipCode'];
        $contactCellPhone = $_POST['cellPhone'];
        $contactOtherPhone = $_POST['phone'];
        $contactEmail = $_POST['email'];
        $alternateContName = $_POST['altName'];
        $alternateContPhone = $_POST['altPhone'];

        //create object
        $contact = new Contact($date, $contCreatedBy, $contactName, $contactAddress, $contactCity,
            $contactState, $contactZip, $contactOtherPhone, $contactCellPhone, $contactEmail,
            $alternateContName, $alternateContPhone);
        $errors = $contact->validateContact($errors);
        if (empty($errors)) {
            $contact->saveContact();
            header("location:index.php");
        }
    }
}

?>