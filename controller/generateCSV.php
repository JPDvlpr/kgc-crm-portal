<?php
/*
 *  details.php
 *  Cat-Wishes Final Project
 *  IT-328
 *  Melanie Felton
 *
 *  This file is called by the AJAX and retrieves a single item, returns with the HTML formatting
 */
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once("../model/db-object.php");
include_once("../model/db-item.php");
include_once("../model/db-categories.php");
include_once("../model/transaction.php");

$getItems = function ($table, $category) {
//    $transactions = Transaction::getTransactions();
    $transactions = array(array('Mel23', '24', '99'), array('Tye', '67', '25'), array('Kev', '45', '2'), array('Joe', '33', '44'));


    $file = fopen('../files/LATEST_FILE.csv', 'wb');
    $store = array("dont Have", "transaction");
    fputcsv($file, $store);
    foreach ($transactions as $transaction) {
        $store = array("Have", "transaction");
        fputcsv($file, $store);
//        fputcsv($file, $transaction);
    }
    fclose($file);
//    while (!file_exists('../files/LATEST_FILE.csv')) {
//        for ($i = 0; $i < 10; $i++) {
//
//        }
//    }

    $filename = array();
    array_push($filename, array(
        'filename' => 'latestFile.csv'));
    echo $filename;
//    echo json_encode($file);

};
$getItems("item", $_POST['category']);

?>