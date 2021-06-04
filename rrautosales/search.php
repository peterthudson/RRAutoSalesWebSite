<?php

    session_start();

        if (isset($_POST['searchbutton'])) {

            //Set the page number to one so that pagination can be implemented later
            $pageNo = 1;

            $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/detailedSearch.php";

            $postdata = http_build_query(

                array(
                    'manu' => $_POST['manufacturer'],
                    'cond' => $_POST['condition'],
                    'drive' => $_POST['driveType'],
                    'vehicle' => $_POST['vehType'],
                    'colour' => $_POST['colour'],
                    'region' => $_POST['region'],
                    'cylinders' => $_POST['cylinders'],
                    'fuel' => $_POST['fuelType'],
                    'title' => $_POST['title'],
                    'transmission' => $_POST['transmission'],
                    'pricemin' => $_POST['priceMin'],
                    'pricemax' => $_POST['priceMax'],
                    'yearmin' => $_POST['yearMin'],
                    'yearmax' => $_POST['yearMax']
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
            $jsonResult = file_get_contents($searchEndp, false, $context);
            $arrayResult = json_decode($jsonResult, true);
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

        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Icons from ionicons.com -->
        <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>

        <title>Search</title>

        <!-- Styling for the 'return to top' button. This only appears on this page so it is not included in the css file -->
        <style>
            #returnToTopButton {
                display: none; 
                position: fixed; 
                bottom: 116px; 
                right: 5px; 
                z-index: 99; 
                border: none; 
                outline: none; 
                background-color: #313c53; 
                color: white; 
                cursor: pointer; 
                padding: 15px; 
                border-radius: 30px; 
                font-size: 18px
            }

            #returnToTopButton:hover {
                background-color: #0dcaf0;
                color: white
            }

        </style>

    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <!-- Search Form -->
        <div class="container-fluid" id=mainbodycontent>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-8 mx-auto">
                        <div class="card card-signin my-5 text-center">
                            <div class="card-body" style="padding-bottom:10px">
                                <form class="form-signin" method='POST' action='search.php'>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" style="border-right-style:inset">
                                            <div class="form-label-group">
                                                <!-- Manufacturer -->
                                                <p style="margin-bottom:0px">Manufacturer</p>
                                                <select class="form-select form-select-sm" id="manufacturer" name="manufacturer" style="border-radius:5px" required>
                                                    <?php
                                                        //Get a list of values to populate the dropdown
                                                        $manuEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getManu.php";
                                                        $manuEndpResult = file_get_contents($manuEndp);
                                                        $manuList = json_decode($manuEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['manufacturer'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=manu&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }
                                                        
                                                        foreach ($manuList as $item) {

                                                            $value = $item["manu_name"];

                                                            echo "<option value='$counter'>$value</option>";

                                                            $counter++;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Condition -->
                                            <div class="form-label-group">
                                                <p style="margin-bottom:0px">Condition</p>
                                                <select class="form-select form-select-sm" id="condition" name="condition" style="border-radius:5px" required>
                                                    <?php

                                                        $conditionEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getCondition.php";
                                                        $conditionEndpResult = file_get_contents($conditionEndp);
                                                        $conditionList = json_decode($conditionEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['condition'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=cond&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }

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
                                                <select class="form-select form-select-sm" id="driveType" name="driveType" style="border-radius:5px" required>
                                                    <?php

                                                        $driveTypeEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getDriveType.php";
                                                        $driveTypeEndpResult = file_get_contents($driveTypeEndp);
                                                        $driveTypeList = json_decode($driveTypeEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['driveType'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=dtype&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }

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
                                                <select class="form-select form-select-sm" id="vehType" name="vehType" style="border-radius:5px" required>
                                                    <?php

                                                        $vehTypesEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getVehTypes.php";
                                                        $vehTypesEndpResult = file_get_contents($vehTypesEndp);
                                                        $vehTypesList = json_decode($vehTypesEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['vehType'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=vtype&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }

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
                                                <select class="form-select form-select-sm" id="colour" name="colour" style="border-radius:5px" required>
                                                    <?php

                                                        $colourEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getColour.php";
                                                        $colourEndpResult = file_get_contents($colourEndp);
                                                        $colourList = json_decode($colourEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['colour'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=colour&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }

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
                                                <select class="form-select form-select-sm" id="region" name="region" style="border-radius:5px" required>
                                                    <?php

                                                        $regionEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getRegion.php";
                                                        $regionEndpResult = file_get_contents($regionEndp);
                                                        $regionList = json_decode($regionEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['region'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=region&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }

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
                                                <select class="form-select form-select-sm" id="cylinders" name="cylinders" style="border-radius:5px">
                                                    <?php

                                                        $cylindersEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getCylinders.php";
                                                        $cylindersEndpResult = file_get_contents($cylindersEndp);
                                                        $cylindersList = json_decode($cylindersEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['cylinders'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=cylinders&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }

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
                                                <select class="form-select form-select-sm" id="fuelType" name="fuelType" style="border-radius:5px">
                                                    <?php

                                                        $fuelTypeEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getFuelTypes.php";
                                                        $fuelTypeEndpResult = file_get_contents($fuelTypeEndp);
                                                        $fuelTypeList = json_decode($fuelTypeEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['fuelType'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=ftype&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }

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
                                                <select class="form-select form-select-sm" id="title" name="title" style="border-radius:5px">
                                                    <?php

                                                        $titleEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getTitle.php";
                                                        $titleEndpResult = file_get_contents($titleEndp);
                                                        $titleList = json_decode($titleEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['title'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=title&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }

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
                                                <select class="form-select form-select-sm" id="transmission" name="transmission" style="border-radius:5px">
                                                    <?php

                                                        $transEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getTrans.php";
                                                        $transEndpResult = file_get_contents($transEndp);
                                                        $transList = json_decode($transEndpResult, true);
                                                        $counter = 0;

                                                        if(isset($_POST['searchbutton'])){
                                                            //Set the value of the dropdown to what was searched for
                                                            $searchPrevID = $_POST['transmission'];

                                                            if($searchPrevID != -1){
                                                                $searchEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getSearchInfo.php?field=trans&id=$searchPrevID";
                                                                $searchEndpJson = file_get_contents($searchEndp);
                                                                $searchEndpArray = json_decode($searchEndpJson, true);

                                                                echo "<option value=$searchPrevID selected>{$searchEndpArray[1]}</option>";
                                                            } else {
                                                                echo "<option value=-1 selected>--Select--</option>";
                                                            }

                                                        } else {
                                                            echo "<option value=-1 selected>--Select--</option>";
                                                        }
                                                        
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
                                                        <?php
                                                            if(isset($_POST['searchbutton'])){
                                                                $pMinPrevValue = $_POST['priceMin'];
                                                                echo "<input type='number' id='priceMin' name='priceMin' value='$pMinPrevValue' class='form-control' min='0' oninput='validity.valid||(value='');'>";
                                                            } else {
                                                                echo "<input type='number' id='priceMin' name='priceMin' class='form-control' min='0' oninput='validity.valid||(value='');'>";
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-label-group">
                                                        Price <i>(Max)</i>
                                                        <?php
                                                            if(isset($_POST['searchbutton'])){
                                                                $pMaxPrevValue = $_POST['priceMax'];
                                                                echo "<input type='number' id='priceMax' name='priceMax' value='$pMaxPrevValue' class='form-control' min='0' oninput='validity.valid||(value='');'>";
                                                            } else {
                                                                echo "<input type='number' id='priceMax' name='priceMax' class='form-control' min='0' oninput='validity.valid||(value='');'>";
                                                            }
                                                        ?>
                                                    </div>
                                                </div> 
                                            </div>
                                            <!-- Price -->
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-label-group">
                                                        Year <i>(After)</i>
                                                        <?php
                                                            if(isset($_POST['searchbutton'])){
                                                                $yMinPrevValue = $_POST['yearMin'];
                                                                echo "<input type='number' id='yearMin' name='yearMin' value='$yMinPrevValue' class='form-control' min='0' oninput='validity.valid||(value='');'>";
                                                            } else {
                                                                echo "<input type='number' id='yearMin' name='yearMin' class='form-control' min='0' oninput='validity.valid||(value='');'>";
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-label-group">
                                                        Year <i>(Before)</i>
                                                        <?php
                                                            if(isset($_POST['searchbutton'])){
                                                                $yMaxPrevValue = $_POST['yearMax'];
                                                                echo "<input type='number' id='yearMax' name='yearMax' value='$yMaxPrevValue' class='form-control' min='0' oninput='validity.valid||(value='');'>";
                                                            } else {
                                                                echo "<input type='number' id='yearMax' name='yearMax' class='form-control' min='0' oninput='validity.valid||(value='');'>";
                                                            }
                                                        ?>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 text-align-right">
                                            <a class="btn btn-lg btn-outline-info btn-block" id="resetbutton">Reset</a>
                                            <button class="btn btn-lg btn-outline-primary btn-block" type="submit" name="searchbutton">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            if (isset($_POST['searchbutton'])) {

                $counter = 0;
                foreach($arrayResult as $item) {
                    $counter++;
                }

                $output = "";

                if(count($arrayResult) == 0) {
                    $output = "<p><strong>Your search did not find any results</strong></p>";
                } else if(count($arrayResult) == 1){
                    $output = "<p>Your search found <strong>1</strong> result</p>";
                } else {
                    $output = "<p>Your search found <strong>$counter</strong> results</p>";
                }

                echo "
                    <div class='container-fluid' id=mainbodycontent style='margin-bottom:16px'>
                        <div class='container text-center'>
                            <div class='row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 justify-content-center'>
                                <div class='col-11 align-self-center'>
                                    $output
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }

        ?>

        <div class="container-fluid" id=mainbodycontent style="margin-bottom:16px">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
                    <?php
                        if (isset($_POST['searchbutton'])) {
                            foreach($arrayResult as $car) {
                                $vehicleID = $car['ID'];
                                $vechiclePrice = $car['price'];
                                $vehicleYear = $car['year'];
                                $vehicleManufacturer = $car['manufacturer'];
                                $vehicleModel = $car['model'];
                                $thumbnail = $car['thumbnail'];

                                echo "
                                    <div class='col'>
                                        <div class='card h-100' >
                                            <img src='$thumbnail' class='card-img-top' alt='Missing Photo' width='200'>
                                            <div class='card-body'>
                                                <h6 class='d-flex align-items-center mb-3'><i class='material-icons text-info mr-2'>$vehicleManufacturer</i>$vehicleModel</h6>
                                                <p><strong>Year: </strong>$vehicleYear</p>
                                                <p><strong>Price: </strong>$$vechiclePrice</p>
                                            </div>
                                            <div class='card-footer text-center'>
                                                <a class='btn btn-primary btn-sm' href='/rrautosales/vehicle/details.php?id=$vehicleID' role='button'>More Info</a>
                                            </div>
                                        </div>
                                    </div>  
                                ";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <button onclick="topFunction()" id="returnToTopButton" title="Go to top">Return to Top</button>

        <!-- Add the Footer to the bottom of the page -->
        <?php
            $footerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/footer.php";
            include($footerpath);
        ?> 

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

        <script>
            var mybutton = document.getElementById("returnToTopButton");

            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }

            //when the user clicks on the reset button, reset all the fields
            $('#resetbutton').click(function(){
                
                if($('#manufacturer option[value=-1]').length==0) {
                    $('#manufacturer').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#condition option[value=-1]').length==0) {
                    $('#condition').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#driveType option[value=-1]').length==0) {
                    $('#driveType').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#vehType option[value=-1]').length==0) {
                    $('#vehType').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#colour option[value=-1]').length==0) {
                    $('#colour').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#region option[value=-1]').length==0) {
                    $('#region').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#cylinders option[value=-1]').length==0) {
                    $('#cylinders').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#fuelType option[value=-1]').length==0) {
                    $('#fuelType').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#title option[value=-1]').length==0) {
                    $('#title').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#transmission option[value=-1]').length==0) {
                    $('#transmission').prepend('<option value=-1 selected>--Select--</option>');
                }

                if($('#priceMin').val() > 0) {
                    $('#priceMin').val(null);
                }

                if($('#priceMax').val() > 0) {
                    $('#priceMax').val(null);
                }

                if($('#yearMin').val() > 0) {
                    $('#yearMin').val(null);
                }

                if($('#yearMax').val() > 0) {
                    $('#yearMax').val(null);
                }
                
            });

        </script>
    </body>
</html>
