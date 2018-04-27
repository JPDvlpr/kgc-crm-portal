<?php
/*
 *  details.php
 *  Cat-Wishes Final Project
 *  IT-328
 *  Melanie Felton
 *
 *  This file is called by the AJAX and retrieves a single item, returns with the HTML formatting
 */

include_once("./model/db-object.php");
include_once("./model/db-sku.php");
echo '<p>in sku file</p>';

$table = "sku";

$dbItem = new DBSku();
$results = $dbItem->getItem(strtolower($table));

foreach ($results as $result){
    echo '<br>';
    echo '<input type="radio" name="items" value="'.$result['name'].'" checked> '.$result['name'].'<br>';
}
?>