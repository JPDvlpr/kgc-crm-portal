<?php

require_once('db-object.php');

class DBAdmin extends DBObject{
    public static function getAdmins($table = 'admins')
    {
        global $dbh;
        $dbh = (new self)->connect();

        //Define Query
        $sql = "SELECT * FROM ".$table;

        //prepare statement
        $statement = $dbh->prepare($sql);

        //execute query
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        (new self)->disconnect();

        return $results;
    }
}