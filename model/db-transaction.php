<?php

class DBTransactions extends DBObject
{
    function addTransaction($table = 'transaction', $dateOfTrans, $payMethod, $discount, $payAmount){
        global $dbh;
        $dbh = Parent::conect();

        //Define Query
        $sql = "INSERT INTO ". $table;
        $sql = $sql . "(dateOfTrans, payMethod, discount, paymentAmount)";
        $sql = $sql . "VALUES (:dateOfTrans, :payMethod, :discount, :payAmount)";

        //Prepare Statement
        $statement = $dbh->prepare($sql);


        //Bind Parameter
        $statement->bindParam(':dateOfTrans', $dateOfTrans, PDO::PARAM_STR);
        $statement->bindParam(':payMethod', $payMethod, PDO::PARAM_STR);
        $statement->bindParam(':discount', $discount, PDO::PARAM_STR);
        $statement->bindParam(':payAmount', $payAmount, PDO::PARAM_STR);

        //Execute Statement
        $statement->execute();
    }

    function addLineItem($table = 'line_item', $skuTable = 'sku', $quantity, $sku){
        global $dbh;
        $dbh = Parent::conect();

        $skuID = "SELECT sku_id FROM " . $skuTable . " WHERE " . $sku . " = :sku_id";


        //Define Query
        $sql = "INSERT INTO ". $table;
        $sql = $sql . "(sku_id, quantity)";
        $sql = $sql . "VALUES (:sku_id, :quantity) ";

        //Prepare Statement
        $statement = $dbh->prepare($sql);

        //Bind Parameter
        $statement->bindParam(':sku_id', $skuID, PDO::PARAM_STR);
        $statement->bindParam(':quantity', $quantity, PDO::PARAM_STR);

        //Execute Statement
        $statement->execute();
    }

    function addLinkingTable($table = 'transaction_line_item', $transTable = 'transaction',
                             $lineItemTable = 'line_item', $transId, $linItId){
        global $dbh;
        $dbh = Parent::conect();

        $trans = "SELECT transactionID FROM " . $transTable . " WHERE " . $transId . " = :transactioID";
        $lineItem = "SELECT lineItemID FROM " . $lineItemTable . " WHERE " . $linItId . " = : lineItemID";

        //Define Query
        $sql = "INSERT INTO " . $table;
        $sql = $sql . "(transactionID, lineItemID)";
        $sql = $sql . "VALUES (:transactionID, :lineItemID";

        //Prepare Statement
        $statement = $dbh->prepare($sql);

        //Bind Parameter
        $statement->bindParam(':transactionID', $trans, PDO::PARAM_STR);
        $statement->bindParam(':lineItemID', $lineItem, PDO::PARAM_STR);

        //Execute Statement
        $statement->execute();
    }

    function getTransactions($table = 'transaction')
    {
        global $dbh;
        $dbh = Parent::conect();

        //Define Query
        $sql = "SELECT * FROM ".$table;

        //prepare statement
        $statement = $dbh->prepare($sql);
    }
}