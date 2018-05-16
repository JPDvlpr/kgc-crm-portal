<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    //include class object
    include_once "classes/contact.php";

//    echo "<h1>I'm Alive!! (in processContact.php)";
//echo "<pre>".print_r($_POST)."</pre>";

    $date = date("Y-m-d");

    //store data from $_POST array to individual variables
    $errors = array();
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
//    $errors = $contact->validateContact($errors);
    if(empty($errors)){
        $contact->saveContact();
    }
    else{
        echo "<pre>".print_r($errors)."</pre>";
    }

?>