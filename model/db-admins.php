<?php
require_once('db-object.php');

class DBAdmin extends DBObject
{
    public static function getAdmins($table = 'admins')
    {
        global $dbh;
        $dbh = (new self)->connect();


        $sql = "SELECT * FROM " . $table;
        $statement = $dbh->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);


        (new self)->disconnect();
        return $results;
    }
}


