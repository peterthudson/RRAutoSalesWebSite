<?php

    //-----------------------------------------------------------------------------------
    //--- Returns the details of vehicles that match a number of specified attributes ---
    //-----------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $manufacturer = $_POST['manu'];
    $condition = $_POST['cond'];
    $driveType = $_POST['drive'];
    $vehType = $_POST['vehicle'];
    $colour = $_POST['colour'];
    $region = $_POST['region'];
    $cylinders = $_POST['cylinders'];
    $fuelType = $_POST['fuel'];
    $title = $_POST['title'];
    $transmission = $_POST['transmission'];
    $priceMin = $_POST['pricemin'];
    $priceMax = $_POST['pricemax'];
    $yearMin = $_POST['yearmin'];
    $yearMax = $_POST['yearmax'];

    //call the function, passing in the attributes from the url
    $result = detailedSearch($manufacturer,$condition,$driveType,$vehType,$colour,$region,$cylinders,$fuelType,$title,$transmission,$priceMax,$priceMin,$yearMax,$yearMin);

    //return the result
    echo $result;

?>