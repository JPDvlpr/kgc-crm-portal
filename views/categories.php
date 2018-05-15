<?php
/*
 *  details.php
 *  Cat-Wishes Final Project
 *  IT-328
 *  Melanie Felton
 *
 *  This file is called by the AJAX and retrieves a single item, returns with the HTML formatting
 */

include_once($_SERVER['HOME']."/public_html/355/kgc-crm-portal-team/model/db-object.php");
include_once($_SERVER['HOME']."/public_html/355/kgc-crm-portal-team/model/db-categories.php");

$dbItem = new DBCategories();
$results = $dbItem->getCategories();

foreach ($results as $result){
    if($result != 'Discount'){
        echo "<div class='radio'>";
            echo "<label class='category' id='".$result."'><input type='radio' name='category' value='".$result."'> ".ucfirst($result)."</label>";
        echo "</div>";
    }
}
?>