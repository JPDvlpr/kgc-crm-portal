<?php
//require '/home2/justokte/config.php';
//require '/home/jpappoeg/config.php';
//require '/home/troemerg/config.php';
//require '/home/kbarterg/config.php';
//require("/home/mfeltong/config_files/config.php");

require($_SERVER['DOCUMENT_ROOT']."/config.php");


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