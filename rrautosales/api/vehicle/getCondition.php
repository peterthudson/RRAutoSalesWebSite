<?php

    //----------------------------------------------------------------
    //--- Returns a list of the conditions options in the database ---
    //----------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //call the function, passing in the attributes from the url
    $allConditions = getConditions();

    //return the result
    echo $allConditions;

?>