<?php

    //---------------------------------------------------------------
    //--- Returns the number of vehicles in a user’s view history ---
    //---------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $userID = $_GET['userid'];

    //call the function, passing in the attributes from the url
    $result = countHistory($userID);

    //return the result
    echo $result;

?>