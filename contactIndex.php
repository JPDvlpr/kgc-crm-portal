<?php
    require_once("views/standard_peices.php");
    require_once("views/newContact.php");
    require_once("processContact.php");
    $errors = array();
    processContact($errors);

    standard_header("New Contact","/kgc-crm-portal-team/styles/contact.css");

    contacts($errors);

    standard_footer("/kgc-crm-portal-team/javascript/newContact.js");
?>