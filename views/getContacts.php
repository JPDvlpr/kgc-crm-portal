<?php
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    include_once("../classes/contact.php");

    $results = Contact::getContacts();

    echo json_encode($results);
?>