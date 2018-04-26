<?php
    require_once("views/standard_peices.php");
    standard_header("sample","");

    if(!empty($_POST)){
        $transaction = new Transaction();
        $transaction->validateTransaction();
        $transaction->saveTransaction();
    }
    require_once("views/newTransaction.php");

    standard_footer();
?>