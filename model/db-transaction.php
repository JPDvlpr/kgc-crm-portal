<?php

class DBTransactions extends DBObject
{
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