<?php

    //-------------------------------------------------------------------------------------------------------------
    //--- Returns the information from the database that is needed to set session variables when a user logs in ---
    //-------------------------------------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $email = $_GET['email'];
    $password = $_GET['password'];

    //call the function, passing in the attributes from the url
    $result = getSessionInfo($email, $password);

    //return the result
    echo $result;

?>