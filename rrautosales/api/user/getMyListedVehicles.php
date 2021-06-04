<?php

    //----------------------------------------------------------------------------------------
    //--- Returns the information about the vehicles that a given user has listed for sale ---
    //----------------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $user_id = $_GET['userid'];
    $pageNo = $_GET['page'];

    //call the function, passing in the attributes from the url
    $myVehicles = getMyListedVehicles($user_id, $pageNo);

    //return the result
    echo $myVehicles;

?>