<?php

    //------------------------------------------------------------------------------------
    //--- Returns a list of drive type options and how many vehicles there are of each ---
    //------------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //call the function, passing in the attributes from the url
    $list = countByDrive();

    //return the result
    echo $list;

?>