<?php
/*
 *  details.php
 *  Cat-Wishes Final Project
 *  IT-328
 *  Melanie Felton
 *
 *  This file is called by the AJAX and retrieves a single item, returns with the HTML formatting
 */
//$table = $_POST['table'];
//$id = $_POST['id'];
//php error reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);
include_once("../model/db-object.php");
include_once("../model/db-sku.php");

$getSkus = function ($table, $category)
{

//    echo '<p>in sku file</p>';

//    $table = "sku";
    $dbItem = new DBSku();
    $results = $dbItem->getSku(strtolower($table));

    $skus = array();


    foreach ($results as $result) {
        if (strtolower($result['category']) === strtolower($category)) {
//            echo '<br>';
//            echo '<input type="radio" name="skus" value="' . $result['name'] . '" checked> ' . $result['name'] . '<br>';
            array_push($skus, $result);
        }
    }
    echo json_encode($skus);

};
$getSkus("sku", $_POST['category']);

?>