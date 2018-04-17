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
include_once ("./model/db-sku.php");

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

function validateSku($sku,$errors){

    //table name in database
    $table = "sku";

    //setting item to referenced db function
    $dbItem = new DBSku();

    //returning the item as lowercase to match the db column
    $skus = array_map('strtolower',$dbItem->getSkus(strtolower($table)));

    //if the sku is in the array (no error)
    if (in_array(strtolower($sku), $skus)){
        $errors['sku'] = "";
        return true;
    } else { //else the sku is not there display error
        $errors['sku']= "Sku not found.";
        return false;
    }
}