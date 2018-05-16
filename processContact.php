<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    //include class object
    include_once "classes/contact.php";

    $date = date("Y-m-d");

    //store data from $_POST array to individual variables
    $errors = array();
    $contCreatedBy = $_POST['adminIdContact'];
    $contactName = $_POST['contactName'];
    $contactAddress = $_POST['contactAddress'];
    $contactCity = $_POST['contactCity'];
    $contactState = $_POST['states'];
    $contactZip = $_POST['contactZipCode'];
    $contactCellPhone = $_POST['cellPhone'];
    $contactOtherPhone = $_POST['otherPhone'];
    $contactEmail = $_POST['contactEmail'];
    $alternateContName = $_POST['contactAltName'];
    $alternateContPhone = $_POST['altPhone'];

    //create object
    $contact = new Contact($date, $contCreatedBy, $contactName, $contactAddress, $contactCity,
        $contactState, $contactZip, $contactOtherPhone, $contactCellPhone, $contactEmail,
        $alternateContName, $alternateContPhone);
    $errors = $contact->validateContact($errors);
    if(empty($errors)){
        $contact->saveContact();
    }
    else{
        echo ($errors);
    }
?>