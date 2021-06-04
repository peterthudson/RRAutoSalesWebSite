<?php

    //------------------------------------------------------
    //--- Checks that a vehicle is in a user’s wish list ---
    //------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $user_id = $_GET['userid'];
    $vehicle_id = $_GET['vehicleid'];

    //call the function, passing in the attributes from the url
    $result = checkUserWishlist($user_id, $vehicle_id);

    //return the result
    echo $result;

?>