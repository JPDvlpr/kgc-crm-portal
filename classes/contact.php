<?php
/**
 * Contains the Contact Class
 *
 * This class handles new and existing contacts
 *
 * @author JustoKTeaM (mfelton@mail.greenriver.edu)
 * @version 0.1
 */

include_once($_SERVER['DOCUMENT_ROOT'] . "/kgc-crm-portal-team/validation/backendValidations.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/kgc-crm-portal-team/model/db-contact.php");

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
    public static function getContacts($filterValues = null)
    {
        $contacts = DBContact::getContacts();
        $contactList = array();

        //loop through transactions
        foreach ($contacts as $contact) {
            array_push($contactList, array(
                'id' => $contact['contact_id'],
                'name' => $contact['contact_name'],
                'address' => $contact['address'] . ' ' . $contact['city'] . ', ' . $contact['state'] . ' ' . $contact['zip'],
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

        // Validate dateCreated - check if it is a valid date
        if (!validateDateTime($this->dateCreated)) {
            $errors['dateCreatedError'] = 'Invalid Date'.$this->dateCreated;
        }

        // Validate created_by - check if id exists in admin table
        if (!validateAdmin($this->createdBy)) {
            $errors['createdByError'] = 'That admin does not exist.';
        }

        // Validate dateModified - check if it is a valid date
        if (!validateDateTime($this->dateModified)) {
            $errors['dateModifiedError'] = 'Invalid Date';
        }

        // Validate modified_by - check if id exists in admin table
        if (!validateAdmin($this->modifiedBy)) {
            $errors['modifiedByError'] = 'That admin does not exist.';
        }

        // Validate Contact Name (required)
        if ($this->contactName == null || $this->contactName == "") {
            $errors['contactNameError'] = 'Contact Name is required';
        } elseif (!validateName($this->contactName)) {
            $errors['contactNameError'] = 'Invalid contact name';
        }

        // Validate address (required)
        if ($this->address == null || $this->address == "") {
            $errors['addressError'] = 'Address is required';
        } elseif (!validateAddress($this->address)) {
            $errors['addressError'] = 'Invalid address';
        }

        // Validate city (required)
        if ($this->city == null || $this->city == "") {
            $errors['cityError'] = 'City is required';
        } elseif (!validateName($this->city)) {
            $errors['cityError'] = 'Invalid city';
        }

        // Validate state (required)
        if ($this->state == null || $this->state == "") {
            $errors['stateError'] = 'State is required';
        } elseif (!validateState($this->state)) {
            $errors['stateError'] = 'Invalid state';
        }

        // Validate zip (required)
        if ($this->zip == null || $this->zip == "") {
            $errors['zipError'] = 'Zip is required';
        } elseif (!validateZip($this->zip)) {
            $errors['zipError'] = 'Invalid zip';
        }

        // Validate phone numbers (required)
        if (($this->phone == null || $this->phone == "") && ($this->cell == null || $this->cell == "")) {
            $errors['phoneError'] = 'Must enter at least one phone number';
            $errors['cellError'] = 'Must enter at least one phone number';
        }
        else {
            if (!empty($this->phone) && !validatePhone($this->phone)) {
                $errors['phoneError'] = 'Invalid phone number';
            }
            if (!empty($this->cell) && !validatePhone($this->cell)) {
                $errors['cellError'] = 'Invalid cell phone number';
            }
        }

        // Validate email (required)
        if ($this->emailAddress == null || $this->emailAddress == "") {
            $errors['emailAddressError'] = 'Email address is required';
        } elseif (!validateEmail($this->emailAddress)) {
            $errors['emailAddressError'] = 'Invalid email address';
        }

        // Validate Alternate Contact Name (not required)
        if(!empty($this->altContactName)) {
            if (!validateName($this->altContactName)) {
                $errors['altContactNameError'] = 'Invalid alternate Contact Name';
            }
        }

        // Validate Alternate Contact Phone (not required)
        if(!empty($this->altContactPhone)) {
            if (!validatePhone($this->altContactPhone)) {
                $errors['altContactPhoneError'] = 'Invalid alternate contact phone number';
            }
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