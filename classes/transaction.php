<?php
/**
 * Contains the Transaction Class
 *
 * This class handles new and existing transactions
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @version 0.1
 */

include_once("../validation/backendValidations.php");

/**
 * Class "Transaction" represents a transaction on the CRM Portal.
 *
 * The Transaction class represents a transaction with:
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @copyright 2018
 *
 */
class Transaction
{
    protected $id; // INT(11)
    protected $amount; // DECIMAL(8,2)
    protected $transDate; // DATE
    protected $checkNum; // VARCHAR(45)
    protected $depositById; // INT(11)
    protected $bankDepositDate; // DATE
    protected $transStatus; // VARCHAR(1)
    protected $sourceType; // VARCHAR(5)
    protected $sourceId; // VARCHAR(45)
    protected $transType; //VARCHAR(1)
    protected $contactId; // INT(11)
    protected $dateCreated; // DATETIME
    protected $createdBy; // INT(11)
    protected $dateModified; // DATETIME
    protected $modifiedBy; // INT(11)
    protected $transactionItems; // an array of transactionItem
    protected $errors; // an array of errors indexed by the field (TODO figure out how this will work with the array of transaction items!)
    protected $new;

    /**
     * Transaction constructor.
     * @param $id
     * @param $amount
     * @param $transDate
     * @param $checkNum
     * @param $depositById
     * @param $bankDepositDate
     * @param $transStatus
     * @param $sourceType
     * @param $sourceId
     * @param $transType
     * @param $contactId
     * @param $dateCreated
     * @param $createdBy
     * @param $dateModified
     * @param $modifiedBy
     * @param $transactionItems
     */
//    public function __construct($id(move to end), $amount, $transDate, $checkNum, $depositById (not in initial creation), $bankDepositDate, $transStatus, $sourceType, $sourceId, $transType, $contactId, $dateCreated, $createdBy, $dateModified, $modifiedBy, $transactionItems)
    public function __construct($amount, $transDate, $sourceType, $sourceId, $transType, $contactId, $dateCreated, $createdBy, $transactionItemsArray, $checkNum, $id = 0)
    {
        $this->new = true;
        $this->id = $id; // change to use random generator
        $this->amount = $amount;
        $this->transDate = $transDate;
        $this->checkNum = $checkNum;
//        $this->transStatus = $transStatus;
//        $this->sourceType = $sourceType;
//        $this->sourceId = $sourceId;
        $this->transType = $transType;
        $this->contactId = $contactId;
        $this->dateCreated = $dateCreated;
        $this->createdBy = $createdBy;
        $this->dateModified = $dateCreated;
        $this->modifiedBy = $createdBy;
        foreach ($transactionItemsArray as $item) {
            $this->transactionItems[] = new TransactionItem($item['itemDesc'], $item['amount'], $item['itemId']);
        }
    }


    // creates and returns an array of transactions from the database
    // may return only a single Transaction, e.g if filter is id
    public static function getTransactions($filters, $filterValues)
    {
        //get transactions

        //loop through transactions
            // construct transaction
            // set additional retrieved values
            // retrieve and create array of transaction items based on id
            // set $new to false
            // validate transaction
            // if valid, add to transactions array

        //return array of Transactions
    }

    // TODO figure out where to do all of this and what needs to be validated.
    public function validateTransaction($errors, $new = true)
    {
//        protected $id; // INT(11)
//        protected $amount; // DECIMAL(8,2)
//        protected $transDate; // DATE
//        protected $checkNum; // VARCHAR(45)
//        protected $depositById; // INT(11)
//        protected $bankDepositDate; // DATE
//        protected $transStatus; // VARCHAR(1)
//        protected $sourceType; // VARCHAR(5)
//        protected $sourceId; // VARCHAR(45)
//        protected $transType; //VARCHAR(1)
//        protected $contactId; // INT(11)
//        protected $dateCreated; // DATETIME
//        protected $createdBy; // INT(11)
//        protected $dateModified; // DATETIME
//        protected $modifiedBy; // INT(11)
//        protected $transactionItems; // an array of transactionItem

//        // this doesn't feel right... having the $new may correct this
        if ($new) {

        } elseif(!validateInteger($this->id)){
            //TODO - should this be a check for an integer or a check for existence in database
                $errors['id'] = 'Transaction ID was not valid';
        }

//        protected $amount; // DECIMAL(8,2)
        //validate amount payed
        if (is_null($this->amount)) {
            $errors['amount'] = 'Amount is required';
        } elseif (!validatePrice($this->amount)) {
            $errors['amount'] = 'Amount was not valid';
        };

//        $this->transDate = $transDate;
        // validate bankDepositDate - check if it is a valid date
        if(!validateDate($this->dateModified)){
            $errors['dateModified'] = 'Invalid Date';
        }

//        $this->checkNum = $checkNum;
        //validate that checkNum is an integer
        if(!validateInteger($this->checkNum)){
            $errors['checkNum'] = 'Check Number must be an integer.';
        }

//        $this->depositById = $depositById;
        // validate deposit_by - check if id exists in admin table
        if(!validateAdmin($this->depositBy)){
            $errors['depositBy'] = 'That admin does not exist.';
        }

//        $this->bankDepositDate = $bankDepositDate;
        // validate bankDepositDate - check if it is a valid date
        if(!validateDate($this->dateModified)){
            $errors['dateModified'] = 'Invalid Date';
        }

//        $this->transStatus = $transStatus;
        //TODO - not sure what this is but need to validate

//        $this->sourceType = $sourceType;
        //TODO - not sure what this is but need to validate

//        $this->sourceId = $sourceId;
        //TODO - not sure what this is but need to validate

//        $this->transType = $transType;
        //TODO - not sure what this is but need to validate

//        $this->contactId = $contactId;
        // validate contact_id - check if id exists in contact table
        if(!validateContact($this->contactId)){
            $errors['contactId'] = 'That contact does not exist.';
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
        if(!validateDateTime($this->dateModified)){
            $errors['dateModified'] = 'Invalid Date';
        }

//        $this->modifiedBy = $createdBy;
        // validate modified_by - check if id exists in admin table
        if(!validateAdmin($this->modifiedBy)){
            $errors['modifiedBy'] = 'That admin does not exist.';
        }

        // validate each line item
        // TODO make sure that number times itemCost == amount of this line_item
        foreach ($this->transactionItems as $item) {
            if(!validateSku($item)) $transactionError[] = $item->getId;
        }
        if(sizeof($transactionError) > 0) {
            $errors['lineItem'] = "Line item doesn't exist";
            $errors['invalidLineItems'] = $transactionError;
        }

        return $errors;
    }

    public function saveTransaction()
    {

    }
}