<?php

    session_start();

    //Retrieve the information about the vehicle
    $vehicleID = $_GET['id'];
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getAllVehicleInfo.php?id=$vehicleID";

    $jsonResult = file_get_contents($endp);
    $details = json_decode($jsonResult, true);

    $region = $details['region'];
    $price = $details['price'];
    $year = $details['year'];
    $manufacturer = $details['manufacturer'];
    $model = $details['model'];
    $details['model'];
    $condition =  $details['condition'];
    $cylinders = $details['cylinders'];
    $fuel = $details['fuel'];
    $odometer = $details['odometer'];
    $title = $details['title'];
    $transmission = $details['transmission'];
    $vin = $details['vin'];
    $drive = $details['drive'];
    $vehicletype = $details['vehicletype'];
    $colour = $details['colour'];
    $photoOne = $details['photoOne'];
    $photoTwo = $details['photoTwo'];
    $photoThree = $details['photoThree'];
    $photoFour = $details['photoFour'];
    $photoFive = $details['photoFive'];
    $lat = $details['lat'];
    $long = $details['long'];
    $logo = $details['logo'];
    $ownerUserID = $details['userID']; //The ID of the user who put the vehicle on the website
    

    //Add the vehicle to the user's recently viewed list if there is a logged in user and if it is not already in that user's history
    if(ISSET($_SESSION['user_id'])) {

        $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/viewhistory/addToViewHistory.php";

        $currentUserID = $_SESSION['user_id'];
        $currentUserAPIKey = $_SESSION['apikey'];

        $postdata = http_build_query(

            array(
                'userID' => $currentUserID,
                'vehicleID' => $vehicleID
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
        $result = file_get_contents($endp, false, $context);

        
        //Check to see if the currently logged in user is a site admin
        $adminEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/checkSiteAdmin.php?userid=$currentUserID&apikey=$currentUserAPIKey";
        $adminJsonResult = file_get_contents($adminEndp);
        $adminArrayResult = json_decode($adminJsonResult, true);

        $siteAdmin = $adminArrayResult['admin'];

    }

    //Check to see if this vehicle is currently in the user's wishlist

    if(ISSET($_SESSION['user_id'])) {

        $currentUserID = $_SESSION['user_id'];

        $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/wishlist/checkUserWishlist.php?userid=$currentUserID&vehicleid=$vehicleID";

        $inWishlist = file_get_contents($endp);
        
    }

    //Choose the size of the map based on the width of the viewport


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

        <title>Vehicle Details</title>

        <style>
            
            .Flexible-container {
                position: relative;
                padding-bottom: 56.25%;
                padding-top: 30px;
                height: 0;
                overflow: hidden;
            }

            .Flexible-container iframe,   
            .Flexible-container object,  
            .Flexible-container embed {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

        </style>

    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <div class="container-fluid" id=mainbodycontent>

        <div class="container">
            <div class="main-body">
                <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><h3 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">vehicle</i>Details</h3></li>
                    </ol>
                </nav>
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">make</i>Model</h6>
                                    <div class="mt-3">
                                        <?php
                                            echo "
                                                <img src='$logo' class='card-img-top' alt='Missing Photo' width='100'>
                                                <h4>$model</h4>
                                            ";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">year</i>Price</h6>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">year</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <?php echo $year;?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">price</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <?php echo "$$price";?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-primary" href="<?php echo "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/ordersummary.php?vehicleID=$vehicleID"; ?>" role="button">Buy</a>
                                        <?php
                                            if(isset($_SESSION['user_id'])) {
                                                //display the appropriate wishlist button 
                                                if ($inWishlist == '0') {
                                                    echo "<a class='btn btn-primary' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/wishlist/processwishlist.php?userID=$currentUserID&vehicleID=$vehicleID&function=add' role='button'>Add To Wishlist</a>";
                                                } else {
                                                    echo "<a class='btn btn-primary' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/wishlist/processwishlist.php?userID=$currentUserID&vehicleID=$vehicleID&function=remove' role='button'>Remove From Wishlist</a>";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                    if(isset($_SESSION['user_id'])) {
                                        if(($ownerUserID == $_SESSION['user_id']) || ($siteAdmin == 1)) {
                                            echo "
                                                <hr>
                                                <div class='row'>
                                                    <div class='d-grid gap-2'>
                                                        <a class='btn btn-primary' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/editvehicle.php?vehicleid=$vehicleID' role='button'>Edit info</a>
                                                        <a class='btn btn-danger' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/confirmvehicledelete.php?vehicleid=$vehicleID' role='button'>Remove Vechicle</a>    
                                                    </div>
                                                </div>
                                            ";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">vehicle</i>Location</h6>
                                <div class="row align-items-center">
                                    <?php
                                        echo "<div class='Flexible-container'>
                                        <iframe width='380' height='380' frameborder='0' scrolling='yes' marginheight='0' marginwidth='0' src='http://maps.google.com/maps?q=$lat,$long&layer=tc&t=m&z=18&source=embed&output=svembed'></iframe>
                                              </div>
                                            <p>Region: $region</p>
                                        ";

                                        //ORiginal 380px
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">image</i>Gallery</h6>
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                    </div>

                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <?php echo "<img src='$photoOne' class='d-block w-100' alt='...'>";?>
                                        </div>
                                        <div class="carousel-item">
                                            <?php echo "<img src='$photoTwo' class='d-block w-100' alt='...'>";?>
                                        </div>
                                        <div class="carousel-item">
                                            <?php echo "<img src='$photoThree' class='d-block w-100' alt='...'>";?>
                                        </div>
                                        <div class="carousel-item">
                                            <?php echo "<img src='$photoFour' class='d-block w-100' alt='...'>";?>
                                        </div>
                                        <div class="carousel-item">
                                            <?php echo "<img src='$photoFive' class='d-block w-100' alt='...'>";?>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters-sm">
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">vehicle</i>Details</h6>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Title Status</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "<img src='/rrautosales/img/notepad.JPG' alt='Missing Photo' width='20%'>";
                                                    echo "$title";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Odometer</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "<img src='/rrautosales/img/odometer.JPG' alt='Missing Photo' width='20%'>";
                                                    echo "$odometer";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">VIN</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "<img src='/rrautosales/img/notepad.JPG' alt='Missing Photo' width='20%'>";
                                                    echo "$vin";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Transmission</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "<img src='/rrautosales/img/transmission.JPG' alt='Missing Photo' width='20%'>";
                                                    echo "$drive";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">more</i>Details</h6>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Colour</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "<img src='/rrautosales/img/paint.JPG' alt='Missing Photo' width='20%'>";
                                                    echo "$colour";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Condition</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "<img src='/rrautosales/img/condition.JPG' alt='Missing Photo' width='20%'>";
                                                    echo "$condition";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Fuel Type</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    if($fuel == "electric") {
                                                        echo "<img src='/rrautosales/img/electric.JPG' alt='Missing Photo' width='20%'>";
                                                        echo "Electric";
                                                    } else if($fuel == "hybrid") {
                                                        echo "<img src='/rrautosales/img/hybrid.JPG' alt='Missing Photo' width='20%'>";
                                                        echo "Hybrid";
                                                    } else if($fuel == "other") {
                                                        echo "<img src='/rrautosales/img/otherfuel.JPG' alt='Missing Photo' width='20%'>";
                                                        echo "Other";
                                                    } else {
                                                        echo "<img src='/rrautosales/img/icefuel.JPG' alt='Missing Photo' width='20%'>";
                                                        echo "$fuel";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Drive Type</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    if($drive == "4wd") {
                                                        echo "<img src='/rrautosales/img/4wd.JPG' alt='Missing Photo' width='20%'>";
                                                        echo "Four Wheel Drive";
                                                    } else if($drive == "fwd") {
                                                        echo "<img src='/rrautosales/img/fwd.JPG' alt='Missing Photo' width='20%'>";
                                                        echo "Front Wheel Drive";
                                                    } else {
                                                        echo "<img src='/rrautosales/img/rwd.JPG' alt='Missing Photo' width='20%'>";
                                                        echo "Rear Wheel Drive";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
