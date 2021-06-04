<?php

    session_start();

    $vehicleID = $_GET['vehicleid'];
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

    $url = 'http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/updateVehicle.php';
    
    $postdata = http_build_query(

        array(
            'vehicleid' => $vehicleID,
            'manufacturer' => $manufacturer,
            'model' => $model,
            'condition' => $condition,
            'price' => $price,
            'year' => $year,
            'vehType' => $vehicleType,
            'driveType' => $driveType,
            'colour' => $paintColour,
            'region' => $region,
            'cylinders' => $cylinders,
            'fuelType' => $fuelType,
            'title' => $titleStatus,
            'transmission' => $transmissionType,
            'lat' => $latitude,
            'long' => $longitude,
            'odometer' => $odometer,
            'vin' => $vin
        )
    );

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' =>  'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
        
    $context  = stream_context_create($options);
    $updateResult = file_get_contents($url, false, $context);

    $exitCode = strval($updateResult);

?>

<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link href="/rrautosales/css/mystyles.css" rel="stylesheet">

        <!-- favicon -->
        <link rel="icon" href="/rrautosales/img/favicon.png" type="image/png" sizes="16x16">

        <!-- Icons from ionicons.com -->
        <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>

        <title>Profile Update</title>
    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <div class="container-fluid" id=mainbodycontent>
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card card-signin my-5 text-center">
                            <div class="card-header">
                                <h3 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">update</i>Profile</h3>
                            </div>
                            <div class="card-body">
                                <?php 
                                    if(strcmp($exitCode, "success") == 0) {
                                        echo "<h5 class='card-title'>Listing Update Error</h5>";
                                        echo "<img src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/error.PNG'>";
                                        echo "<div class='card-text' style='margin-top:10px'>An error has occurred, please check the information entered in the form and try again";
                                        echo "<p style='margin-top:10px'><a href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/editvehicle.php?vehicleid=$vehicleID' class='btn btn-primary rounded-pill' tabindex='-1' role='button' aria-disabled='true'>Back</a></p>";
                                    } else {
                                        echo "<h5 class='card-title'>Listing Updated Successfully</h5>";
                                        echo "<img src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/tick.PNG'>";
                                        echo "<div class='card-text' style='margin-top:10px'>Vehicle listing has been updated. Click on the button below to return to the listing";
                                        echo "<p style='margin-top:10px'><a href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/details.php?id=$vehicleID' class='btn btn-primary rounded-pill' tabindex='-1' role='button' aria-disabled='true'>Vehicle Listing</a></p>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add the Footer to the bottom of the page -->
        <?php
            $footerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/footer.php";
            include($footerpath);
        ?>

        

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    </body>
</html>
