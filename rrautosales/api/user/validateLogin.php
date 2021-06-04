<?php

    //--------------------------------------------------------------------------------------
    //--- Checks that a given email address and password combination are in the database ---
    //--------------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $email = $_GET['email'];
    $password = $_GET['password'];

    //call the function, passing in the attributes from the url
    $result = validateLogin($email, $password);

    //return the result
    echo $result;

?>