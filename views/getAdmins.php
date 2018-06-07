<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/kgc-crm-portal-team/model/db-admins.php");

$results = DBAdmin::getAdmins();

// added for each to retrieve admins
foreach ($results as $result) {
    echo "<option value='" . $result['admin_id'] . "'>" . $result['admin_name'] . '</option>';
}
?>