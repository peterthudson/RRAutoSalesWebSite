<?php

    //-----------------------------------------------------------------
    //--- Returns the card info for wish list-based recommendations ---
    //-----------------------------------------------------------------

    //include the functions file
    $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/vehiclefunctions.php";
    include($functionpath);

    //get the attributes from the endpoint url
    $user_id = $_GET['userID'];

    //Get the ID of the most common manufacturer from the wishlist
    $mostManufacturer = getMostCommonWishlistManufacturer($user_id);
    $mostManufacturerArray = json_decode($mostManufacturer, true);
    $mostCommonManufacturer = $mostManufacturerArray['manufacturerID'];

    //Get the ID of the most common paint colour from the wishlist
    $mostColour = getMostCommonWishlistColour($user_id);
    $mostColourArray = json_decode($mostColour, true);
    $mostCommonColour = $mostColourArray['colourID'];

    //Get the ID of the most common vehicle type from the wishlist
    $mostType = getMostCommonWishlistType($user_id);
    $mostTypeArray = json_decode($mostType, true);
    $mostCommonType = $mostTypeArray['typeID'];

    //Randomly select one of the three attributes to base recommendations on
    $randomNo = rand(1,3);

    switch($randomNo){
        case(1) : {
            $recommendations = getRecommendationInfoByManu($mostCommonManufacturer);
            break;
        }

        case(2) : {
            $recommendations = getRecommendationInfoByColour($mostCommonColour);
            break; 
        }

        case(3) : {
            $recommendations = getRecommendationInfoByType($mostCommonType);
            break; 
        }
    }
    //return the result
    echo $recommendations;

?>