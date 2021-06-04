<?php

    session_start();

    if(isset($_SESSION["user_id"])) {

        header("Location: profile.php");

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

        <title>Login</title>
        
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
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center"><i class="material-icons text-info mr-2">sign</i>In</h5>
                                <form class="form-signin" method='POST' action='signin.php'>
                                    <div class="form-label-group">
                                        <h6>Email Address</h1>
                                        <input type="email" name="useremail" class="form-control" required autofocus>
                                    </div>

                                    <div class="form-label-group">
                                        <h6>Password</h1>
                                        <input type="password" name="userpassword" class="form-control" required>
                                    </div>
                                    <div class="form-label-group text-center">
                                        <button class="btn btn-lg btn-outline-info btn-block text-uppercase" type="submit">Sign in</button>
                                        <a class="btn btn-lg btn-outline-primary btn-block text-uppercase" href="register.php" role="button">Register</a>
                                    </div>   
                                    <div class="form-label-group text-center">
                                        <a href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/verifyemail.php"><small>I've forgotten my password</small></a>
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
