<?php

    //---------------------------------------------------
    //--- Remove a vehicle from a user’s view history ---
    //---------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //We reference the data by the keys in the array that was passed 
    $userID = $_GET['userID'];
    $vehicleID = $_GET['vehicleID'];

    $removeFromHistory = removeFromHistory($userID, $vehicleID);
    echo $removeFromHistory;
    

?>