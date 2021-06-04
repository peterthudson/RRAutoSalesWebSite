<?php

    session_start();

    //Set the current page number
    if(isset($_GET['page'])){
        $pageNo = $_GET['page'];
    } else {
        $pageNo = 1;
    }

    $vehicleTypeID = 4;
    
    $nextPage = $pageNo + 1;
    $prevPage = $pageNo - 1;

    $recordsPerPage = 20;

    //Count how many pages of results there will be
    $countEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/countVehiclesByType.php?type=$vehicleTypeID";
    $numberOfRecords = file_get_contents($countEndp);

    $totalNoPages = ceil($numberOfRecords / $recordsPerPage);

    //Get this page's results
    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getAllVehiclesByType.php?type=$vehicleTypeID&page=$pageNo";
    $jsonResult = file_get_contents($endp);
    $vehicles = json_decode($jsonResult, true);

    
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

        <title>Hatchback</title>
    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <!-- Add the page title and then the search results -->
        <div class="container">
            <h2 class='d-flex align-items-center mb-3'><i class='material-icons text-info mr-2'>all</i>Hatchbacks</h2>
            <h6>Browse all the hatchbacks we currently have for sale</h6>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
                <?php
                    foreach($vehicles as $car) {
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

                ?>

            </div>
        </div>
        
        <!-- Add Pagination Buttons -->
        <div class="container" style="margin-top:10px">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="<?php if($pageNo==1){echo "page-item disabled";}else{echo "page-item";}?>">
                        <a class="page-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/allhatchback.php?page=1" tabindex="-1" aria-disabled="true">First</a>
                    </li>
                    <li class="<?php if($pageNo<=1){echo "page-item disabled";}else{echo "page-item";}?>">
                        <a class="page-link" href="<?php if($pageNo<=1){echo "#";}else{echo "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/allhatchback.php?page=$prevPage";}?>">Previous</a>
                    </li>
                    <li class="<?php if($pageNo>=$totalNoPages){echo "page-item disabled";}else{echo "page-item";}?>">
                        <a class="page-link" href="<?php if($pageNo>=$totalNoPages){echo "#";}else{echo "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/allhatchback.php?page=$nextPage";}?>">Next</a>
                    </li>
                    <li class="<?php if($pageNo==$totalNoPages){echo "page-item disabled";}else{echo "page-item";}?>">
                        <a class="page-link" href="<?php echo "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/allhatchback.php?page=$totalNoPages";?>">Last</a>
                    </li>
                </ul>
            </nav>
            
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
