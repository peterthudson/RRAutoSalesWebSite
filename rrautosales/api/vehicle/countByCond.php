<?php

    //-----------------------------------------------------------------------------------
    //--- Returns a list of Condition options and how many vehicles there are of each ---
    //-----------------------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //call the function, passing in the attributes from the url
    $manuList = countByCond();

    //return the result
    echo $manuList;

?>