<?php
/**
 * Contains the TransactionItem Class
 *
 * This class handles new and existing transaction items
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @version 0.1
 */

include_once("../validation/backendValidations.php");

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

    // TODO figure out where to do all of this and what needs to be validated.
    public function validateTransactionItem($errors, $new = true)
    {
//        protected $transItemId; // INT(11)
        if(!validateInteger($this->transItemId)){
            //TODO - should this be a check for an integer or a check for existence in database
            // here (ie whether new or old check for integer - add a check in !$new for existence
            // in database
            $errors['transItemId'] = 'Transaction Item ID was not valid';
        }

        //        protected $transId; // INT(11)
        // TODO - change to validating by checking if ID exists in database or ???
        // here (ie whether new or old check for integer - add a check in !$new for existence
        // in database
        if(!validateInteger($this->transId)){
            //TODO - should this be a check for an integer or a check for existence in database
            $errors['id'] = 'Transaction ID was not valid';
        }

        //        protected $itemDesc; // VARCHAR(100) - I think this is where the user entered note would go
        if(!validateString($this->itemDesc)){
            $errors['itemDesc'] = 'Amount is required';
        }

        // protected $itemQuantity; // INT(11)
        // Todo add to database
        if(!validateInteger($this->itemQuantity)){
            $errors['itemQuantity'] = "Quantity is required.";
        }

        // protected $amount; // DECIMAL(8,2)
        //validate amount payed
        if (is_null($this->amount)) {
            $errors['amount'] = 'Amount is required';
        } elseif (!validatePrice($this->amount)) {
            $errors['amount'] = 'Amount was not valid';
        };

//        protected $itemId; // INT(11)
        if(!validateInteger($this->itemId)){
            //TODO - should this be a check for an integer and a check for existence in database
            // here (ie whether new or old check for integer - add a check in !$new for existence
            // in database
            $errors['itemId'] = 'Item ID was not valid';
        }

//        $this->dateCreated = $dateCreated;
        // validate dateCreated - check if it is a valid date
        if(!validateDateTime($this->dateCreated)){
            $errors['dateCreated'] = 'Invalid Date';
        }

//        $this->createdBy = $createdBy;
        // validate created_by - check if id exists in admin table
        if(!validateAdmin($this->createdBy)){
            $errors['createdBy'] = 'That admin does not exist.';
        }
        
//        $this->dateModified = $dateCreated;
            // validate dateModified - check if it is a valid date
            if (!validateDateTime($this->dateModified)) {
                $errors['dateModified'] = 'Invalid Date';
            }

//        $this->modifiedBy = $createdBy;
            // validate modified_by - check if id exists in admin table
            if (!validateAdmin($this->modifiedBy)) {
                $errors['modifiedBy'] = 'That admin does not exist.';
            }


        return $errors;
    }

    public function saveTransactionItem()
    {
        //Todo write to database
        $this->new = false;
    }
}