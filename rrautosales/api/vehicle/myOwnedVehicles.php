<?php

    //---------------------------------------------------------------------------
    //--- Returns a list of the vehicles listed for sale for a specifies user ---
    //---------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    $userID = $_GET['userid'];

    //call the function, passing in the attributes from the url
    $myOwnedVehicles = myOwnedVehicles($userID);

    //return the result
    echo $myOwnedVehicles;

?>