<?php
/*
    *  backendValidations.php
    *  KGC CRM Portal
    *  IT-355
    *  Just oK TeaM
    *
    *  This file contains the backend validations that use PHP.
    */

include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-categories.php");
include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-item.php");
include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-transaction.php");


function validateDate($date)
{
    $date = trim($date);
    $date = explode('-', $date);
    return checkdate($date[1], $date[2], $date[0]);
}

/**
 * Takes in the category the user chose, and the error messages array. It
 * checks if the category is one of the valid categories and returns T/F. If
 * false it adds an error message to the errors array.
 *
 * @param $category - the category to be checked
 * @param $errors - the array of errors
 * @return bool - whether or not the category was valid
 */
function validateCategory($category, $errors)
{
    $table = "category";

    $dbItem = new DBCategories();
    $categories = array_map('strtolower', $dbItem->getCategories(strtolower($table)));

    if (in_array(strtolower($category), $categories)) {
        unset($errors['category']);
        return true;
    } else {
        $errors['category'] = "Category not found.";
        return false;
    }
}

function validateItemId($itemID)
{
    $regex_id = "/^[0-9]+$/";
    return (preg_match($regex_id, $itemID));
//    //table name in database
//    $table = "item";
//
//    //setting item to referenced db function
//    $dbItem = new DBItem();
//
//    //returning the item as lowercase to match the db column
//    //Todo: array_map doesn't seem to be working so trying something else
////    $items = array_map('strtolower', $dbItem->getItem(strtolower($table)));////
//    $results = $dbItem->getItem(strtolower($table));
//    foreach($results as $result){
//        $itemIds[] = $result['item_id'];
//    }
//    //if the sku is in the array (no error)
//    if (in_array($item, $itemIds)) {
////        $errors['item'] = "";
//        return true;
//    } else { //else the sku is not there display error
////        $errors['item'] = "Item not found.";
//        return false;
//    }
}

//validate admin by pulling from admin file
//admin id exists in admins table
//need to create a db-admin.php file
function validateAdmin($adminID)
{
    $regex_id = "/^[0-9]+$/";
    return (preg_match($regex_id, $adminID));
}

//validate contact by pulling from admin file
//contact id exists in contact table
//needs to create a db-contact.php file
function validateContact($contactID)
{
    $regex_id = "/^[0-9]+$/";
    return (preg_match($regex_id, $contactID));
}

//validateDate();

// need to pass in one variable that is of type DateTime
// haven't been able to get to work  - thought there was something to
// let me break up a date time but can't find right now.
// Commenting everything out and having it return True
function validateDateTime($datetime)
{
    $datetime = trim($datetime);

    $date = substr($datetime, 0, 10);
    $time = substr($datetime, 11);

    $regex = "/\s?[0-2][0-9]:[0-5][0-9]:[0-5][0-9]\s?/";//regular expression for time(HH:MM:SS)

    return validateDate($date) && preg_match($regex, $time);
}

// used for validating this like the description of
// an item donation
function validateString($string)
{
    return ctype_alpha($string);
}

//validates the price input
function validatePrice($price)
{
//  price has integer(s) (dollar amount)
//  split by a decimal
//  and follows with 2 integers (cents)
    $regex_price = "/^[0-9]+(\.[0-9]{2})?$/";
    return (preg_match($regex_price, $price));
}

//validate integers
function validateInteger($integer)
{
    $test = "/^[0-9]+$/";
    return (preg_match($test, $integer));
}

function validateName($name)
{
    $regex_name = "/^\D(\w|\s|(?:[' , . -])){0,200}$/i";
    return (preg_match($regex_name, $name));
}

function validateAddress($address)
{
    $regex_address = "/^\d+?[A-Za-z]*\s\w*\s?\w+?\s\w{2}\w*\s*\w*$/";
    return preg_match($regex_address, $address);
}

function validateState($state)
{
    $states = array('WA','AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL',
        'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
        'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM',
        'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN',
        'TX', 'UT', 'VT', 'VA', 'WV', 'WI', 'WY');
    $provinces = array('AB', 'BC', 'MB', 'NB', 'NS', 'ON', 'QC', 'SK');
    return (in_array($state, $states) || in_array($state, $provinces));
}

function validateZip($zip)
{
    $regexp = "/^\d{5,9}$/i";
    return preg_match($regexp, $zip);
}

//protected $phone; // VARCHAR(15)
function validatePhone($phone)
{
    $regex_phone = "/^\d{10}$/i";
    return preg_match($regex_phone, $phone);
}

function validateEmail($email)
{
    $regex_email = "/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/";
    return (preg_match($regex_email, $email));
}