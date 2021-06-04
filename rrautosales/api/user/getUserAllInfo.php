<?php

    //----------------------------------------------------------------------
    //--- Returns all attributes from the user table for a given user ID ---
    //----------------------------------------------------------------------

    if(isset($_POST['userid'])){

        //include the functions file
        $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
        include($functionpath);

        //get the attributes from the endpoint url
        $user_id = $_POST['userid'];
        $apikey = base64_decode($_POST['apikey']);

        $apicheck = checkAPIKey($user_id, $apikey);

        if ($apicheck == 1){

            //call the function, passing in the attributes from the url
            $user = getUserAllInfo($user_id);

            //return the result
            echo $user;
        }
    }
?>