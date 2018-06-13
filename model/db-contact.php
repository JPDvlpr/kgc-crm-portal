<?php
/**
 * Class DBCcntact extends DBObject adding the ability to get/update multiple items.
 *
 * @author Just oK Team
 * @copyright  2018
 * @version 0.1
 */

require_once("db-object.php");

/**
 * Class DBContact extends DBObject adding the ability to get/update multiple items.
 *
 * @author Just oK Team
 * @copyright  2018
 */

//TO-DO line 47 & 48 can it be combined into one line?
//same for 64 & 65
class DBContact extends DBObject
{
    /* @param $contactId
     * @param $contactName
     * @param $address
     * @param $city
     * @param $state
     * @param $zip
     * @param $phone
     * @param $cell
     * @param $emailAddress
     * @param $altContactName
     * @param $altContactPhone
     * @param $dateCreated
     * @param $createdBy
     * @param $dateModified
     * @param $modifiedBy
     * @param $table
     */
    function addContact($contactName, $address, $city, $state,
                            $zip, $phone = null, $cell = null, $emailAddress = null, $altContactName = null,
                            $altContactPhone = null, $dateCreated, $createdBy, $dateModified, $modifiedBy,
                            $table="contact"){
        //database object
        global $dbh;
        $dbh = Parent::connect();
        //Define Query
        $sql = "INSERT INTO ". $table;
        $sql = $sql . " (contact_name, address, city, state, zip, ";
        if(!is_null($phone)) {
            $sql = $sql . "phone, ";
        }
        if(!is_null($cell)) {
            $sql = $sql . "cell, ";
        }
        if(!is_null($emailAddress)) {
            $sql = $sql . "email_address, ";
        }
        if(!is_null($altContactName)) {
            $sql = $sql . "alt_contact_name, ";
        }
        if(!is_null($altContactPhone)) {
            $sql = $sql . "alt_contact_phone, ";
        }
        $sql = $sql . "created_date, created_by, modified_date, modified_by) ";
        $sql = $sql . "VALUES (:contactName, :address, :city, :state, :zip, ";
        if(!is_null($phone)) {
            $sql = $sql . ":phone, ";
        }
        if(!is_null($cell)) {
            $sql = $sql . ":cell, ";
        }
        if(!is_null($emailAddress)) {
            $sql = $sql . ":emailAddress, ";
        }
        if(!is_null($altContactName)) {
            $sql = $sql . ":altContactName, ";
        }
        if(!is_null($altContactPhone)) {
            $sql = $sql . ":altContactPhone, ";
        }
        $sql = $sql . ":dateCreated, :createdBy, :dateModified, :modifiedBy)";

        //Prepare Statement
        $statement = $dbh->prepare($sql);

        //Bind Parameters do be inserted as given data type
        $statement->bindParam(':contactName', $contactName,PDO::PARAM_STR);
        $statement->bindParam(':address', $address, PDO::PARAM_STR);
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':zip', $zip, PDO::PARAM_STR);
        if(!is_null($phone)) {
            $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        }
        if(!is_null($cell)) {
            $statement->bindParam(':cell', $cell, PDO::PARAM_STR);
        }
        if(!is_null($emailAddress)) {
            $statement->bindParam(':emailAddress', $emailAddress, PDO::PARAM_STR);
        }
        if(!is_null($altContactName)) {
            $statement->bindParam(':altContactName', $altContactName, PDO::PARAM_STR);
        }
        if(!is_null($altContactPhone)) {
            $statement->bindParam(':altContactPhone', $altContactPhone, PDO::PARAM_STR);
        }
        $statement->bindParam(':dateCreated', $dateCreated, PDO::PARAM_STR);
        $statement->bindParam(':createdBy', $createdBy, PDO::PARAM_STR);
        $statement->bindParam(':dateModified', $dateModified, PDO::PARAM_STR);
        $statement->bindParam(':modifiedBy', $modifiedBy, PDO::PARAM_STR);

        //Execute Statement
        $statement->execute();

        Parent::disconnect();
    }

    /**
     * @param contact $table
     * @return results
     * gets everything from the contact table
     */
    public static function getContacts($table = 'contact')
    {
        //database object
        global $dbh;
        $dbh = (new self)->connect();

        //Define Query
        $sql = "SELECT * FROM ".$table;

        //prepare statement
        $statement = $dbh->prepare($sql);

        //execute query
        $statement->execute();

        // get results in an associative array
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        (new self)->disconnect();
        return $results;
    }
}