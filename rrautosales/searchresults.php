<?php

    session_start();

    
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

        <title>TEMPLATE</title>
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
                    <div class="col-sm-12 col-md-12 col-lg-8 mx-auto">
                        <div class="card card-signin my-5 text-center">
                            <div class="card-body" style="padding-bottom:10px">
                                <form class="form-signin" method='POST' action='searchresults.php?pageNo=1'>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" style="border-right-style:inset">
                                            <div class="form-label-group">
                                                <!-- Manufacturer -->
                                                <p style="margin-bottom:0px">Manufacturer</p>
                                                <select class="form-select form-select-sm" name="manufacturer" style="border-radius:5px" required>
                                                    <?php

                                                        $manuEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getManu.php";
                                                        $manuEndpResult = file_get_contents($manuEndp);
                                                        $manuList = json_decode($manuEndpResult, true);
                                                        $counter = 0;

                                                        echo "<option selected>--Select--</option>";
                                                        foreach ($manuList as $item) {

                                                            $value = $item["manu"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Condition -->
                                            <div class="form-label-group">
                                                <p style="margin-bottom:0px">Condition</p>
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
                                            <!-- Drive Type -->
                                            <div class="form-label-group">
                                                <p style="margin-bottom:0px">Drive Type</p>
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
                                            <!-- Vehicle Types -->
                                            <div class="form-label-group">
                                                <p style="margin-bottom:0px">Vehicle Type</p>
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
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" style="border-right-style:inset">
                                            <!-- Colour -->
                                            <div class="form-label-group">
                                                <p style="margin-bottom:0px">Paint Colour</p>
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
                                                <p style="margin-bottom:0px">Region</p>
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
                                            <!-- Cylinders -->
                                            <div class="form-label-group">
                                                <p style="margin-bottom:0px">Cylinders</p>
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
                                                <p style="margin-bottom:0px">Fuel Type</p>
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
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                            <!-- Title Status -->
                                            <div class="form-label-group">
                                                <p style="margin-bottom:0px">Title Status</p>
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
                                                <p style="margin-bottom:0px">Transmission</p>
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
                                            <!-- Price -->
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-label-group">
                                                        Price <i>(Min)</i>
                                                        <input type="number" name="priceMin" class="form-control" min="0" oninput="validity.valid||(value='');">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-label-group">
                                                        Price <i>(Max)</i>
                                                        <input type="number" name="priceMax" class="form-control" min="0" oninput="validity.valid||(value='');">
                                                    </div>
                                                </div> 
                                            </div>
                                            <!-- Price -->
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-label-group">
                                                        Year <i>(Min)</i>
                                                        <input type="number" name="yearMin" class="form-control" min="0" oninput="validity.valid||(value='');">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-label-group">
                                                        Year <i>(Max)</i>
                                                        <input type="number" name="yearMax" class="form-control" min="0" oninput="validity.valid||(value='');">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-3 text-align-right">
                                            <button class="btn btn-lg btn-outline-primary btn-block" type="submit">search</button>
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

        

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    </body>
</html>
