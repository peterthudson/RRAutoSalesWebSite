<?php

    //--------------------------------------------------------------------
    //--- Returns the number of vehicles there are of a specified type ---
    //--------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $type = $_GET['type'];

    //call the function, passing in the attributes from the url
    $pageCount = countVehicleTypes($type);

    //return the result
    echo $pageCount;

?>