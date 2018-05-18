<?php
/**
 * Contains the Contact Class
 *
 * This class handles new and existing contacts
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @version 0.1
 */

include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/validation/backendValidations.php");
include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-contact.php");

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
        $this->zip = $zip;
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
    public static function getContacts($filterValues=null)
    {
        $contacts = DBContact::getContacts();
        $contactList = array();

        //loop through transactions
        foreach ($contacts as $contact){
            array_push($contactList, array(
                'id' => $contact['contact_id'],
                'name' => $contact['contact_name'],
                'address' => $contact['address'].', '.$contact['city'],
                'cell' => $contact['cell'],
                'phone' => $contact['phone'],
                'email' => $contact['email_address'],
                'altName' => $contact['alt_contact_name'],
                'altPhone' => $contact['alt_contact_phone']));


            //OLD WAY................................................
//        // construct transaction
//            $contactTemp = new Contact($contact['created_date'], $contact['created_by'],
//                $contact['contact_name'], $contact['address'], $contact['city'],
//                $contact['state'], $contact['zip'], $contact['phone'], $contact['cell'],
//                $contact['email_address'], $contact['alt_contact_name'],
//                                $contact['alt_contact_phone']);
//
//            // validate transaction
//            // if valid, add to transactions array
//            $errors = array();
//            if($contactTemp->validateContact($errors, false)){
//               $contactTemp->new = false;
//               $contactList[]=$contactTemp;
//            }
        }
        return $contactList;
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
        if(!validateName($this->contactName)){
            $errors['contactName'] = 'Invalid contact name';
        }
//        protected $address; // VARCHAR(200)
        if(!validateAddress($this->address)){
            $errors['address'] = 'Invalid address';
        }
//        protected $city; // VARCHAR(45)
        if(!validateName($this->city)){
            $errors['city'] = 'Invalid city';
        }
//        protected $state; // VARCHAR(2)
        if(!validateState($this->state)){
            $errors['state'] = 'Invalid state';
        }
//        protected $zip; // VARCHAR(10)
        if(!validateZip($this->zip)){
            $errors['zip'] = 'Invalid zip';
        }
//        protected $phone; // VARCHAR(15)
        if(!validatePhone($this->phone)){
            $errors['phone'] = 'Invalid phone number';
        }
//        protected $cell; // VARCHAR(15)
        if(!validatePhone($this->cell)){
            $errors['cell'] = 'Invalid cell phone number';
        }
//        protected $emailAddress; // VARCHAR(45)
        if(!validateEmail($this->emailAddress)){
            $errors['emailAddress'] = 'Invalid email address';
        }

//        protected $altContactName; // VARCHAR(45)
        if(!validateName($this->altContactName)){
            $errors['altContactName'] = 'Invalid alternate Contact Name';
        }
//        protected $altContactPhone; // VARCHAR(45)
        if(!validatePhone($this->altContactPhone)){
            $errors['altContactPhone'] = 'Invalid alternate contact phone number';
        }



        return $errors;
    }

    public function saveContact()
    {
        $errors = array();
//        $this->validateContact($errors);
        if (sizeof($errors) <= 0) {
            //if valid, then save
            $saveToLocation = new DBContact();

            $saveToLocation->addContact($this->contactName, $this->address, $this->city, $this->state,
                $this->zip, $this->phone, $this->cell, $this->emailAddress, $this->altContactName,
                $this->altContactPhone, $this->dateCreated, $this->createdBy, $this->dateModified, $this->modifiedBy);
        }
    }
}