<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("db-object.php");
/**
 * Class DBObject uses the connection function to connect to the database.
 *
 * @author Just ok team
 * @version 1.0
 * @copyright  2018
 */
class DBItem extends DBObject
{

    /**
     * Function to view the sku table in the database
     * @param name -
     * @param description -
     * @param price -
     * @param unit -
     * @param category -
     * @param item_id -
     * @return int
     */
    function getItem($table = 'item', $numReturn = 0, $category = 'category')
    {
        //gives access to the variable in index
        global $dbh;
        $dbh = Parent::connect();

        //1. Define the query
        $sql = "SELECT * FROM " . $table;

        if ($numReturn != 0) {
            $sql = $sql . " LIMIT :number";
        }

        //2. Prepare the statement
        $statement = $dbh->prepare($sql);

        //3. Bind parameters
        if ($numReturn != 0) {
            $statement->bindParam(':number', $numReturn, PDO::PARAM_INT);
        }

        //4.Execute statement
        $statement->execute();

        //5. Return the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //print_r($result);

        Parent::disconnect();
        return $result;

        if (empty($result)) {
            return -1;
        } else {
            return $result['access'];
        }
    }
}