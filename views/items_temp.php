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
include_once("./model/db-object.php");
include_once("./model/db-item.php");

$getItems = function ($table, $category)
{
    $dbItem = new DBItem();
    $results = $dbItem->getItem(strtolower($table));

    $items = array();


    foreach ($results as $result) {
        if (strtolower($result['category']) === strtolower($category)) {
            array_push($items, $result);
        }
    }
    echo json_encode($items);

};
$getItems("item", $_POST['category']);

?>