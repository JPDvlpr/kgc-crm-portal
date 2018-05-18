<?php

    include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/classes/contact.php");

    $results = Contact::getContacts();

    echo json_encode($results);
?>