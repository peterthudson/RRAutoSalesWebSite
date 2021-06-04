<?php

    //------------------------------------------------------
    //--- Returns the number of vehicles in the database ---
    //------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //call the function, passing in the attributes from the url
    $allVehicles = countAllVehicles();

    //return the result
    echo $allVehicles;

?>