<!--
Just Ok Team
DB Filters
Filters the data in the database and returns
results based on what the user selects in order
to be generated to a csv file
-->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("db-object.php");

/**
 * Class DBFilter extends DBObject allowing filtering.
 *
 * @author Just oK Team
 * @copyright  2018
 */
class DBFilter extends DBObject
{
    public static function getContacts($table = 'contact')
    {
        global $dbh;
        $dbh = (new self)->connect();

        //Define Query
        $sql = "SELECT * FROM " . $table;

        //prepare statement
        $statement = $dbh->prepare($sql);

        //execute query
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

       // output data of each row
            foreach ($results as $row) {
                //echo "Name: " . $row["contact_name"] . "<br>" . "Address: " . $row["address"] . "<br>" .
                  //  "City: " . $row["city"] . "<br>" . "State: " . $row["state"] . "<br>";
                echo $row;
            }

        (new self)->disconnect();

        return $results;
    }

    public static function getColumns()
    {
        global $dbh;
        $dbh = (new self)->connect();

        //make an array with the column names
        //Define Query
        $sql = "select * from information_schema.columns
where table_schema = 'jpappoeg_grc' AND table_name = 'contact'";

        //prepare statement
        $statement = $dbh->prepare($sql);

        //execute query
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // output data of each row
        foreach ($results as $row) {
            //echo "Name: " . $row["contact_name"] . "<br>" . "Address: " . $row["address"] . "<br>" .
            //  "City: " . $row["city"] . "<br>" . "State: " . $row["state"] . "<br>";
            var_dump($row);
            echo '<br>';
        }

        (new self)->disconnect();

        return $results;
    }


}

DBFilter::getContacts();
DBFilter::getColumns();