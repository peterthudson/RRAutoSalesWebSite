<?php
    
    session_start();

    if(!isset($_SESSION["user_id"])){

        header("Location: http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/login.php");
    } else {

        $currentUser = $_SESSION["user_id"];

    }
    
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

        <!-- Javascript -->        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        
        <title>New Vehicle</title>
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
                    <div class="col-xs-9 col-sm-11 col-md-11 col-lg-11 col-xl-11 col-xxl-11">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center"><i class="material-icons text-info mr-2">new</i>Vehicle</h5>
                                <form class="form-signin" method='POST' action='processnewvehicle.php'>
                                    <div class="row justify-content-center">  
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">required</i>Info</h6>
                                            <hr>
                                            <!-- Manufacturer -->
                                            <div class="form-label-group">
                                                <h6>Manufacturer</h6>
                                                <select class="form-select form-select-sm" name="manufacturer" style="border-radius:5px" required>
                                                    <?php

                                                        $manuEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getManu.php";
                                                        $manuEndpResult = file_get_contents($manuEndp);
                                                        $manuList = json_decode($manuEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($manuList as $item) {

                                                            $value = $item["manu_name"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                    
                                                </select>
                                            </div>
                                            <!-- Model -->
                                            <div class="form-label-group">
                                                <h6>Model</h6>
                                                <input name="model" class="form-control" required>
                                            </div>
                                            <!-- Condition -->
                                            <div class="form-label-group">
                                                <h6>Condition</h6>
                                                <select class="form-select form-select-sm" name="condition" style="border-radius:5px" required>
                                                    <?php

                                                        $conditionEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getCondition.php";
                                                        $conditionEndpResult = file_get_contents($conditionEndp);
                                                        $conditionList = json_decode($conditionEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($conditionList as $item) {

                                                            $value = $item["condition"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Price -->
                                            <div class="form-label-group">
                                                <h6>Price</h6>
                                                <input name="price" class="form-control" required>
                                            </div>
                                            <!-- Year -->
                                            <div class="form-label-group">
                                                <h6>Year</h6>
                                                <select class="form-select form-select-sm" name="year" style="border-radius:5px" required>
                                                    <?php

                                                        echo "<option selected>--Select--</option>";
                                                        for($x=2021; $x >= 1950; $x--){
                                                            echo "<option value='$x'>$x</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Vehicle Types -->
                                            <div class="form-label-group">
                                                <h6>Vehicle Type</h6>
                                                <select class="form-select form-select-sm" name="vehType" style="border-radius:5px" required>
                                                    <?php

                                                        $vehTypesEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getVehTypes.php";
                                                        $vehTypesEndpResult = file_get_contents($vehTypesEndp);
                                                        $vehTypesList = json_decode($vehTypesEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($vehTypesList as $item) {

                                                            $value = $item["type"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Drive Type -->
                                            <div class="form-label-group">
                                                <h6>Drive Type</h6>
                                                <select class="form-select form-select-sm" name="driveType" style="border-radius:5px" required>
                                                    <?php

                                                        $driveTypeEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getDriveType.php";
                                                        $driveTypeEndpResult = file_get_contents($driveTypeEndp);
                                                        $driveTypeList = json_decode($driveTypeEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($driveTypeList as $item) {

                                                            $value = $item["drivetype"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Colour -->
                                            <div class="form-label-group">
                                                <h6>Paint Colour</h6>
                                                <select class="form-select form-select-sm" name="colour" style="border-radius:5px" required>
                                                    <?php

                                                        $colourEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getColour.php";
                                                        $colourEndpResult = file_get_contents($colourEndp);
                                                        $colourList = json_decode($colourEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($colourList as $item) {

                                                            $value = $item["colour"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Region -->
                                            <div class="form-label-group">
                                                <h6>Region</h6>
                                                <select class="form-select form-select-sm" name="region" style="border-radius:5px" required>
                                                    <?php

                                                        $regionEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getRegion.php";
                                                        $regionEndpResult = file_get_contents($regionEndp);
                                                        $regionList = json_decode($regionEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($regionList as $item) {

                                                            $value = $item["region"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">optional</i>Info</h6>
                                            <hr>
                                            <!-- Cylinders -->
                                            <div class="form-label-group">
                                                <h6>Cylinders</h6>
                                                <select class="form-select form-select-sm" name="cylinders" style="border-radius:5px">
                                                    <?php

                                                        $cylindersEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getCylinders.php";
                                                        $cylindersEndpResult = file_get_contents($cylindersEndp);
                                                        $cylindersList = json_decode($cylindersEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($cylindersList as $item) {

                                                            $value = $item["cylinders"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <!-- Fuel Type -->
                                            <div class="form-label-group">
                                                <h6>Fuel Type</h6>
                                                <select class="form-select form-select-sm" name="fuelType" style="border-radius:5px">
                                                    <?php

                                                        $fuelTypeEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getFuelTypes.php";
                                                        $fuelTypeEndpResult = file_get_contents($fuelTypeEndp);
                                                        $fuelTypeList = json_decode($fuelTypeEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($fuelTypeList as $item) {

                                                            $value = $item["fueltype"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Title Status -->
                                            <div class="form-label-group">
                                                <h6>Title Status</h6>
                                                <select class="form-select form-select-sm" name="title" style="border-radius:5px">
                                                    <?php

                                                        $titleEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getTitle.php";
                                                        $titleEndpResult = file_get_contents($titleEndp);
                                                        $titleList = json_decode($titleEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($titleList as $item) {

                                                            $value = $item["title"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Transmission -->
                                            <div class="form-label-group">
                                                <h6>Transmission Type</h6>
                                                <select class="form-select form-select-sm" name="transmission" style="border-radius:5px">
                                                    <?php

                                                        $transEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getTrans.php";
                                                        $transEndpResult = file_get_contents($transEndp);
                                                        $transList = json_decode($transEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($transList as $item) {

                                                            $value = $item["trans"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Latitude</h6>
                                                <input name="lat" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Longitude</h6>
                                                <input name="long" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Odometer</h6>
                                                <input name="odometer" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>VIN</h6>
                                                <input name="vin" class="form-control">
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-label-group">
                                            <button class="btn btn-lg btn-outline-info btn-block text-uppercase" type="submit">Submit</button>
                                        </div> 
                                    </div>     
                                </form>                                
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

    </body>
</html>
