<?php

    //--------------------------------------------------
    //--- Deletes a vehicle record from the database ---
    //--------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $vehicleID = $_GET['vehicleid'];

    //call the function, passing in the attributes from the url
    $result = deleteVehicle($vehicleID);

    //return the result
    echo $result;

?>