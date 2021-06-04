<?php
    //Gather information from the form and store each item in variables
    
    $title = $_POST['title'];
    $forename = $_POST['forename'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $shiplineone = $_POST['shiplineone'];
    $shiplinetwo = $_POST['shiplinetwo'];
    $shiptown = $_POST['shiptown'];
    $shipzip = $_POST['shipzip'];
    $shipstate = $_POST['shipstate'];
    $shipcountry = $_POST['shipcountry'];
    $invlineone = $_POST['invlineone'];
    $invlinetwo = $_POST['invlinetwo'];
    $invtown = $_POST['invtown'];
    $invzip = $_POST['invzip'];
    $invstate = $_POST['invstate'];
    $invcountry = $_POST['invcountry'];
    $admin = 0;
    $photourl = $_POST['photourl'];
    
    $url = 'http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/createNewUser.php';
    
    $postdata = http_build_query(

        array(
            'title' => $title,
            'forename' => $forename,
            'surname' => $surname,
            'email' => $email,
            'password' => $password,
            'dob' => $dob,
            'gender' => $gender,
            'phone' => $phone,
            'mobile' => $mobile,
            'shiplineone' => $shiplineone,
            'shiplinetwo' => $shiplinetwo,
            'shiptown' => $shiptown,
            'shipzip' => $shipzip,
            'shipstate' => $shipstate,
            'shipcountry' => $shipcountry,
            'invlineone' => $invlineone,
            'invlinetwo' => $invlinetwo,
            'invtown' => $invtown,
            'invzip' => $invzip,
            'invstate' => $invstate,
            'invcountry' => $invcountry,
            'admin' => $admin,
            'photourl' => $photourl
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
    $result = file_get_contents($url, false, $context);

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

        <title>Processing</title>
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
                            <div class="card-body text-alight-center justify-content-center">
                                <?php echo "<h5 class='card-title text-center'>New Profile Created</h5>
                                    <img src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/tick.PNG'>
                                    <p style='margin-top:10px'>You can now sign in $result</p>";
                                ?>
                                <a href="login.php" class="btn btn-outline-primary rounded-pill" tabindex="-1" role="button" aria-disabled="true">Sign In</a>                        
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
