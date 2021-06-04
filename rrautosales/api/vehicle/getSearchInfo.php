<?php

    //-------------------------------------------------------------------
    //--- Returns A specific option from the database based on the ID ---
    //-------------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    $field = $_GET['field'];
    $id = $_GET['id'];

    switch ($field) {
        case ('manu') : {
            $result = getManufacturerByID($id);
            break;
        }

        case ('cond') : {
            $result = getConditionByID($id);
            break;
        }

        case ('dtype') : {
            $result = getDriveTypeByID($id);
            break;
        }

        case ('vtype') : {
            $result = getVehicleTypeByID($id);
            break;
        }

        case ('colour') : {
            $result = getPaintColourByID($id);
            break;
        }

        case ('region') : {
            $result = getRegionByID($id);
            break;
        }

        case ('cylinders') : {
            $result = getCylindersByID($id);
            break;
        }

        case ('ftype') : {
            $result = getFuelTypeByID($id);
            break;
        }

        case ('title') : {
            $result = getTitleByID($id);
            break;
        }

        case ('trans') : {
            $result = getTransmissionByID($id);
            break;
        }
    }

    //return the result
    echo $result;

?>