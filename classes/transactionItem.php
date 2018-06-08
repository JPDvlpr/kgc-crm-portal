<?php
/**
 * Contains the TransactionItem Class
 *
 * This class handles new and existing transaction items
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @version 0.1
 */

include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/validation/backendValidations.php");

/**
 * Class "TransactionItem" represents a transaction_item on the CRM Portal.
 *
 * The TransactionItem class represents a transaction_item with:
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @copyright 2018
 *
 */
class TransactionItem
{
    protected $transItemId; // INT(11)
    protected $transId; // INT(11)
    protected $itemDesc; // VARCHAR(100) - I think this is where the user entered note would go
    protected $itemQuantity; // INT(11)
    protected $amount; // DECIMAL(8,2)
    protected $itemId; // INT(11)
    protected $dateCreated; // DATETIME
    protected $createdBy; // INT(11)
    protected $dateModified; // DATETIME
    protected $modifiedBy; // INT(11)
    protected $new;

    /**
     * TransactionItem constructor.
     * @param $transItemId
     * @param $transId
     * @param $itemDesc
     * @param $amount
     * @param $itemId
     * @param $dateCreated
     * @param $createdBy
     * @param $dateModified
     * @param $modifiedBy
     * @param $errors
     * @param $new
     */
    public function __construct($transItemId, $transId, $itemDesc, $itemQuantity, $amount, $itemId, $dateCreated, $createdBy)
    {
        $this->transItemId = $transItemId;
        $this->transId = $transId;
        $this->itemDesc = $itemDesc;
        $this->itemQuantity = $itemQuantity;
        $this->amount = $amount;
        $this->itemId = $itemId;
        $this->dateCreated = $dateCreated;
        $this->createdBy = $createdBy;
        $this->dateModified = $dateCreated;
        $this->modifiedBy = $createdBy;
        $this->new = true;
    }

    // creates and returns an array of transactions from the database
    // may return only a single Transaction, e.g if filter is id
    public static function getTransactionsItems($filters, $filterValues)
    {
        //get transactionsItems

        //loop through transactionItems
        // construct transaction
        // set additional retrieved values
        // retrieve and create array of transaction items based on id
        // set $new to false
        // validate transaction
        // if valid, add to transactionitems array

        //return array of TransactionsItems
    }

    // Validates transaction items. If the transaction is new, then makes sure that all
    // items are still available and that the amounts are correct
    public function validateTransactionItem(&$errors, $count, $new = true)
    {
        $temp = array();
        //        protected $transId; // INT(11)
        // TODO - change to validating by checking if ID exists in database or ???
        // here (ie whether new or old check for integer - add a check in !$new for existence
        // in database
        if (!validateInteger($this->transId)) {
            //TODO - should this be a check for an integer or a check for existence in database
            $temp['id'] = 'Transaction ID was not valid';
        }

        //  Validate description: allowed to be null, empty or a valid string.
        //  Description is one place where a user note might go.
        if ($this->itemDesc != null && $this->itemDesc != "" && !validateString($this->itemDesc)) {
            $temp['itemDesc'] = 'Description was invalid.';
        }

        // Validate item quantity. This should be 1 for donations and discounts.
        // Todo add to database and to appropriate insert statements
        if (is_null($this->itemQuantity)) {
            $temp['itemQuantity'] = 'Quantity is required';
        } elseif (!validateInteger($this->itemQuantity)) {
            $temp['itemQuantity'] = "Quantity was not valid.";
        }

        // Validate amount payed
        if (is_null($this->amount)) {
            $temp['amount'] = 'Amount is required';
        } elseif (!validatePrice($this->amount)) {
            $temp['amount'] = 'Amount was not valid';
        };

        // Validate item ID - this be a check for an integer and, if new, check for availability in database
        if (!validateInteger($this->itemId)) {
            $temp['itemId'] = 'Item ID was not valid';
        }
        //TODO - check for existence in database here (add a check if $new for existence in database
//        elseif($new && itemId not  in database) {
//            $errors['itemId'] = 'Sorry, this item is no longer available.';
//        }

        // Validate dateCreated - check if it is a valid date
        if (!validateDateTime($this->dateCreated)) {
            $temp['dateCreated'] = 'Invalid Date';
        }

        // Validate created_by - check if id exists in admin table
        if (!validateAdmin($this->createdBy)) {
            $temp['createdBy'] = 'That admin does not exist.';
        }

        // Validate dateModified - check if it is a valid date
        if (!validateDateTime($this->dateModified)) {
            $temp['dateModified'] = 'Invalid Date';
        }

        // validate modified_by - check if id exists in admin table
        if (!validateAdmin($this->modifiedBy)) {
            $temp['modifiedBy'] = 'That admin does not exist.';
        }

        if(!empty($temp)) {
            $errors['item'.$count] = $temp;
        }
    }

    //get list of items transaction_item table
    //write to database use method in db_transaction
    //***need to get item from transaction.php and insert into transactions table
    public function saveTransactionItem($transId, $numReturn = 0)
    {
        $this->transId = $transId;

        $saveToLocation = new DBItem();

        $saveToLocation->addLineItem($this->transId,
            $this->itemDesc, $this->amount, $this->itemId,
            $this->dateCreated, $this->createdBy, $this->dateModified, $this->modifiedBy,$table = 'transaction_item');
    }
//        //gives access to the variable in index
//        global $dbh;
//
//        $dbh = Parent::connect();
//
//        //1. Define the query
//        $sql = "INSERT INTO " . $table;
//
//        if ($numReturn != 0) {
//            $sql = $sql . " LIMIT :number";
//        }
//
//        //2. Prepare the statement
//        $statement = $dbh->prepare($sql);
//
//        //3. Bind parameters
//        if ($numReturn != 0) {
//            $statement->bindParam(':number', $numReturn, PDO::PARAM_INT);
//        }
//
//        //4.Execute statement
//        $statement->execute();
//
//        //5. Return the results
//        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        Parent::disconnect();
//
//        if (empty($result)) {
//            return -1;
//        }
//
//        return $result;
//        //Todo write to database
//        $this->new = false;
//    }

    public function getItemId(){
        return $this->itemId;
    }

    public function getTransactionItemId(){
        return $this->transItemId;
    }
}