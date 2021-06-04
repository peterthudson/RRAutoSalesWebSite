<?php

    //---------------------------------------------------------------------------------------
    //--- Sets the owner attribute of a vehicle to the ID of the currently logged in user ---
    //---------------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //call the function, passing in the attributes from the url
    $userID = $_POST['userid'];
    $vehicleID = $_POST['vehicleid'];

    $result = buyVehicle($vehicleID, $userID);

    //return the result
    echo $result;

?>