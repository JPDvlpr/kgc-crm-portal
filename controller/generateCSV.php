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
    if($fileName == ""){
        $fileName = "KGC_data";
    }
    $filters = $_POST['filteringData']['filters'];
    $fileName .= '_Date';
    unset($filters['filename']);
//    var_dump($filters);
//    $transactions = Transaction::getTransactions($filters);
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
//    $store = array("Transaction Number", "Transaction Item Number", "Contact Name");
    $store = array("Transaction Number", "Transaction Item Number", "Contact Name", "Transaction Status",
        "Total Amount", "Transaction Description", "Item Name", "Quantity", "Item Description",
        "Item Price", "Category Name", "Check Number", "Deposity By", "Bank Deposit Date",
        "Source Type", "Source ID", "Transaction Type", "Date Created", "Created By",
        "Date Modified", "Modified By");
    fputcsv($file, $store);

//    SELECT t.trans_id, ti.trans_item_id, t.trans_date, c.contact_name, t.trans_status,
//                    t.amount as total_amount, t.trans_desc,
//					i.item_name, (ti.amount/ i.item_price) as quantity,
//                  ti.item_desc, i.item_price, ic.cat_name,
//					t.check_num, addepositby.admin_name, t.bank_deposit_date,
//					t.source_type, t.source_id, t.trans_type,
//					ti.date_created, adcreate.admin_name as created_by,
//					ti.date_modified, admodify.admin_name as modified_by
//                  FROM transaction t
//                  INNER JOIN transaction_item ti ON t.trans_id = ti.trans_id
//                  INNER JOIN contact c ON c.contact_id = t.contact_id
//                  LEFT JOIN item i ON ti.item_id = i.item_id
//                  LEFT JOIN item_category ic ON i.cat_id = ic.cat_id
//                  LEFT JOIN admins adcreate ON t.created_by = adcreate.admin_id
//				  LEFT JOIN admins admodify ON t.modified_by = admodify.admin_id
//				  LEFT JOIN admins addepositby ON t.deposit_by_id = addepositby.admin_id
//

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
//        $store = array($transaction['trans_id'],$transaction['contact_name']);

        fputcsv($file, $store);
//        fputcsv($file, $transaction);
    }

    // close file and return correct filename
    fclose($file);
    echo $fileName;

};
$getCSVFile("item", $_POST['category']);

?>