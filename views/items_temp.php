<?php
/*
 *  details.php
 *  Cat-Wishes Final Project
 *  IT-328
 *  Melanie Felton
 *
 *  This file is called by the AJAX and retrieves a single item, returns with the HTML formatting
 */
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once("../model/db-object.php");
include_once("../model/db-item.php");
include_once("../model/db-categories.php");

$getItems = function ($table, $category)
{
    $dbItem = new DBItem();
    $results = $dbItem->getItem(strtolower($table));

    $dbCategory = new DBCategories();
    $catId = $dbCategory->getId($category);

    $items = array();

    foreach ($results as $result) {
        if (($result['cat_id']) == $catId) {
            array_push($items, $result);
        }
    }
    echo json_encode($items);

};
$getItems("item", $_POST['category']);

?>