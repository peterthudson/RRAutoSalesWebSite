<?php

    //--------------------------------------------------------------------------------
    //--- Returns the information of all vehicle records for a set page of results ---
    //--------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //Get values from the endpoint url
    $pageNo = $_GET['pageNo'];

    //call the function, passing in the attributes from the url
    $allVehicles = getAllVehicles($pageNo);

    //return the result
    echo $allVehicles;

?>