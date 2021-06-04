<?php

    //-------------------------------
    //--- Generates a new API key ---
    //-------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
    include($functionpath);

    //call the function, passing in the attributes from the url
    $key = generateKey();

    //return the result
    echo $key;

?>