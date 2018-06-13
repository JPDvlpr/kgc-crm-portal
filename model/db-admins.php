<?php
require_once('db-object.php');

/**
 * Class DBAdmin
 */
class DBAdmin extends DBObject
{
    /**
     * @param admins table
     * @return results
     * gets everything from the admins table
     */
    public static function getAdmins($table = 'admins')
    {
//        database object
        global $dbh;
        $dbh = (new self)->connect();
//        retrieve everything from admins table
        $sql = "SELECT * FROM " . $table;
//        prepare sql statement
        $statement = $dbh->prepare($sql);
        $statement->execute();
//        retrieve result row as an associative array
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        (new self)->disconnect();
        return $results;
    }
}