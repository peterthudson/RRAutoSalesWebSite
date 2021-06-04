<?php

    //-----------------------------------------------------
    //--- Updates the password for a given user account ---
    //-----------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $email = $_GET['email'];
    $newPassword = $_GET['password'];

    //call the function, passing in the attributes from the url
    $result = passwordUpdate($email, $newPassword);

    //return the result
    echo $result;

?>