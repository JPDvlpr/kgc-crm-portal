<?php
/*
 *  generateCSV.php
 *  KGC CRM Portal
 *  IT-355
 *  Just oK TeaM
 *
 *  This file is called by the AJAX, creates a csv file, and returns with that files name
 *  It loops through a series of 6 filenames so that the multiple users can create files at
 *  once.
 */
include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-transaction.php");

$getCSVFile = function ($table, $category) {
    $fileName = $_POST['filteringData']['filters']['filename'];
    $filters = $_POST['filteringData']['filters'];
    unset($filters['filename']);
    var_dump($filters);
//    $transactions = Transaction::getTransactions($filters);
//    $transactions = array(array('Mel23', '24', '99'), array('Tye', '67', '25'), array('Kev', '45', '2'), array('Joe', '33', '44'));
//    $fileName = "LATEST_FILE";
    $transactions = DBTransaction::getFilteredTransactions($filters);
    $count = 100;
    $fileNameTemp = $fileName.$count.".csv";

    //increment file number and delete oldest...
    // currently only allowing at most 6 files to exist

    //find an unused name
    while (file_exists('../files/'.$fileNameTemp)) {
        $count++;
        $fileNameTemp = $fileName.$count.".csv";
    }
    //look to see if there is one 5 iterations older
    //May need to be removed because it may cause trouble for two users - should test with
    //two users
    //or if we have looped around, then the next one
    if (file_exists('../files/'.$fileName . ($count - 5).".csv")) {
        unlink('../files/'.$fileName . ($count - 5).".csv");
    }
    elseif (file_exists('../files/'.$fileName . ($count + 1).".csv")) {
        unlink('../files/'.$fileName . ($count + 1).".csv");
    }

    //assign new name to $fileName
    $fileName = $fileNameTemp;

    //open file
    $file = fopen('../files/'.$fileName, 'wb');
    //store column headers
    $store = array("Transaction Number", "Contact Name");
    fputcsv($file, $store);

    //store column values
    foreach ($transactions as $transaction) {
        $store = array($transaction['Transaction Number'],$transaction['Contact Name']);
        fputcsv($file, $store);
//        fputcsv($file, $transaction);
    }

    // close file and return correct filename
    fclose($file);
    echo $fileName;

};
$getCSVFile("item", $_POST['category']);

?>