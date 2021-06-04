<?php

    //----------------------------------------------------------
    //--- Checks that a user has vehicles in their wish list ---
    //----------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $user_id = $_GET['userid'];

    //call the function, passing in the attributes from the url
    $result = checkWishlist($user_id);

    //return the result
    echo $result;

?>