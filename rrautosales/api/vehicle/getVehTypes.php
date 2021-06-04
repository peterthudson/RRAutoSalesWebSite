<?php

    //------------------------------------------------------------------
    //--- Returns a list of the vehicle type options in the database ---
    //------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //call the function, passing in the attributes from the url
    $allVehTypes = getVehType();

    //return the result
    echo $allVehTypes;

?>