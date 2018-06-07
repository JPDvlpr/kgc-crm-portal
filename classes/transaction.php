<?php
/**
 * Contains the Transaction Class
 *
 * This class handles new and existing transactions
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @version 0.1
 */

include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/validation/backendValidations.php");
include_once("transactionItem.php");

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
    protected $transDesc;
    protected $sourceType; // VARCHAR(5)
    protected $sourceId; // VARCHAR(45)
    protected $transType; //VARCHAR(1)
    protected $contactId; // INT(11)
    protected $dateCreated; // DATETIME
    protected $createdBy; // INT(11)
    protected $dateModified; // DATETIME
    protected $modifiedBy; // INT(11)
    protected $transactionItems; // an array of transactionItem
//    protected $errors; // an array of errors indexed by the field (TODO figure out how this will work with the array of transaction items!)
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
    public function __construct($createdBy, $contactId, $transDate, $transactionItemsArray, $amount, $transDesc, $transType, $checkNum, $ccType, $id = 0)
    {
        if(strlen($transDate) <= 10){
            date_default_timezone_set('America/Los_Angeles');
            $date = $transDate;
            $time = date('H:i:s',time());
            $transDate = $date." ".$time;
        }

        $this->new = true;
        $this->id = $id; // TODO change to use random generator
        $this->amount = $amount;
        $this->transDate = $transDate;
        $this->checkNum = $checkNum;
        if ($this->new) {
            $this->transStatus = 'P';
        }
        // TODO Use sourceType
//        $this->sourceType = $sourceType;
//        $this->sourceId = $sourceId;
        $this->transDesc = $transDesc;
        $this->transType = $transType;
        $this->contactId = $contactId;
        $this->dateCreated = $transDate;
        $this->createdBy = $createdBy;
        $this->dateModified = $transDate;
        $this->modifiedBy = $createdBy;
        $lineNumber = 1;
        foreach ($transactionItemsArray as $item) {
            $transItemId = "" . $this->id . $lineNumber;
            $transId = $this->id;
            $itemDesc = $item[3];
            $itemQuantity = $item[1];
            $amount = $item[2];
            $itemId = $item[0];
            $dateCreated = $this->dateCreated;
            $createdBy = $this->createdBy;
            $this->transactionItems[] = new TransactionItem($transItemId, $transId, $itemDesc, $itemQuantity,
                $amount, $itemId, $dateCreated, $createdBy);
            $lineNumber++;
        }
    }



    /**
     * Validates new transactions and existing transactions (from database).
     * Uses backendValidations.php to validate basic types.
     * The following variables (with their types in the database) should be validated:
     *       $id; // INT(11)
     *       $amount; // DECIMAL(8,2)
     *       $transDate; // DATE
     *       $checkNum; // VARCHAR(45)
     *       $depositById; // INT(11)
     *       $bankDepositDate; // DATE
     *       $transStatus; // VARCHAR(1)
     *       $sourceType; // VARCHAR(5)
     *       $sourceId; // VARCHAR(45)
     *       $transType; //VARCHAR(1)
     *       $contactId; // INT(11)
     *       $dateCreated; // DATETIME
     *       $createdBy; // INT(11)
     *       $dateModified; // DATETIME
     *       $modifiedBy; // INT(11)
     *       $transactionItems; // an array of transactionItem
     *
     * @param $errors - array to hold errors found.
     * @param bool $new - True if new, false if gotten from database
     * @return mixed - the $errors array
     */
    public function validateTransaction(&$errors, $new = true)
    {
        // TODO figure out where to do all of this and what needs to be validated.
//        // this doesn't feel right... having the $new may correct this

        if (!$new) {
            // Validate Transaction ID
            if (!validateInteger($this->id)) {
                //TODO - should this be a check for an integer or a check for existence in database
                $errors['idError'] = 'Transaction ID was not valid';
            }

            // Todo - will need to check if exists
            // Validate deposit_by - check if id exists in admin table
            if (!validateAdmin($this->depositBy)) {
                $errors['depositByError'] = 'That admin does not exist.';
            }

            // Todo - will need to check if exists
            // validate bankDepositDate - check if it is a valid date
            if ($this->checkNum != null && !validateDate($this->bankDepositDate)) {
                $errors['bankDepositDateError'] = 'Invalid Date';
            }

            //        $this->sourceType = $sourceType;
            //TODO - not sure what this is but need to validate

            //        $this->sourceId = $sourceId;
            //TODO - not sure what this is but need to validate


        }

        //Validate Amount Payed
        if (is_null($this->amount)) {
            $errors['amountError'] = 'Amount is required';
        } elseif (!validatePrice($this->amount)) {
            $errors['amountError'] = 'Amount was not valid';
        };

//        $this->transDate = $transDate;
        // validate bankDepositDate - check if it is a valid date
//        if (!validateDate($this->bankDepositDate)) {
//            $errors['dateModifiedError'] = 'Invalid Date';
//        }

        // Validate that there is a correct transaction type
        // A = C(A)sh
        // H = C(H)eck
        // R = C(R)edit
        $type = array('A', 'H', 'R');
        if (!in_array($this->transType, $type)) {
            $errors['transTypeError'] = 'Incorrect Payment Method.';
        };

        //If transaction type is check then require check number
        //Validate that checkNum is an integer
        if ($this->transType == "H") {
            if (!validateInteger($this->checkNum) || $this->checkNum <= 0 || $this->checkNum == null) {
                $errors['checkNumError'] = 'Check Number must be an integer.';
            }
        }

        // Validate transaction status, safe for a new transaction because we automatically set it to 'P';
        // P = Pending
        // D = Deposited
        // C = Cancelled
        $status = array('P', 'D', 'C');
        if (!in_array($this->transStatus, $status)) {
            $errors['transStatusError'] = 'Incorrect transaction status.';
        };

        // Validate contact_id - check if id exists in contact table
        if (!validateContact($this->contactId)) {
            $errors['contactIdError'] = 'That contact does not exist.';
        }

        // Validate dateCreated - check if it is a valid date
        if (!validateDateTime($this->dateCreated)) {
            $errors['dateCreatedError'] = 'Invalid Date';
        }

        // Validate created_by - check if id exists in admin table
        if (!validateAdmin($this->createdBy)) {
            $errors['createdByError'] = 'That admin does not exist.';
        }

        // Validate dateModified - check if it is a valid date
        // This is safe even for a new transaction since for new we set dateModified to dateCreated
        if (!validateDateTime($this->dateModified)) {
            $errors['dateModifiedError'] = 'Invalid Date';
        }

        // Validate modified_by - check if id exists in admin table
        // This is safe even for a new transaction since for new we set modifiedBy to createdBy
        if (!validateAdmin($this->modifiedBy)) {
            $errors['modifiedByError'] = 'That admin does not exist.';
        }

        // Validate each line item
        // TODO make sure that number times itemCost == amount of this line_item
        // TODO make sure that transaction item is still available in database
        $count = 1;
        foreach ($this->transactionItems as $item) {
            $errors['item' + $count] = array();
            $item->validateTransactionItem($errors['item' + $count]);
            $count++;
        }

        return $errors;
    }

    public function saveTransaction()
    {
        $errors = array();
        $this->validateTransaction($errors);
        if (sizeof($errors) <= 0) {
            //if valid, then save
            $saveToLocation = new DBTransaction();

            $this->id = $saveToLocation->addTransaction($this->id, $this->amount, $this->transDate, $this->checkNum,
                $this->depositById, $this->bankDepositDate, $this->transStatus, $this->transDesc,
                $this->sourceType, $this->sourceId, $this->transType, $this->contactId,
                $this->dateCreated, $this->createdBy, $this->dateModified, $this->modifiedBy,
                $this->transactionItems);

            $count = 1;
            foreach ($this->transactionItems as $item) {
                $item->saveTransactionItem($this->id, $count++);
            }
        }
    }
}