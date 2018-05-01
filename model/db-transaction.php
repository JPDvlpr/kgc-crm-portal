<?php

class DBTransaction extends DBObject
{
    /* @param $id
* @param $amount
* @param $transDate
* @param $checkNum
* @param $depositById
* @param $bankDepositDate
* @param $transStatus
* @param $sourceType
* @param $sourceId
* @param $transType
* @param $contactId
* @param $dateCreated
* @param $createdBy
* @param $dateModified
* @param $modifiedBy
* @param $transactionItems
     */
    function addTransaction($id, $amount, $transDate, $checkNum, $depositById,
                            $bankDepositDate, $transStatus, $transDesc, $sourceType, $sourceId,
                            $transType, $contactId, $dateCreated, $createdBy,
                            $dateModified, $modifiedBy, $transactionItems,
                            $table = 'transaction'){//}, $dateOfTrans, $payMethod, $discount, $payAmount){
        global $dbh;
        $dbh = Parent::connect();

        //Define Query
        $sql = "INSERT INTO ". $table;
//        $sql = $sql . "(dateOfTrans, payMethod, discount, paymentAmount)";
//        $sql = $sql . "VALUES (:dateOfTrans, :payMethod, :discount, :payAmount)";
        $sql = $sql . " (trans_id, amount, trans_date, ";
        if($checkNum != 0) {
            $sql = $sql . "check_num, ";
        }
        $sql = $sql . "trans_status, trans_desc, trans_type, contact_id,
            date_created, created_by, date_modified, modified_by) ";
        $sql = $sql . "VALUES (:id, :amount, :transDate, ";
        if($checkNum != 0) {
            $sql = $sql . ":checkNum, ";
        }
        $sql = $sql . ":transStatus, :transDesc, :transType, :contactId,
            :dateCreated, :createdBy, :dateModified, :modifiedBy)";

        //Prepare Statement
        $statement = $dbh->prepare($sql);

        //Bind Parameter
        $statement->bindParam(':id', $id,PDO::PARAM_INT);
        $statement->bindParam(':amount', $amount, PDO::PARAM_STR);
        $statement->bindParam(':transDate', $transDate, PDO::PARAM_STR);
        if($checkNum != 0){
            $statement->bindParam(':checkNum', $checkNum, PDO::PARAM_STR);
        }
        $statement->bindParam(':transStatus', $transStatus, PDO::PARAM_STR);
        $statement->bindParam(':transDesc', $transDesc, PDO::PARAM_STR);
        $statement->bindParam(':transType', $transType, PDO::PARAM_STR);
        $statement->bindParam(':contactId', $contactId, PDO::PARAM_STR);
        $statement->bindParam(':dateCreated', $dateCreated, PDO::PARAM_STR);
        $statement->bindParam(':createdBy', $createdBy, PDO::PARAM_STR);
        $statement->bindParam(':dateModified', $dateModified, PDO::PARAM_STR);
        $statement->bindParam(':modifiedBy', $modifiedBy, PDO::PARAM_STR);

        //Execute Statement
        $statement->execute();
    }

    function addLineItem($transItemId, $transId, $itemDesc, $amount, $itemId, $dateCreated, $createdBy, $dateModified, $modifiedBy,$table = 'transaction_item'){
        global $dbh;
        $dbh = Parent::connect();

        $table = "transaction_item";

        //Define Query
        $sql = "INSERT INTO ". $table;
        $sql = $sql . "(trans_item_id, trans_id, item_desc, amount, 
            item_id, date_created, created_by, date_modified, modified_by)";
        $sql = $sql . "VALUES (:transItemId, :transId, :itemDesc, :amount, 
            :itemId, :dateCreated, :createdBy, :dateModified, :modifiedBy) ";

        //Prepare Statement
        $statement = $dbh->prepare($sql);

        //Bind Parameter
        $statement->bindParam(':transItemId', $transItemId, PDO::PARAM_STR);
        $statement->bindParam(':transId', $transId, PDO::PARAM_STR);
        $statement->bindParam(':itemDesc', $itemDesc, PDO::PARAM_STR);
        $statement->bindParam(':amount', $amount, PDO::PARAM_STR);
        $statement->bindParam(':itemId', $itemId, PDO::PARAM_STR);
        $statement->bindParam(':dateCreated', $dateCreated, PDO::PARAM_STR);
        $statement->bindParam(':createdBy', $createdBy, PDO::PARAM_STR);
        $statement->bindParam(':dateModified', $dateModified, PDO::PARAM_STR);
        $statement->bindParam(':modifiedBy', $modifiedBy, PDO::PARAM_STR);

        //Execute Statement
        $statement->execute();
    }

    function getTransactions($table = 'transaction')
    {
        global $dbh;
        $dbh = Parent::connect();

        //Define Query
        $sql = "SELECT * FROM ".$table;

        //prepare statement
        $statement = $dbh->prepare($sql);
    }
}