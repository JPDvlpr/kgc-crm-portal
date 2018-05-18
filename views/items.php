<?php
/*
 *  items.php
 *  CRM Portal Final Project
 *  IT-355
 *  Just oK TeaM
 *
 *  This file gets the categories and subcategories from the database for display
 */

include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-object.php");
include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-item.php");
include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-categories.php");

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