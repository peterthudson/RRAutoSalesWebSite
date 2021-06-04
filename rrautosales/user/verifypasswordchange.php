<?php

    session_start();

    if(isset($_SESSION["user_id"])) {

        header("Location: profile.php");

    } 

    $NewPassword = $_POST['passwordone'];
    $email = $_POST['email'];

    $passwordChangeEndpoint = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/passwordUpdate.php?email=$email&password=$NewPassword";
    $passwordChangeResult = file_get_contents($passwordChangeEndpoint);

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
            if($passwordChangeResult == 1){
                echo "
                    <div class='container-fluid' id=mainbodycontent>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                                    <div class='card card-signin my-5'>
                                        <div class='card-body'>
                                            <h5 class='card-title text-center'><i class='material-icons text-info mr-2'>password</i>Reset</h5>
                                            <p>Your password has been successfully changed. You can now log in.</p>
                                            <div class='form-label-group text-center'>
                                                <a class='btn btn-outline-info' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/login.php'>Login</a>
                                            </div>
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
                                            <p>There was an error setting the password. Please try again later.</p>
                                            <div class='form-label-group text-center'>
                                                <a class='btn btn-outline-info' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/verifyemail.php'>Back</a>
                                            </div>
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
