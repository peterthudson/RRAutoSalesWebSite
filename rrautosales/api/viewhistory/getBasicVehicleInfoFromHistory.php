<?php

    //-------------------------------------------------------------------
    //--- Returns the card info for vehicles in a user’s view history ---
    //-------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $user_id = $_GET['userID'];
    $pageNo = $_GET['page'];

    //call the function, passing in the attributes from the url
    $vehicleInfo = getBasicVehicleInfoFromHistory($user_id, $pageNo);

    //return the result
    echo $vehicleInfo;

?>