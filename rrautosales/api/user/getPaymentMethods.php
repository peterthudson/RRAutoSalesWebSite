<?php

    //----------------------------------------------------------------------------
    //--- Returns the payment card information associated with a specific user ---
    //----------------------------------------------------------------------------

    if(isset($_POST['apikey'])){
        
        //include the functions file
        $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
        include($functionpath);

        //get the attributes from the endpoint url
        $user_id = $_POST['userid'];
        $apikey = base64_decode($_POST['apikey']);

        //check that the api key is valid
        $checkAPIKey = checkAPIKey($user_id, $apikey);

        if ($checkAPIKey == 1) {

            //call the function, passing in the attributes from the url
            $paymentMethods = getPaymentMethods($user_id);

            //return the result
            echo $paymentMethods;
        
        } else {

            echo "Invalid API Key";

        }

    } else {

        echo "No API Key is set";
    }
    

?>