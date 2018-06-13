<?php
/*
 *  previewDataCSV.php
 *  KGC CRM Portal
 *  IT-355
 *  Just oK TeaM
 *
 *  This file is called by the AJAX, and retrieves the filtered results for previewing
 *  Returns just the contact name, item description, total amount, and trans date
 */
include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-transaction.php");

$previewCSVData = function () {
    $filters = $_POST['filteringData']['filters'];
    unset($filters['filename']);

//    filter data header
    $transactions = DBTransaction::getFilteredTransactions($filters);
    $previews = array(array("Transaction Date","Contact Name", "Line Amount", "Item Description"));

//    filtered data from database
    foreach ($transactions as $transaction) {
        if($transaction['cat_name'] == 'Donation'){
            $store = array($transaction['trans_date'], $transaction['contact_name'],
                '$ ' . ($transaction['quantity'] * $transaction['item_price']), $transaction['item_desc']. ' (' . $transaction['quantity'] . ')' );
        } else {
            $store = array($transaction['trans_date'], $transaction['contact_name'],
                '$ ' . ($transaction['quantity'] * $transaction['item_price']), $transaction['item_name'] . ' (' . $transaction['quantity'] . ')');
        }

        array_push($previews, $store);
    }

    echo json_encode($previews);
};
$previewCSVData();

?>