<?php

    session_start();

    //Count how many vehicles are in the database
    $countEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countAllVehicles.php";
    $numberOfRecords = file_get_contents($countEndp);

    if (isset($_SESSION['user_id'])){

        //Check to see if there are any vehicles in the user's wishlist (returns 1 if there are and 0 if there aren't)
        $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/wishlist/checkWishlist.php?userid={$_SESSION['user_id']}";
        $noOfWishlistContents = file_get_contents($endp);

        //Check to see if there are any vehicles in the user's view history (returns 1 if there are and 0 if there aren't)
        $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/viewhistory/checkViewHistory.php?userid={$_SESSION['user_id']}";
        $noOfHistoryContents = file_get_contents($endp);

        //Get the list of recommended vehicles based on the user's wishlist
        $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/wishlist/wishlistRecommend.php?userID={$_SESSION['user_id']}";
        $jsonResult = file_get_contents($endp);
        $wishlistRecommends = json_decode($jsonResult, true);

        //Get the list of recommended vehicles based on the user's view history
        $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/viewhistory/historyRecommend.php?userID={$_SESSION['user_id']}";
        $jsonResult = file_get_contents($endp);
        $historyRecommends = json_decode($jsonResult, true);

    }


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

        <title>RR Auto Sales</title>
    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <div class="container">
            <div class='card card-signin my-5'>
                <div class='card-body text-center'>
                    <h5 class='card-title'>Welcome to RR Auto Sales</h5>
                    <p>Your one stop shop for buying and selling new and used vehicles</p>
                    <p>No need to travel, We'll bring your new vehicle to you!!</p>
                    <br>
                    <?php echo "<p>Browse from the <strong>$numberOfRecords</strong> vehicles we have currently listed on the site</p>"; ?>
                </div>
            </div>
   
            <h2 class='d-flex align-items-center mb-3' disabled><i class='material-icons text-info mr-2'>your</i>Recommendations</h2>

            <?php
                if (isset($_SESSION['user_id'])) {
                    if($noOfWishlistContents == 1) {
                        echo "  <p>These vehicles has been recommended based on the vehicles you have in your wish list</p>
                                <div class='row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4'>";
                            
                        foreach($wishlistRecommends as $car) {
                            $vehicleID = $car['ID'];
                            $vechiclePrice = $car['price'];
                            $vehicleYear = $car['year'];
                            $vehicleManufacturer = $car['manufacturer'];
                            $vehicleModel = $car['model'];
                            $vehicleLogo = $car['logo'];
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
                        echo "</div>";
                    } else {
                        echo " 
                            <div class='card card-signin my-5'>
                                <div class='card-body text-center'>
                                    <h5 class='card-title'>You don't have anything in your wish list yet. Add some vehicles to it and we'll make recommendations based on them</h5>
                                </div>
                            </div>
                        ";
                    }
                    if ($noOfHistoryContents == 1) {
                        echo "  <p style='margin-top:16px'>These vehicles has been recommended based on the vehicles you have in your view history</p>
                                <div class='row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4' style='margin-bottom:16px'>";
                            
                        foreach($historyRecommends as $car) {
                            $vehicleID = $car['ID'];
                            $vechiclePrice = $car['price'];
                            $vehicleYear = $car['year'];
                            $vehicleManufacturer = $car['manufacturer'];
                            $vehicleModel = $car['model'];
                            $vehicleLogo = $car['logo'];
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
                        echo "</div>";
                    } else {
                        echo " 
                            <div class='card card-signin my-5'>
                                <div class='card-body text-center'>
                                    <h5 class='card-title'>You haven't looked at any vehicles yet. Have a look at some and when you come back, we'll have some recommendations for you</h5>
                                </div>
                            </div>
                        ";
                    }
                } else {
                    echo " 
                        <div class='card card-signin my-5'>
                            <div class='card-body text-center'>
                                <h5 class='card-title'>Login or Register and we'll display some recommendations based on the vehicles you have looked at and the vehicles in your wishlist</h5>
                            </div>
                        </div>
                    ";
                }
            ?>
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
