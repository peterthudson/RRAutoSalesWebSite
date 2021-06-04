<?php

    session_start();

    if(isset($_SESSION["user_id"])) {

        header("Location: profile.php");

    } 

    if(isset($_POST['resetbutton'])){

        $email = $_POST['email'];
        $dob = $_POST['dob'];

        $validateURL = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/passwordResetVerificationCode.php?email=$email&dob=$dob";
        $verificationToken = file_get_contents($validateURL);

        // echo "<p>$resetResult</p>";
        // echo "<p>$validationKey</p>";
        // echo "<p>$email</p>";
        // echo "<p>$dob</p>";
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

        <title>Password Reset</title>
        
    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>
        <?php
            if(!isset($_POST['resetbutton'])){
                $date = date('Y-m-d');
                $maxDate = date('Y-m-d');
                echo "
                    <div class='container-fluid' id=mainbodycontent>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                                    <div class='card card-signin my-5'>
                                        <div class='card-body'>
                                            <h5 class='card-title text-center'><i class='material-icons text-info mr-2'>password</i>Reset</h5>
                                            <form class='form-signin' method='POST' action='passwordreset.php'>
                                                <p>Enter your email address here and we will reset your password and email it to you</p>
                                                <div class='form-label-group'>
                                                    <h6>Email Address</h6>
                                                    <input type='email' name='email' class='form-control' required autofocus>
                                                </div>
                                                <div class='form-label-group'>
                                                    <h6>Date of Birth</h6>
                                                    <div class='row'>
                                                        <div class='col'>
                                                            <input type='date' name='dob' value='$date' min='1950-01-01' max='$maxDate' required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='form-label-group text-center'>
                                                    <button class='btn btn-outline-info' name='resetbutton' type='submit'>Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            } else {
                echo "
                    <div class='container-fluid' id=mainbodycontent>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                                    <div class='card card-signin my-5'>
                                        <div class='card-body'>
                                            <h5 class='card-title text-center'><i class='material-icons text-info mr-2'>password</i>Reset</h5>
                                            <form class='form-signin' method='POST' action='newpassword.php'>
                                                <p>We've emailed a verification code to you. Please enter it here.</p>
                                                <div class='form-label-group'>
                                                    <h6>Verification Code</h6>
                                                    <input type='text' name='usertoken' class='form-control' required autofocus>
                                                </div>
                                                <input type='hidden' name='systemtoken' value='$verificationToken'></input>
                                                <div class='form-label-group text-center'>
                                                    <button class='btn btn-outline-info' name='verify' type='submit'>Verify</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        ?>

        <!-- Add the Footer to the bottom of the page -->
        <?php
            $footerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/footer.php";
            include($footerpath);
        ?>

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    </body>
</html>
