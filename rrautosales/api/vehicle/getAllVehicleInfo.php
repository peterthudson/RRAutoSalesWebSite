<?php

    //-----------------------------------------------------------------------------
    //--- Returns all attribute values for a vehicle record with a specified ID ---
    //-----------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $vehicle_id = $_GET['id'];

    //call the function, passing in the attributes from the url
    $allVehicles = getAllVehicleInfo($vehicle_id);

    //return the result
    echo $allVehicles;

?>