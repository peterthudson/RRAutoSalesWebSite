<?php

    //-------------------------------------------------------------
    //--- Checks to see if a given user is a site administrator ---
    //-------------------------------------------------------------

    if(isset($_GET['apikey'])){
                
        //include the functions file
        $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
        include($functionpath);

        //get the attributes from the endpoint url
        $userid = $_GET['userid'];
        $apikey = base64_decode($_GET['apikey']);

        //check that the api key is valid
        $checkAPIKey = checkAPIKey($userid, $apikey);

        if ($checkAPIKey == 1) {

            //call the function, passing in the attributes from the url
            $admin = checkSiteAdmin($userid);

            //return the result
            echo $admin;
        
        } else {

            echo "Invalid API Key";

        }

    } else {

        echo "No API Key is set";
    }
?>