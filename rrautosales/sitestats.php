<?php

    session_start();

    //Count how many vehicles are in the database
    $countEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countAllVehicles.php";
    $numberOfRecords = file_get_contents($countEndp);

    //Count how many of each region there is
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countByRegion.php";
    $jsonResult = file_get_contents($endp);
    $regions = json_decode($jsonResult, true);

    //Count how many of each manufacturer there is
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countByManu.php";
    $jsonResult = file_get_contents($endp);
    $manus = json_decode($jsonResult, true);

    //Count how many of each condition there is
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countByCond.php";
    $jsonResult = file_get_contents($endp);
    $conds = json_decode($jsonResult, true);

    //Count how many of each fuel type there is
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countByFuel.php";
    $jsonResult = file_get_contents($endp);
    $fuels = json_decode($jsonResult, true);

    //Count how many of each title status there is
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countByTitle.php";
    $jsonResult = file_get_contents($endp);
    $titles = json_decode($jsonResult, true);

    //Count how many of each transmission there is
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countByTrans.php";
    $jsonResult = file_get_contents($endp);
    $trans = json_decode($jsonResult, true);

    //Count how many of each drive type there is
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countByDrive.php";
    $jsonResult = file_get_contents($endp);
    $drives = json_decode($jsonResult, true);

    //Count how many of each paint colour there is
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countByColour.php";
    $jsonResult = file_get_contents($endp);
    $colours = json_decode($jsonResult, true);
?>

<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link href="css/mystyles.css" rel="stylesheet">

        <!-- favicon -->
        <link rel="icon" href="/rrautosales/img/favicon.png" type="image/png" sizes="16x16">

        <!-- Icons from ionicons.com -->
        <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>

        <title>Site Stats</title>
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
                    <h2 class='d-flex align-items-center mb-3'><i class='material-icons text-info mr-2'>site</i>Stats</h2>
                    <?php echo "<p>Here's a breakdown of the <strong>$numberOfRecords</strong> vehicles listed on the site by category</p>"; ?>
                    <div class="col-sm-9 col-md-9 col-lg-3 col-xl-3 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Conditions</h5>
                                <table class="table">
                                    <tbody>
                                        <?php
                                            foreach($conds as $cond){
                                                echo "<tr>";
                                                echo "<th scope='col'>{$cond['condition']}</th>";
                                                echo "<td>{$cond['count']}</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-3 col-xl-3 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Fuel Types</h5>
                                <table class="table">
                                    <tbody>
                                        <?php
                                            foreach($fuels as $fuel){
                                                echo "<tr>";
                                                echo "<th scope='col'>{$fuel['type']}</th>";
                                                echo "<td>{$fuel['count']}</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-3 col-xl-3 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Transmission Types</h5>
                                <table class="table">
                                    <tbody>
                                        <?php
                                            foreach($trans as $tran){
                                                echo "<tr>";
                                                echo "<th scope='col'>{$tran['transmission']}</th>";
                                                echo "<td>{$tran['count']}</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-3 col-xl-3 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Drive Types</h5>
                                <table class="table">
                                    <tbody>
                                        <?php
                                            foreach($drives as $drive){
                                                echo "<tr>";
                                                echo "<th scope='col'>{$drive['drive']}</th>";
                                                echo "<td>{$drive['count']}</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9 col-md-9 col-lg-3 col-xl-3 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Manufacturers</h5>
                                <table class="table">
                                    <tbody>
                                        <?php
                                            foreach($manus as $manu){
                                                echo "<tr>";
                                                echo "<th scope='col'>{$manu['name']}</th>";
                                                echo "<td>{$manu['count']}</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-3 col-xl-3 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Regions</h5>
                                <table class="table">
                                    <tbody>
                                        <?php
                                            foreach($regions as $region){
                                                echo "<tr>";
                                                echo "<th scope='col'>{$region['region']}</th>";
                                                echo "<td>{$region['count']}</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-3 col-xl-3 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Title Statuses</h5>
                                <table class="table">
                                    <tbody>
                                        <?php
                                            foreach($titles as $title){
                                                echo "<tr>";
                                                echo "<th scope='col'>{$title['title']}</th>";
                                                echo "<td>{$title['count']}</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-9 col-md-9 col-lg-3 col-xl-3 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Paint Colours</h5>
                                <table class="table">
                                    <tbody>
                                        <?php
                                            foreach($colours as $colour){
                                                echo "<tr>";
                                                echo "<th scope='col'>{$colour['colour']}</th>";
                                                echo "<td>{$colour['count']}</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
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
