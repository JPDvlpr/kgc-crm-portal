<?php

/*
    *  backendValidations.php
    *  KGC CRM Portal
    *  IT-355
    *  Just oK TeaM
    *
    *  This file contains the backend validations that use PHP.
    */

include_once("./model/db-object.php");
include_once("./model/db-categories.php");
include_once("./model/db-item.php");
include_once("./model/db-transaction.php");

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

function validateItemId($item)
{
    //Not working so for now just returns true
    return true;
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

//validates the price input
function validatePrice($price)
{
//  price has integer(s) (dollar amount)
//  split by a decimal
//  and follows with 2 integers (cents)
    $test = "/^[0-9]+(\.[0-9]{2})?$/";
    if (preg_match($test, $price)) {
//        echo "price is correct";
        return true;
    } else {
//        echo "enter a decimal";
        return false;
    }
}

//validate integers
function validateInteger($integer)
{
    if (is_int($integer)) {
//        echo "integer is valid";
        return true;
    } else {
//        echo "integer is not valid";
        return false;
    }
}

//validate admin by pulling from admin file
//admin id exists in admins table
//need to create a db-admin.php file
function validateAdmin($adminID)
{
    return true;
}

//validate contact by pulling from admin file
//contact id exists in contact table
//needs to create a db-contact.php file
function validateContact($contactID)
{
    return true;
}

function validateTime($time)
{
    $regex = preg_match("/^(?:1[012]|0[0-9]):[0-5][0-9]$/", $time);
//    if ($regex == true) {
//        echo "correctnessss";
//    } else {
//        echo "incorrectnessss";
//    }
    return $regex;
}

function validateDate($date)
{
    //Maybe I created my date wrong, but this is failing so returning true for now
    return true;
//    if (!checkdate($date['month'], $date['day'], $date['year'])) {
//        return false;
//    } else {
//        return true;
//    }
}

// need to pass in one variable that is of type DateTime
// haven't been able to get to work  - thought there was something to
// let me break up a date time but can't find right now.
// Commenting everything out and having it return True
function validateDateTime($datetime)
{
//    echo '<pre>';
//    var_dump($datetime);
//    echo '</pre>';
//    $time = 0;
//    if (!checkdate($datetime['month'], $datetime['day'], $datetime['year']) && !validateTime($time)) {
//        return false;
//    } else {
//        return true;
//    }
    return true;
}

// used for validating this like the description of
// an item donation
function validateString($string)
{
    return ctype_alpha($string);
}
