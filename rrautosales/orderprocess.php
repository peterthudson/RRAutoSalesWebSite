<?php

    session_start();

    //Import the PHPMailer Plugin to allow the page to send the email recipt
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mailerRequireOne = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/plugins/PHPMailer/src/Exception.php";
    $mailerRequireTwo = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/plugins/PHPMailer/src/PHPMailer.php";
    $mailerRequireThree = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/plugins/PHPMailer/src/SMTP.php";

    require $mailerRequireOne;
    require $mailerRequireTwo;
    require $mailerRequireThree;

    //Get the information about the vehicle ordered
    $vehicleID = $_POST['vehicleid'];
    $vehicleInfoEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getAllVehicleInfo.php?id=$vehicleID";
    $vehicleInfoJson = file_get_contents($vehicleInfoEndp);
    $vehicleInfoArray = json_decode($vehicleInfoJson, true);

    //Get the address information for the user
    $userID = $_SESSION['user_id'];
    $apiKey = $_SESSION['apikey'];

    $endp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/getUserAllInfo.php";

    $postdata = http_build_query(

        array(
            'userid' => $userID,
            'apikey' => $apiKey
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
    $userInfoJson = file_get_contents($endp, false, $context);
    $userInfoArray = json_decode($userInfoJson, true);

    $formDeliveryChoice = $_POST['deliveryoptions'];

    if (isset($_POST['insurancecheckbox'])){
        $formDeliveryInsurance = $_POST['insurancecheckbox'];
    } else {
        $formDeliveryInsurance = 0;
    }

    //Decide which address the user delivered to
    if($_POST['addressoption'] == 1) {
        $addressChoiceName = $userInfoArray['firstname'] . " " . $userInfoArray['surname'];
        $addressChoiceLineOne = $userInfoArray['shiplineone'];
        $addressChoiceLineTwo = $userInfoArray['shiplinetwo'];
        $addressChoiceTown = $userInfoArray['shiptown'];
        $addressChoiceZIP = $userInfoArray['shipzip'];
        $addressChoiceState = $userInfoArray['shipstate'];
        $addressChoiceCountry = $userInfoArray['shipcountry'];
    } else {
        $addressChoiceName = $_POST['addressname'];
        $addressChoiceLineOne = $_POST['addresslineone'];
        $addressChoiceLineTwo = $_POST['addresslinetwo'];
        $addressChoiceTown = $_POST['addresstowncity'];
        $addressChoiceZIP = $_POST['addresszip'];
        $addressChoiceState = $_POST['addressstate'];
        $addressChoiceCountry = $_POST['addresscountry'];
    }

    //Push the user to the confirmation page after 3 seconds
    header( "refresh:3;url=ordercomplete.php" );

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
                            <div class="card-body">
                                <h5 class="card-title text-center">Processing Payment</h5>
                                <img src="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/CardProcessing.PNG">
                                <div class="text-center" style="margin-top:10px">
                                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                        <span class="visually-hidden">Processing...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php

            $companyEmail = "rrvehiclesales@gmail.com";
            $companyName = "RR Auto Sales";

            $userEmail = $userInfoArray['email'];
            $vehicleModel = $vehicleInfoArray['model'];
            $vehicleManufacturer = $vehicleInfoArray['manufacturer'];
            $vehiclePrice = $vehicleInfoArray['price'];
            $totalPrice = $vehiclePrice + $formDeliveryChoice + $formDeliveryInsurance;

            $messageBody = "
                <html>
                    <head>
                        <title>Order Confirmation</title>
                        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl' crossorigin='anonymous'>
                    </head>
                    <body>
                        <p>Thank you for your order, your $vehicleManufacturer $vehicleModel is on its way.<p>
                        <p><strong><u>Address</u></strong></p>
                        <table class='table'>
                            <tr>
                                <td>$addressChoiceName</td>
                            </tr>
                            <tr>
                                <td>$addressChoiceLineOne</td>
                            </tr>
                            <tr>
                                <td>$addressChoiceLineTwo</td>
                            </tr>
                            <tr>
                                <td>$addressChoiceTown</td>
                            </tr>
                            <tr>
                                <td>$addressChoiceZIP</td>
                            </tr>
                            <tr>
                                <td>$addressChoiceState</td>
                            </tr>
                            <tr>
                                <td>$addressChoiceCountry</td>
                            </tr>
                        </table>     
                        <br>
                        <p><strong><u>Order Info</u></strong></p>
                        <table class='table'>
                            <tr>
                                <td><strong>Manufacturer:</strong></td>
                                <td>$vehicleManufacturer</td>
                            </tr>
                            <tr>
                                <td><strong>Model: </strong></td>
                                <td>$vehicleModel</td>
                            </tr>
                            <tr>
                                <td><strong>Price: </strong></td>
                                <td>$$vehiclePrice</td>
                            </tr>
                            <tr>
                                <td><strong>Delivery: </strong></td>
                                <td>$$formDeliveryChoice</td>
                            </tr>
                            <tr>
                                <td><strong>Insurance: </strong></td>
                                <td>$$formDeliveryInsurance</td>
                            </tr>
                            <tr class='table-light'>
                                <td><strong>Total: </strong></td>
                                <td>$$totalPrice</td>
                            </tr>
                        </table>       
                    </body>
                </html>
            ";

            $mail = new PHPMailer(true);

            try {

                //Recipients
                $mail->setFrom('phudson03@qub.ac.uk', 'RR Auto Sales'); //Sender
                $mail->addAddress($userEmail); //Recipient

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Your Order';
                $mail->Body    = $messageBody;
                $mail->AltBody = strip_tags($messageBody);

                $mail->send();

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            //Assign the vehicle owner attribute the value of the user ID
            $buyVehicleEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/buyVehicle.php";

            $postdata = http_build_query(

                array(
                    'userid' => $userID,
                    'vehicleid' => $vehicleID
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
            $buyVehicleResult = file_get_contents($buyVehicleEndp, false, $context);
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
