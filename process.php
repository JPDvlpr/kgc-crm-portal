<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    //include class object
    include_once "classes/transaction.php";

    //store data from $_POST array to individual vars
    $errors = array();
    $createdBy = $_POST['adminId'];
    $contactId = $_POST['contactId'];
    $transDate = $_POST['transDate'];
    $transactionItemsArray = $_POST['transactionItems'];
    $amount = $_POST['amountPaid'];
    $transType = $_POST['transType'];
    $checkNum = $_POST['checkNum'];
    $ccType = $_POST['ccType'];
    $transDesc = $_POST['transDesc'];

    //create object
    $transaction = new Transaction($createdBy, $contactId, $transDate, $transactionItemsArray, $amount,  $transDesc, $transType,  $checkNum, $ccType);
    $errors = $transaction->validateTransaction($errors);
    if(empty($errors)){
        $transaction->saveTransaction();
        echo json_encode(1);
    }
    else
        echo json_encode($errors);
?>