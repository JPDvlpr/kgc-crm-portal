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
include_once("transactionItem.php");

/**
 * Class "Contact" represents a contact on the CRM Portal. A contact may be
 * a parent and/or a donor.
 *
 * The Contact class represents a contact with:
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @copyright 2018
 *
 */
class Contact
{
    protected $contactId; // INT(11)
    protected $contactName; // VARCHAR(200)
    protected $address; // VARCHAR(200)
    protected $city; // VARCHAR(45)
    protected $state; // VARCHAR(2)
    protected $zip; // VARCHAR(10)
    protected $phone; // VARCHAR(15)
    protected $cell; // VARCHAR(15)
    protected $emailAddress; // VARCHAR(45)
    protected $altContactName; // VARCHAR(45)
    protected $altContactPhone; // VARCHAR(45)
    protected $dateCreated; // DATETIME
    protected $createdBy; // INT(11)
    protected $dateModified; // DATETIME
    protected $modifiedBy; // INT(11)
    protected $errors; // an array of errors indexed by the field (TODO figure out how this will work with the array of transaction items!)
    protected $new;

    /**
     * Transaction constructor.
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
     */
    public function __construct($createdDate, $createdBy, $contactName, $address, $city, $state, $zip, $phone = null, $cell = null, $emailAddress = null, $altContactName = null,
                                $altContactPhone = null)
    {
        $this->new = true;
        $this->contactName = $contactName; // change to use random generator
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = zip;
        $this->phone = $phone;
        $this->cell = $cell;
        $this->emailAddress = $emailAddress;
        $this->altContactName = $altContactName;
        $this->altContactPhone = $altContactPhone;
        $this->dateCreated = $createdDate;
        $this->createdBy = $createdBy;
        $this->dateModified = $createdDate;
        $this->modifiedBy = $createdBy;
    }

    // creates and returns an array of transactions from the database
    // may return only a single Transaction, e.g if filter is id
    public static function getContacts($filters, $filterValues)
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
    public function validateContact($errors, $new = true)
    {
        //if not new validate contact id - it should be an int and exist in the database.
        if (!$new) {
            if (!validateInteger($this->contactId)) {
                //TODO - should this be a check for an integer or a check for existence in database
                $errors['contactId'] = 'That contact does not exist.';
            }
        }

        // validate dateCreated - check if it is a valid date
        if (!validateDateTime($this->dateCreated)) {
            $errors['dateCreated'] = 'Invalid Date';
        }

        // validate created_by - check if id exists in admin table
        if (!validateAdmin($this->createdBy)) {
            $errors['createdBy'] = 'That admin does not exist.';
        }

        // validate dateModified - check if it is a valid date
        if (!validateDateTime($this->dateModified)) {
            $errors['dateModified'] = 'Invalid Date';
        }

        // validate modified_by - check if id exists in admin table
        if (!validateAdmin($this->modifiedBy)) {
            $errors['modifiedBy'] = 'That admin does not exist.';
        }

//        protected $contactName; // VARCHAR(200)
//        protected $address; // VARCHAR(200)
//        protected $city; // VARCHAR(45)
//        protected $state; // VARCHAR(2)
//        protected $zip; // VARCHAR(10)
//        protected $phone; // VARCHAR(15)
//        protected $cell; // VARCHAR(15)
//        protected $emailAddress; // VARCHAR(45)
//        protected $altContactName; // VARCHAR(45)
//        protected $altContactPhone; // VARCHAR(45)



        return $errors;
    }

    public function saveContact()
    {
        $errors = array();
        $this->validateContact($errors);
        if (sizeof($errors) <= 0) {
            //if valid, then save
            $saveToLocation = new DBContact();

            $saveToLocation->addContact($this->contactName, $this->address, $this->city, $this->state,
                $this->zip, $this->phone, $this->cell, $this->emailAddress, $this->altContactName,
                $this->altContactPhone, $this->dateCreated, $this->createdBy, $this->dateModified, $this->modifiedBy);
        }
    }
}