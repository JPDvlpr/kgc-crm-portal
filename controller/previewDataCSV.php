<?php
/*
 *  previewDataCSV.php
 *  KGC CRM Portal
 *  IT-355
 *  Just oK TeaM
 *
 *  This file is called by the AJAX, and retrieves the filtered results for previewing
 */
include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-transaction.php");

$previewCSVData = function () {
    $fileName = $_POST['filteringData']['filters']['filename'];
    $filters = $_POST['filteringData']['filters'];
    unset($filters['filename']);

    $transactions = DBTransaction::getFilteredTransactions($filters);

    return $transactions;

};
$previewCSVData();

?>