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
//    $fileName = $_POST['filteringData']['filters']['filename'];
    $fileName = $_POST['filteringData']['filename'];
    $filters = $_POST['filteringData']['filters'];
    unset($filters['filename']);
    if(strcmp(trim($fileName),"") == 0){
        $fileName = "KGC_data";
    }
    $transactions = DBTransaction::getFilteredTransactions($filters);
    date_default_timezone_set('America/Los_Angeles');
    $count = date("_Y_M_d_H_i_s");
    $fileName = $fileName.$count.".csv";

    //open file
    $file = fopen('../files/'.$fileName, 'wb');
    //store column headers
    $store = array("Transaction Number", "Transaction Item Number", "Contact Name", "Transaction Status",
        "Total Amount", "Transaction Description", "Item Name", "Quantity", "Item Description",
        "Item Price", "Category Name", "Check Number", "Deposity By", "Bank Deposit Date",
        "Source Type", "Source ID", "Transaction Type", "Date Created", "Created By",
        "Date Modified", "Modified By");
    fputcsv($file, $store);

    //store column values
    foreach ($transactions as $transaction) {
        $store = array($transaction['trans_id'], $transaction['trans_id'],
            $transaction['contact_name'], $transaction['trans_status'],
            $transaction['total_amount'], $transaction['trans_desc'],
            $transaction['item_name'], $transaction['quantity'],
            $transaction['item_desc'], $transaction['item_price'], $transaction['cat_name'],
            $transaction['check_num'], $transaction['admin_name'], $transaction['bank_deposit_date'],
            $transaction['source_type'], $transaction['source_id'], $transaction['trans_type'],
            $transaction['date_created'], $transaction['created_by'],
            $transaction['date_modified'], $transaction['modified_by']
        );

        fputcsv($file, $store);
    }

    // close file and return correct filename
    fclose($file);
    echo $fileName;

};
$getCSVFile("item", $_POST['category']);

?>