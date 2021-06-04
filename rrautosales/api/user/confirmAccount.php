<?php

    //------------------------------------------------------------------------------------
    //--- Checks to see if a given email is already in the database assigned to a user ---
    //------------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $email = $_GET['email'];

    //call the function, passing in the attributes from the url
    $result = confirmAccount($email);

    //return the result
    echo $result;

?>