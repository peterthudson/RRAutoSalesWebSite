<?php

    //-------------------------------------------------------------------------------
    //--- Returns a list of Title options and how many vehicles there are of each ---
    //-------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //call the function, passing in the attributes from the url
    $list = countByTitle();

    //return the result
    echo $list;

?>