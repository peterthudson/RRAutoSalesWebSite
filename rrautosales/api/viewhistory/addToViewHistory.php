<?php

    //-----------------------------------------------
    //--- Adds a vehicle to a user’s view history ---
    //-----------------------------------------------

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //include the functions file
        $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
        include($functionpath);

        //We reference the data by the keys in the array that was passed 
        $userID = $_POST['userID'];
        $vehicleID = $_POST['vehicleID'];

        //Check that the vehicle is not already in the view history. If it is not, then add it
        if (!checkUserHistory($userID, $vehicleID)){
            $addToViewHistory = addToViewHistory($userID, $vehicleID);
            echo $addToViewHistory;
        }
    }

?>