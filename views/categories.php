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

include_once("../model/db-object.php");
include_once("../model/db-categories.php");

$table = "category";

$dbItem = new DBCategories();
$results = $dbItem->getCategories(strtolower($table));

foreach ($results as $result){
    echo "<div class='radio'>";
        echo "<label><input type='radio' class='category' name='category' value='".$result['name']."'> ".ucfirst($result['name'])."</label>";
    echo "</div>";
}
?>