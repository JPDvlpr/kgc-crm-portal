<?php
    require_once("views/standard_peices.php");
    require_once("views/newTransaction.php");

    standard_header("New Transaction","/kgc-crm-portal-team/styles/transactionForm.css");

    transPage();

    standard_footer("/kgc-crm-portal-team/javascript/transactionEvents.js");
?>