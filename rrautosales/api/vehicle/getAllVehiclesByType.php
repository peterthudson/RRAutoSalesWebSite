<?php

    //----------------------------------------------------------------------------------------
    //--- Returns the information of a specified type of vehicle for a set page of results ---
    //----------------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $vehicle_type = $_GET['type'];
    $pageNo = $_GET['page'];

    //call the function, passing in the attributes from the url
    $allVehicles = getBasicVehicleInfoByType($vehicle_type, $pageNo);

    //return the result
    echo $allVehicles;

?>