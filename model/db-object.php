<?php
require '/home/jpappoeg/config.php';

/**
 * Class DBObject uses the connection function to connect to the database.
 *
 * @author Just ok team
 * @version 1.0
 * @copyright  2018
 */
class DBObject
{
    /**
     * Function to connect to db
     * @return PDO database connection
     */
    function connect()
    {
        try {
            //Instantiate a database object
            $dbh = new PDO(DB_DSN, DB_USERNAME,
                DB_PASSWORD);
            echo "Connected to database!!!";
            return $dbh;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }

    /**
     * Function to disconnect from the database
     */
    function disconnect()
    {
        global $dbh;
        $dbh = "";
    }
}