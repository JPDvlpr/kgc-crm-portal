<?php
    require_once("views/standard_peices.php");

    standard_header("New Transaction","/kgc-crm-portal-team/styles/transactionForm.css");

    require_once("views/newTransaction.php");

    standard_footer("/kgc-crm-portal-team/javascript/transactionEvents.js");
?>