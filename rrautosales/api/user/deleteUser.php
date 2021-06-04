<?php

    //------------------------------------------------------
    //--- Deletes a given user account from the database ---
    //------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $user_id = $_GET['userid'];

    //call the function, passing in the attributes from the url
    $user = deleteUser($user_id);

    //return the result
    echo $user;

?>