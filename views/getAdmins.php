<?php

    include_once($_SERVER['DOCUMENT_ROOT']."/kgc-crm-portal-team/model/db-admins.php");

    $results = DBAdmin::getAdmins();

    echo json_encode($results);
?>