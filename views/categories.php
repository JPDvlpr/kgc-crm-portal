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

include("./model/db-object.php");
include("./model/db-categories.php");

$table = "category";

$dbItem = new DBCategories();
$results = $dbItem->getCategories(strtolower($table));

echo '<p>in categories file</p>';

foreach ($results as $result){
    echo '<input type="radio" name="category" value="'.$result['name'].'" checked> '.$result['name'].'<br>';
}
?>