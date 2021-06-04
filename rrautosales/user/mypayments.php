<?php

    session_start();

    if(!isset($_SESSION['user_id'])){

        header("Location: login.php");
    }

    $userid = $_SESSION['user_id'];

    if (isset($_POST['newcardbutton'])) {

        $newCardNumber = $_POST['cardNumber'];
        $newCardType = $_POST['cardtype'];
        $newCardExpMonth = $_POST['expmonth'];
        $newCardExpYear = $_POST['expyear'];
        $apikey = $_SESSION['apikey'];

        $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/addPaymentCard.php";
    
        $postdata = http_build_query(

            array(
                'userid' => $userid,
                'cardtype' => $newCardType,
                'cardnumber' => $newCardNumber,
                'expmonth' => $newCardExpMonth,
                'expyear' => $newCardExpYear,
                'apikey' => $apikey
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
        $insertResult = file_get_contents($endp, false, $context);

    }

    if (isset($_POST['deletecardbutton'])) {


    }

    $paymentsEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/getPaymentMethods.php";
                                    
    $postdata = http_build_query(

        array(
            'userid' => $userid,
            'apikey' => $_SESSION['apikey']
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
    $paymentsJsonResult = file_get_contents($paymentsEndp, false, $context);
    $paymentsArrayResult = json_decode($paymentsJsonResult, true);


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
                        <a class="nav-link" aria-current="page" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/mypayments.php">Payment Options</a>
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
                        <li class="breadcrumb-item"><h3 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">payment</i>Options</h3></li>
                    </ol>
                </nav>

                <div class="container-fluid" id=mainbodycontent>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-11 col-md-11 col-lg-8 col-xl-8 mx-auto">
                                <div class="card card-signin my-5">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Your Cards</h5>
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Card Number</th>
                                                    <th scope="col">Expiry Month</th>
                                                    <th scope="col">Expiry Year</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($paymentsArrayResult as $card) {
                                                        echo "<tr>";

                                                        switch($card['cardtype']) {
                                                            case "Visa" : {
                                                                echo "<td><img width='50' src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/iconVisa.png'></td>";
                                                                break;
                                                            }
                                                            case "Mastercard" : {
                                                                echo "<td><img width='50' src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/iconMastercard.png'></td>";
                                                                break;
                                                            }
                                                            case "Discover" : {
                                                                echo "<td><img width='50' src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/iconDisco.png'></td>";
                                                                break;
                                                            }
                                                            case "American Express" : {
                                                                echo "<td><img width='50' src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/iconAmex.png'></td>";
                                                                break;
                                                            }
                                                        }
                                                        echo "<td>{$card['cardno']}</td>";
                                                        echo "<td>{$card['expmonth']}</td>";
                                                        echo "<td>{$card['expyear']}</td>";
                                                        echo "<td><a href='/rrautosales/user/deletepaymentcard.php?id={$card['paymentid']}' class='btn btn-danger btn-sm' tabindex='-1' role='button' aria-disabled='true'>Delete</a></td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-11 col-md-11 col-lg-4 col-xl-4 mx-auto">
                                <div class="card card-signin my-5">
                                    <div class="card-body text-center" style="padding-bottom:5px">
                                        <h5 class="card-title">Add A New Card</h5>
                                        <form method='POST' action='mypayments.php'>
                                            <div class="form-label-group">
                                                <h6>Card Number<i style="font-size:x-small"></i></h6>
                                                <input name="cardNumber" type="number" class="form-control" onkeydown="limit(this);" onkeyup="limit(this);" required>
                                                <script>
                                                    function limit(textBox) {
                                                        if(textBox.value.length > 16) {
                                                            textBox.value = textBox.value.substr(0, 16);
                                                        }
                                                    }
                                                </script>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Card Type</h6>
                                                <div class="row">
                                                    <div class="col">
                                                        <select class="form-select form-select-sm" name="cardtype" style="border-radius:5px" required>
                                                            <option selected>--Select--</option>
                                                            <option value="American Express">American Express</option>
                                                            <option value="Discover">Discover</option>
                                                            <option value="Mastercard">Mastercard</option>
                                                            <option value="Visa">Visa</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Expiry</h6>
                                                <div class="row">
                                                    <div class="col">
                                                        <select class="form-select form-select-sm" name="expmonth" style="border-radius:5px" required>
                                                            <option selected>--Month--</option>
                                                            <?php
                                                                for($i = 1 ; $i <= 12 ; $i++) {
                                                                    if ($i < 10) {
                                                                        $monthLabel = sprintf("%02d", $i);
                                                                        $monthValue = sprintf("%02d", $i);
                                                                    } else {
                                                                        $monthLabel = $i;
                                                                        $monthValue = $i;
                                                                    }
                                                                    
                                                                    echo "<option value='$monthValue'>$monthLabel</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-select form-select-sm" name="expyear" style="border-radius:5px" required>
                                                            <option selected>--Year--</option>
                                                            <?php
                                                                $thisYear = date("Y");
                                                                $yearLimit = $thisYear + 5;
                                                                for($i = $thisYear ; $i <= $yearLimit ; $i++) {
                                                                    echo "<option value='$i'>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col" style="margin-top:30px">
                                                        <button class="btn btn-primary btn-sm" name="newcardbutton" type="submit">Add New Card</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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