<?php

    //------------------------------------
    //--- Creates a new vehicle record ---
    //------------------------------------
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //include the functions file
        $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
        include($functionpath);

        //We reference the data by the keys in the array that was passed 
        $manufacturer = $_POST["manufacturer"];
        $condition = $_POST["condition"];
        $year = $_POST["year"];
        $vehType = $_POST["vehType"];
        $driveType = $_POST["driveType"];
        $colour = $_POST["colour"];
        $region = $_POST["region"];
        $cylinders = $_POST["cylinders"];
        $fuelType = $_POST["fuelType"];
        $title = $_POST["title"];
        $transmission = $_POST["transmission"];
        $lat = $_POST["lat"];
        $long = $_POST["long"];
        $odometer = $_POST["odometer"];
        $vin = $_POST["vin"];
        $price = $_POST["price"];
        $model = $_POST["model"];
        $user = $_POST["user"];

        $createNewVehicle = newVehicle($manufacturer, $condition, $year, $vehType, $driveType, $colour,$region,$cylinders,$fuelType,$title,$transmission,$lat,$long,$odometer,$vin,$price,$model,$user);

        //Return a message to say that the query has been completed or return the error message.
        echo $createNewVehicle;

    }

?>