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
include_once("./model/db-item.php");
echo '<p>in item file</p>';

$table = "item";

$dbItem = new DBItem();
$results = $dbItem->getItem(strtolower($table));

foreach ($results as $result){
    echo '<br>';
    echo '<input type="radio" name="items" value="'.$result['item_name'].'" checked> '.$result['item_name'].'<br>';
}
?>