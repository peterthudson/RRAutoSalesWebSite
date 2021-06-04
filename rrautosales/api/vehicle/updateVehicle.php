<?php

    //--------------------------------------------------------------
    //--- Updates the attribute values of a specified vehicle ID ---
    //--------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //Get values
    $vehicleID = $_POST['vehicleid'];
    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $vehicleType = $_POST['vehType'];
    $driveType = $_POST['driveType'];
    $paintColour = $_POST['colour'];
    $region = $_POST['region'];
    $cylinders = $_POST['cylinders'];
    $fuelType = $_POST['fuelType'];
    $titleStatus = $_POST['title'];
    $transmissionType = $_POST['transmission'];
    $latitude = $_POST['lat'];
    $longitude = $_POST['long'];
    $odometer = $_POST['odometer'];
    $vin = $_POST['vin'];

    //call the function, passing in the attributes from the url
    $updateVehicle = updateVehicle($vehicleID,$manufacturer,$model,$condition,$price,$year,$vehicleType,$driveType,$paintColour,$region,$cylinders,$fuelType,$titleStatus,$transmissionType,$latitude,$longitude,$odometer,$vin);

    //return the result
    echo $updateVehicle;

?>