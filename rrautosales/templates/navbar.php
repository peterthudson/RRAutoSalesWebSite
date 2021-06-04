<!-- Upper Nav Bar -->
<div class="container-fluid d-none d-lg-block" id="uppernavbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="uppernavbar">
        <div class="container-fluid" id="uppernavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" id="uppernavbartext" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/vehiclesbytype.php?type=2&page=1">convertible</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="uppernavbartext" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/vehiclesbytype.php?type=3&page=1">coupe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="uppernavbartext" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/vehiclesbytype.php?type=4&page=1">hatchback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="uppernavbartext" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/vehiclesbytype.php?type=10&page=1">suv</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="uppernavbartext" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/vehiclesbytype.php?type=6&page=1">offroad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="uppernavbartext" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/vehiclesbytype.php?type=11&page=1">truck</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="uppernavbartext" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/vehiclesbytype.php?type=12&page=1">Van</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="uppernavbartext" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/vehiclesbytype.php?type=13&page=1">wagon</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<!-- Lower Nav Bar -->
<div class="container-fluid" id="mainnavbar">
    <nav class="navbar navbar-expand-lg navbar-light" id="mainnavbar">
        <div class="container-fluid">
            <a class="navbar-brand" style="color:#0dcaf0; font-style:italic" href="/rrautosales/" id="mainnavbartext">
                <strong>RR</strong>Auto Sales
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/browse.php?page=1" id="mainnavbartext">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/sitestats.php" id="mainnavbartext">Site Stats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/search.php" id="mainnavbartext">Search</a>
                    </li>
                </ul>
                <?php
                    if(!isset($_SESSION['user_id'])){
                        echo "<div class='btn-group' style='padding-right:50px'>
                            <a href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/login.php' class='btn btn-outline-info d-flex rounded-pill' tabindex='-1' role='button' aria-disabled='true'>Log In</a>
                            </div>
                        "; 
                        } else {

                        $photourl = $_SESSION['photourl'];
                        $dollarIcon = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/dollar.jpg";

                        if ($photourl == ""){
                            $photourl = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/defaultUserPicture.jpg";
                        }

                        echo "
                            <a class='btn btn-warning rounded-pill' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/vehicle/newvehicle.php' role='button' style='margin-right:10px'>
                                <img src='$dollarIcon' alt='Profile' class='rounded-circle' width='42'>
                                <strong>SELL MY CAR</strong>
                            </a>
                        ";

                        echo "
                            <div class='btn-group' style='padding-right:50px'>
                                <div class='d-flex flex-column align-items-center text-center'>
                                    <button class='btn btn-outline-info btn-lg dropdown-toggle rounded-pill' type='button' data-bs-toggle='dropdown' aria-expanded='false'> 
                                        <img src='$photourl' alt='Profile' class='rounded-circle' width='42'>
                                    </button>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/profile.php'>Profile</a></li>
                                        <li><a class='dropdown-item' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/mypayments.php'>Payment Options</a></li>
                                        <li><a class='dropdown-item' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/wishlist/mywishlist.php'>Wishlist</a></li>
                                        <li><a class='dropdown-item' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/viewhistory/myviewhistory.php'>History</a></li>
                                        <li><a class='dropdown-item' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/mylistedvehicles.php'>Listed Vehicles</a></li>
                                        <li><a class='dropdown-item' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/myOwnedVehicles.php'>Previous Purchases</a></li>
                        ";
                        if ($_SESSION['admin'] == 1) {
                            echo "
                                <li><a class='dropdown-item' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/useradmin.php'>User Admin</a></li>
                            ";
                        }

                        echo "
                                        <li><hr class='dropdown-divider'></li>
                                        <li><a class='dropdown-item' href='/rrautosales/user/signout.php'>Log Out</a></li>
                                    </ul>
                                </div>
                                
                            </div>
                        ";
                    }
                ?>
                
            </div>
        </div>
    </nav>
</div>