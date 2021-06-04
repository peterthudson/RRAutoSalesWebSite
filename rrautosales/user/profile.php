<?php

    session_start();

    if(!isset($_SESSION['user_id'])){

        header("Location: login.php");
    }

    $userid = $_SESSION['user_id'];
    $apikey = $_SESSION['apikey'];

    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/getUserAllInfo.php";

    $postdata = http_build_query(

        array(
            'userid' => $userid,
            'apikey' => $apikey
        )
    );

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );

    $context  = stream_context_create($options);
    $userResultJson = file_get_contents($endp, false, $context);
    $userResultArray = json_decode($userResultJson, true);

    //Create session variables for storing information to be used in the navbar
    $_SESSION['firstname'] = $userResultArray['firstname'];
    $_SESSION['surname'] = $userResultArray['surname'];
    $_SESSION['photourl'] = $userResultArray['photourl'];

    $firstname = $userResultArray['firstname'];
    $surname = $userResultArray['surname'];
    $email = $userResultArray['email'];
    $password = $userResultArray['password'];
    $title = $userResultArray['title'];
    $dob = $userResultArray['dob'];
    $gender = $userResultArray['gender'];
    $phone = $userResultArray['phone'];
    $mobile = $userResultArray['mobile'];
    $shiplineone = $userResultArray['shiplineone'];
    $shiplinetwo = $userResultArray['shiplinetwo'];
    $shiptown = $userResultArray['shiptown'];
    $shipzip = $userResultArray['shipzip'];
    $shipstate = $userResultArray['shipstate'];
    $shipcountry = $userResultArray['shipcountry'];
    $invlineone = $userResultArray['invlineone'];
    $invlinetwo = $userResultArray['invlinetwo'];
    $invtown = $userResultArray['invtown'];
    $invzip = $userResultArray['invzip'];
    $invstate = $userResultArray['invstate'];
    $invcountry = $userResultArray['invcountry'];
    $photourl = $userResultArray['photourl'];

    if ($photourl == ""){
        $photourl = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/defaultUserPicture.jpg";
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

        <title>Profile</title>
    </head>



    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <div class="container">
            <div class="main-body">

                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/mypayments.php">Payment Options</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/wishlist/mywishlist.php">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/viewhistory/myviewhistory.php">View History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/mylistedvehicles.php">Listed Vehicles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/myOwnedVehicles.php">Purchased</a>
                    </li>
                    <?php
                        if ($_SESSION['admin'] == 1) {
                            echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/useradmin.php'>User Admin</a>
                                </li>
                            ";

                        }
                    ?>
                </ul>

                <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><h3 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">my</i>Profile</h3></li>
                    </ol>
                </nav>

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <?php echo "<img src='$photourl' alt='Admin' class='rounded-circle' width='150'>";?>
                                    <div class="mt-3">
                                        <?php 
                                            echo "<h4>{$userResultArray['firstname']} {$userResultArray['surname']}</h4>";
                                            if ($userResultArray['adminstatus'] == 1) {
                                                echo "<p class='text-secondary mb-1'>Administrator</p>";
                                            }
                                            echo "<p class='text-secondary mb-1'>{$userResultArray['invtown']}, {$userResultArray['invstate']}, {$userResultArray['invcountry']}</p>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">account</i>Info</h6>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">email</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <?php
                                            echo "{$userResultArray['email']}";
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">password</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary"  onclick="revealPassword()" id="myPassword" type="password">
                                        <?php
                                            $passwordLength = strlen($password);
                                            for ($i=0 ; $i < strlen($password) ; $i++) {
                                                echo "*";
                                            }
                                        ?>
                                        <!-- click on the password to reveal it -->
                                        <script>
                                            function revealPassword() {
                                                
                                                var passwordText = "<?php echo $password; ?>";
                                                document.getElementById("myPassword").innerHTML = passwordText;

                                            }
                                        </script>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">API Key</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary"  onclick="revealAPIkey()" id="myAPIkey" type="password">
                                        <?php
                                            $passwordLength = strlen($_SESSION['apikey']);
                                            for ($i=0 ; $i < $passwordLength ; $i++) {
                                                echo "*";
                                            }
                                        ?>
                                        <!-- click on the API Key to reveal it -->
                                        <script>
                                            function revealAPIkey() {
                                                
                                                var keyText = "<?php echo $_SESSION['apikey']; ?>";
                                                document.getElementById("myAPIkey").innerHTML = keyText;

                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">profile</i>Admin</h6>
                                <div class="row align-items-center">
                                    <div class="col align-items-center">
                                        <a href='/rrautosales/user/editprofile.php' class='btn btn-outline-info rounded-pill text-center' role='button'>Edit Profile</a>
                                    </div>
                                    <div class="col align-items-center">
                                        <a href='/rrautosales/user/confirmdelete.php' class='btn btn-outline-danger rounded-pill' role='button'>Delete Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php
                                            echo "
                                                {$userResultArray['title']} {$userResultArray['firstname']} {$userResultArray['surname']}
                                            ";
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <?php
                                            echo "
                                                {$userResultArray['gender']}
                                            ";
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date of birth</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php
                                            echo "
                                                {$userResultArray['dob']}
                                            ";
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php
                                            echo "
                                                {$userResultArray['phone']}
                                            ";
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php
                                            echo "
                                                {$userResultArray['mobile']}
                                            ";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters-sm">
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">shipping</i>Address</h6>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Address Line 1</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['shiplineone']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Address Line 2</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['shiplinetwo']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Town</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['shiptown']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">State</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['shipstate']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">ZIP Code</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['shipzip']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Country</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['shipcountry']}";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">invoice</i>Address</h6>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Address Line 1</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['invlineone']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Address Line 2</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['invlinetwo']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Town</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['invtown']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">State</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['invstate']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">ZIP Code</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['invzip']}";
                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="mb-0">Country</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <?php
                                                    echo "{$userResultArray['invcountry']}";
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
        <?php
            $footerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/footer.php";
            include($footerpath);
        ?>

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    </body>
</html>