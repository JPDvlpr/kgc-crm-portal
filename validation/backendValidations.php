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

/**
 * Takes in the category the user chose, and the error messages array. It
 * checks if the category is one of the valid categories and returns T/F. If
 * false it adds an error message to the errors array.
 *
 * @param $category - the category to be checked
 * @param $errors - the array of errors
 * @return bool - whether or not the category was valid
 */
function validateCategory($category,$errors){
    $table = "category";

    $dbItem = new DBCategories();
    $categories = array_map('strtolower',$dbItem->getCategories(strtolower($table)));

    if (in_array(strtolower($category), $categories)){
        $errors['category'] = "";
        return true;
    } else {
        $errors['category']="Category not found.";
        return false;
    }
}