<?php

    //--------------------------------------------------------------------------------------
    //--- Adds a new payment card to the database and associates it with a specific user ---
    //--------------------------------------------------------------------------------------
    
    if(isset($_POST['apikey'])){
            
        //include the functions file
        $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
        include($functionpath);

        $userid = $_POST['userid'];
        $cardType = $_POST['cardtype'];
        $cardNumber = $_POST['cardnumber'];
        $expMonth = $_POST['expmonth'];
        $expYear = $_POST['expyear'];
        $apikey = base64_decode($_POST['apikey']);

        //check that the api key is valid
        $checkAPIKey = checkAPIKey($userid, $apikey);

        if ($checkAPIKey == 1) {

            //call the function, passing in the attributes from the url
            $result = addPaymentCard($userid, $cardNumber, $cardType, $expMonth, $expYear);

            //return the result
            echo $result;
        
        } else {

            echo "Invalid API Key";

        }

    } else {

        echo "No API Key is set";
    }

?>