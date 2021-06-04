<?php

    session_start();

    if(!isset($_SESSION['user_id'])){

        header("Location: http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/login.php");

    } else {

        $vehicleID = $_GET['vehicleID'];
        $userID = $_SESSION['user_id'];

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

        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <title>Order</title>
    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>
        <form method="POST" action="orderprocess.php">
            <div class="container-fluid" id=mainbodycontent>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-11 col-md-11 col-lg-6 col-xl-6 col-xxl-4 mx-auto">
                            <div class="card card-signin my-5">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Vehicle Summary</h5>
                                    <?php
                                        $vehicleEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/vehicle/getAllVehicleInfo.php?id=$vehicleID";
                                        $vehicleJsonResult = file_get_contents($vehicleEndp);
                                        $vehicleArrayResult = json_decode($vehicleJsonResult, true);

                                        echo "
                                            <img src='{$vehicleArrayResult['photoOne']}' width='350'>
                                            <table class='table'>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Manufacturer</strong></td>
                                                        <td>{$vehicleArrayResult['manufacturer']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Model</strong></td>
                                                        <td>{$vehicleArrayResult['model']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Price</strong></td>
                                                        <td id='vehicleprice'>\${$vehicleArrayResult['price']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Year</strong></td>
                                                        <td>{$vehicleArrayResult['year']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Odometer</strong></td>
                                                        <td>{$vehicleArrayResult['odometer']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Location</strong></td>
                                                        <td>{$vehicleArrayResult['region']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Condition</strong></td>
                                                        <td>{$vehicleArrayResult['condition']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Fuel Type</strong></td>
                                                        <td>{$vehicleArrayResult['fuel']}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        ";
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-11 col-md-11 col-lg-6 col-xl-6 col-xxl-4 mx-auto">
                            <div class="card card-signin my-5">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Delivery Address</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="addressradio" id="addressradioone" checked>
                                        <label class="form-check-label" for="addressradioone">
                                            My Address
                                        </label>
                                    </div>
                                    <?php
                                        $userEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/getUserAllInfo.php?userid=$userID";
                                        $postdata = http_build_query(

                                            array(
                                                'userid' => $userID,
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
                                        $userJsonResult = file_get_contents($userEndp, false, $context);
                                        $userArrayResult = json_decode($userJsonResult, true);

                                        echo "
                                            <table class='table'>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Name</strong></td>
                                                        <td>{$userArrayResult['firstname']} {$userArrayResult['surname']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Line One</strong></td>
                                                        <td>{$userArrayResult['shiplineone']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Line Two</strong></td>
                                                        <td>{$userArrayResult['shiplinetwo']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Town/City</strong></td>
                                                        <td>{$userArrayResult['shiptown']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>State</strong></td>
                                                        <td>{$userArrayResult['shipstate']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>ZIP Code</strong></td>
                                                        <td>{$userArrayResult['shipzip']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Country</strong></td>
                                                        <td>{$userArrayResult['shipcountry']}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        ";
                                    ?>
                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="addressradio" id="addressradiotwo">
                                        <label class="form-check-label" for="addressradiotwo">
                                            Other Address
                                        </label>
                                    </div>
                                    <script>
                                        $(document).ready(function(){

                                            var deliveryAmount = 500;
                                            var insuranceAmount = 0;
                                            var vehiclePrice = <?php echo $vehicleArrayResult['price'];?>;

                                            updateTotal();

                                            function updateTotal(){
                                                $('#totalsummary').html("$" + (parseInt(deliveryAmount) + parseInt(insuranceAmount) + parseInt(vehiclePrice)));
                                            }

                                            $('#addressradioone').click(function(){
                                                
                                                console.log("Using default address");
                                                $("#addressoption").val("1");
                                                $("#addressnameinput").prop("disabled", true);
                                                $("#addresslineoneinput").prop("disabled", true);
                                                $("#addresslinetwoinput").prop("disabled", true);
                                                $("#addresstowncityinput").prop("disabled", true);
                                                $("#addressstateinput").prop("disabled", true);
                                                $("#addresszipinput").prop("disabled", true);
                                                $("#addresscountryinput").prop("disabled", true);

                                            });

                                            $('#addressradiotwo').click(function(){
                                                
                                                console.log("Using new address");
                                                $("#addressoption").val("2");
                                                $("#addressnameinput").prop("disabled", false);
                                                $("#addresslineoneinput").prop("disabled", false);
                                                $("#addresslinetwoinput").prop("disabled", false);
                                                $("#addresstowncityinput").prop("disabled", false);
                                                $("#addressstateinput").prop("disabled", false);
                                                $("#addresszipinput").prop("disabled", false);
                                                $("#addresscountryinput").prop("disabled", false);

                                            });

                                            $('#insurancecheckbox').change(function(){
                                                {
                                                    if($(this).prop('checked')){
                                                        $('#insurancesummary').html("$3000");
                                                        insuranceAmount = 3000;
                                                        
                                                    } else {
                                                        $('#insurancesummary').html("$0");
                                                        insuranceAmount = 0;
                                                    }
                                                    updateTotal();
                                                }
                                            });


                                            $('input[name="deliveryoptions"]').click(function(){
                                                let option = $('input[name="deliveryoptions"]:checked').val();
                                                $('#deliverysummary').html("$" + option);
                                                deliveryAmount = option;
                                                updateTotal();
                                            });

                                        });
                                    </script>
                                    <div class='row' style='margin-left:0px; margin-right:25px'>
                                        <input class='form-control' id='addressnameinput' name='addressname' type='text' placeholder='Name' style='margin:5px' disabled></input>
                                        <input class='form-control' id='addresslineoneinput' name='addresslineone' type='text' placeholder='Line One' style='margin:5px' disabled></input>
                                        <input class='form-control' id='addresslinetwoinput' name='addresslinetwo' type='text' placeholder='Line Two' style='margin:5px' disabled></input>
                                        <input class='form-control' id='addresstowncityinput' name='addresstowncity' type='text' placeholder='Town/City' style='margin:5px' disabled></input>
                                        <input class='form-control' id='addressstateinput' name='addressstate' type='text' placeholder='State' style='margin:5px' disabled></input>
                                        <input class='form-control' id='addresszipinput' name='addresszip' type='text' placeholder='ZIP Code' style='margin:5px' disabled></input>
                                        <input class='form-control' id='addresscountryinput' name='addresscountry' type='text' placeholder='Country' style='margin:5px' disabled></input>
                                        <input type='hidden' id='addressoption' name='addressoption' value='1'></input>
                                        <?php echo "<input type='hidden' name='vehicleid' value='$vehicleID'></input>"; ?>
                                        <?php echo "<input type='hidden' name='userid' value='$userID'></input>"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-11 col-md-11 col-lg-6 col-xl-6 col-xxl-4 mx-auto">
                            <div class="card card-signin my-5">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Delivery Methods</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="deliveryoptions" id="deliveryoptionone" value="500" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Standard Delivery (<i>+$500</i>)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="deliveryoptions" id="deliveryoptiontwo" value="800">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                        One Week Delivery (<i>+$800</i>)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="deliveryoptions" id="deliveryoptiontwo" value="1500">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                        Next Day Delivery (<i>+$1500</i>)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="3000" id="insurancecheckbox" name="insurancecheckbox">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Transport Insurance (<i>+$3000</i>)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-signin my-5">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Payment Card</h5>
                                    <?php
                                        $paymentsEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/getPaymentMethods.php";
                                        
                                        $postdata = http_build_query(

                                            array(
                                                'userid' => $userID,
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
                                        
                                        $counter = 0;

                                        foreach($paymentsArrayResult as $card){

                                            $checkboxID = "checkbox" . $counter;

                                            if ($counter == 0) {
                                                $input = "<input class='form-check-input' type='radio' name='cardchooser' id='$checkboxID' checked>";
                                            } else {
                                                $input = "<input class='form-check-input' type='radio' name='cardchooser' id='$checkboxID'>";
                                            }
                                            switch($card['cardtype']) {
                                                case "Visa" : {
                                                    $icon = "<img width='50' src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/iconVisa.png'>";
                                                    break;
                                                }
                                                case "Mastercard" : {
                                                    $icon = "<img width='50' src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/iconMastercard.png'>";
                                                    break;
                                                }
                                                case "Discover" : {
                                                    $icon = "<img width='50' src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/iconDisco.png'>";
                                                    break;
                                                }
                                                case "American Express" : {
                                                    $icon = "<img width='50' src='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/img/iconAmex.png'>";
                                                    break;
                                                }
                                            }

                                            $cardDisplayNumber = "************" . substr($card['cardno'], -4);

                                            echo "
                                                <div class='form-check'>
                                                    $input
                                                    <label class='form-check-label' for='flexRadioDefault1'>
                                                        $icon
                                                        $cardDisplayNumber
                                                    </label>
                                                </div>
                                            ";

                                            $counter++;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="card card-signin my-5">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Order Summary</h5>
                                    <table class="table">
                                        <tbody>
                                            <?php
                                                echo "
                                                    <tr>
                                                        <td><strong>Vehicle</strong></td>
                                                        <td>\${$vehicleArrayResult['price']}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Delivery</strong></td>
                                                        <td id='deliverysummary'>\$500</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Insurance</strong></td>
                                                        <td id='insurancesummary'>\$0</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Total</strong></td>
                                                        <td id='totalsummary'></td>
                                                    </tr>
                                                ";
                                            ?>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Add the Footer to the bottom of the page -->
        <?php
            $footerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/footer.php";
            include($footerpath);
        ?>

        

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    </body>
</html>
