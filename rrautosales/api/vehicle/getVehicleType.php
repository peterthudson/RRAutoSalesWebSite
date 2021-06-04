<?php

    //---------------------------------------------------------------
    //--- Returns a specific vehicle type option based on it's ID ---
    //---------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    $type = $_GET['type'];

    //call the function, passing in the attributes from the url
    $result = getVehicleType($type);

    //return the result
    echo $result;

?>