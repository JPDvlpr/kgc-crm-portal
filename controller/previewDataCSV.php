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

    $transactions = DBTransaction::getFilteredTransactions($filters);
    $previews = array(array("Transaction Date","Contact Name", "Total Amount", "Item Description"));

    foreach ($transactions as $transaction) {
        $store = array($transaction['trans_date'],$transaction['contact_name'],
            $transaction['total_amount'],$transaction['item_desc']);
        array_push($previews, $store);
    }

    echo json_encode($previews);
};
$previewCSVData();

?>