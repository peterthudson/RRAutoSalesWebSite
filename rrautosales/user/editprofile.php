<?php

    session_start();

    if(!isset($_SESSION['user_id'])){

        header("Location: login.php");
    }

    if (isset($_GET['userID'])){
        $userid = $_GET['userID'];
        $userApiKey = $_GET['userAPIkey'];
    } else {
        $userid = $_SESSION['user_id'];
        $userApiKey = $_SESSION['apikey'];
    }

    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/getUserAllInfo.php";

    $postdata = http_build_query(

        array(
            'userid' => $userid,
            'apikey' => $userApiKey
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
    $resultJson = file_get_contents($endp, false, $context);
    $resultArray = json_decode($resultJson, true);

    $firstname = $resultArray['firstname'];
    $surname = $resultArray['surname'];
    $email = $resultArray['email'];
    $password = $resultArray['password'];
    $title = $resultArray['title'];
    $dob = $resultArray['dob'];
    $gender = $resultArray['gender'];
    $phone = $resultArray['phone'];
    $mobile = $resultArray['mobile'];
    $shiplineone = $resultArray['shiplineone'];
    $shiplinetwo = $resultArray['shiplinetwo'];
    $shiptown = $resultArray['shiptown'];
    $shipzip = $resultArray['shipzip'];
    $shipstate = $resultArray['shipstate'];
    $shipcountry = $resultArray['shipcountry'];
    $invlineone = $resultArray['invlineone'];
    $invlinetwo = $resultArray['invlinetwo'];
    $invtown = $resultArray['invtown'];
    $invzip = $resultArray['invzip'];
    $invstate = $resultArray['invstate'];
    $invcountry = $resultArray['invcountry'];
    $photourl = $resultArray['photourl'];

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
        
        <title>Register</title>
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
                                <h5 class="card-title text-center"><i class="material-icons text-info mr-2">edit</i>Profile</h5>
                                <p>Enter the information for what you want to change and the press update</p>
                                <form class="form-signin" method='POST' action='processprofileedit.php'>
                                    <div class="row justify-content-center">  
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">personal</i>Info</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Title</h6>
                                                <select class="form-select form-select-sm" name="title" style="border-radius:5px">
                                                    <?php echo "<option selected value='$title'>$title</option>";?>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Miss">Miss</option>
                                                    <option value="Mx">Mx</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>First Name</h6>
                                                <?php echo "<input name='forename' class='form-control' value='$firstname'>";?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Surname</h6>
                                                <?php echo "<input name='surname' class='form-control' value='$surname'>";?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Date of Birth</h6>
                                                <div class="row">
                                                    <div class="col">
                                                        <?php 
                                                            $maxDate = date('Y-m-d');
                                                            echo "<input type='date' name='dob' value='$dob' min='1900-01-01' max='$maxDate'>"; 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Gender</h6>
                                                <?php echo "<input name='gender' class='form-control' value='$gender'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Phone<i style="font-size:x-small"> (required)</i></h6>
                                                <?php echo "<input name='phone' class='form-control' value='$phone' required>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Mobile</h6>
                                                <?php echo "<input name='mobile' class='form-control' value='$mobile'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Profile Photo URL</h6>
                                                <?php echo "<input name='photourl' class='form-control' value='$photourl'>"; ?>
                                            </div>

                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">login</i>Info</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Email Address<i style="font-size:x-small"> (required)</i></h6>
                                                <?php echo "<input type='email' name='email' class='form-control' required value='$email'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Password<i style="font-size:x-small"> (required)</i></h1>
                                                <?php echo "<input type='text' name='password' class='form-control' value='$password' required>"; ?>
                                            </div>
                                        </div> 
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">invoice</i>Address</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Address Line One</h1>
                                                <?php echo "<input name='invlineone' class='form-control' value='$invlineone'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Address Line Two</h1>
                                                <?php echo "<input name='invlinetwo' class='form-control' value='$invlinetwo'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Town/City</h1>
                                                <?php echo "<input name='invtown' class='form-control' value='$invtown'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>State</h1>
                                                <?php echo "<input name='invstate' class='form-control' value='$invstate'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>ZIP Code</h1>
                                                <?php echo "<input name='invzip' class='form-control' value='$invzip'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Country</h1>
                                                <?php echo "<input name='invcountry' class='form-control' value='$invcountry'>"; ?>
                                            </div>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">delivery</i>Address</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Address Line One</h1>
                                                <?php echo "<input name='shiplineone' class='form-control' value='$shiplineone'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Address Line Two</h1>
                                                <?php echo "<input name='shiplinetwo' class='form-control' value='$shiplinetwo'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Town/City</h1>
                                                <?php echo "<input name='shiptown' class='form-control' value='$shiptown'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>State</h1>
                                                <?php echo "<input name='shipstate' class='form-control' value='$shipstate'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>ZIP Code</h1>
                                                <?php echo "<input name='shipzip' class='form-control' value='$shipzip'>"; ?>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Country</h1>
                                                <?php echo "<input name='shipcountry' class='form-control' value='$shipcountry'>"; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-label-group">
                                            <button class="btn btn-lg btn-outline-info btn-block text-uppercase" type="submit">Update</button>
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
