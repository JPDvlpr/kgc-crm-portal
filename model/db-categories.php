<?php
/**
 * Class DBCategories extends DBObject adding the ability to get/update multiple items.
 *
 * @author Just oK Team
 * @copyright  2018
 * @version 0.1
 */


/**
 * Class DBCategories extends DBObject adding the ability to get/update multiple items.
 *
 * @author Just oK Team
 * @copyright  2018
 */
class DBCategories extends DBObject
{
    /**
     * Get a specified number/all items (all rows) from a table in the Database
     *
     * @param $table - the table to pull from
     * @param $numReturn - the number of results to return
     * @return mixed - the specified number of items from the database
     */
    function getCategories($table = 'category', $numReturn = 0)
    {
        //gives access to the variable in index
        global $dbh;
        $dbh = Parent::connect();

        //1. Define the query
        $sql = "SELECT * FROM " . $table . " ORDER BY recommendation DESC";

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
    }
}
?>