<?php

    session_start();

    $userid = $_GET['userID'];

    $endpoint = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/deleteUser.php?userid=$userid";

    $postdata = http_build_query(

        array(
            'userid' => $userid
        )
    );

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );

    $context = stream_context_create($options);
    $deleteResult = file_get_contents($endpoint, false, $context);

    if($userid == $_SESSION['user_id']){ //if the userID of the account being deleted is the same as the userID of the currently logged in user

        if ($deleteResult == "Success"){
            session_unset();
            session_destroy();
            session_write_close();
            $bodyMessage = "Your profile has been deleted";
            $bodyIcon = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/tick.PNG";
            $buttonHref = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/";
            $buttonText = "Homepage";
        } else {
            $bodyIcon = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/error.PNG";
            $bodyMessage = "An error has occurred.
                <p>Error details: $deleteResult</p>
                <p>Please contact your system administrator</p>
            ";
        }

    }else { //if the userID of the account being deleted is NOT the same as the userID of the currently logged in user

        if ($deleteResult == "Success"){
            $bodyMessage = "The user profile has been deleted";
            $bodyIcon = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/tick.PNG";
            $buttonHref = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/useradmin.php";
            $buttonText = "Back";
        } else {
            $bodyIcon = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/error.PNG";
            $bodyMessage = "An error has occurred.
                <p>Error details: $deleteResult</p>
            ";
            $buttonHref = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/useradmin.php";
            $buttonText = "Back";
        }
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

        <title>WARNING</title>
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
                        <div class="card card-signin my-5 text-center">
                            <div class="card-header">
                                <h2 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">delete</i>Profile</h3>
                            </div>
                            <div class='card-text' style='margin-top:10px'>
                                <div class="card-body">
                                    <?php
                                        echo "
                                            <img src='$bodyIcon'>
                                            <p style='margin-top:16px'>$bodyMessage</p>
                                            <p style='margin-top:10px'><a href='$buttonHref' class='btn btn-primary rounded-pill' tabindex='-1' role='button' aria-disabled='true'>$buttonText</a></p>
                                        ";
                                    ?>
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
