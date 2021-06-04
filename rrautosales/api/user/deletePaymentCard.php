<?php

    //-------------------------------------------------------
    //--- Deletes a payment card record from the database ---
    //-------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $cardID = $_GET['id'];

    //call the function, passing in the attributes from the url
    $result = deletePaymentCard($cardID);

    //return the result
    echo $result;

?>