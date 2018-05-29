<?php
/*
 *  details.php
 *  Cat-Wishes Final Project
 *  IT-328
 *  Melanie Felton
 *
 *  This file is called by the AJAX and retrieves a single item, returns with the HTML formatting
 */

include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-categories.php");

$dbItem = new DBCategories();
$results = $dbItem->getCategories();

foreach ($results as $result){
        echo "<option value='$result'>$result</option>";
}
?>