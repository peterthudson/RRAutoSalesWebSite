<?php

    header('Content-Type: application/json');

    //Get all vehicle entries in the database
    function getAllVehicles($pageNo) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $safePageNo = $conn->real_escape_string($pageNo);
        $safePageNo = htmlentities($safePageNo);

        $offset = 20 * ($safePageNo - 1);

        $getBasicVehicleInfo = "SELECT `vehicle_id` AS 'ID', 
        `price` AS 'price', 
        `year` AS 'year', 
        `ASSIGNMENT_photos`.`thumbnail_photo` AS 'thumbnail', 
        ASSIGNMENT_manufacturer.manu_name AS 'manufacturer', 
        `model` AS 'model', 
        ASSIGNMENT_manufacturer.manu_logo_url AS 'logo' 
        FROM ASSIGNMENT_vehicles 
        LEFT JOIN ASSIGNMENT_manufacturer ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id 
        LEFT JOiN ASSIGNMENT_photos ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id
        WHERE ASSIGNMENT_vehicles.vehicle_owner = 0
        ORDER BY ASSIGNMENT_vehicles.vehicle_id ASC
        LIMIT 20
        OFFSET $offset";

        $basicVehicleInfo = $conn->query($getBasicVehicleInfo);

        if(!$basicVehicleInfo){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($basicVehicleInfo)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Count how many vehicles there are in the database
    function countAllVehicles() {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $countQuery = "SELECT COUNT(*) AS 'count' FROM ASSIGNMENT_vehicles";

        $queryResult = $conn->query($countQuery);
        $countResult = mysqli_fetch_array($queryResult)[0];

        if(!$queryResult){
            return $conn->error;
        } else {
            return $countResult;
        } 
    }

    //Get all vehicle information 
    function getAllVehicleInfo($vehicle_id) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryVehicleID = $conn->real_escape_string($vehicle_id);
        $queryVehicleID = htmlentities($queryVehicleID);
    
        $getVehicleInfo = "SELECT
        `vehicle_id` AS 'ID',
        ASSIGNMENT_region.region_name AS 'region',
        ASSIGNMENT_vehicles.region_id AS 'regionid',
        `price` AS 'price',
        `year` AS 'year',
        ASSIGNMENT_manufacturer.manu_name AS 'manufacturer',
        ASSIGNMENT_vehicles.manufacturer_id AS 'manufacturerid',
        `model` AS 'model',
        ASSIGNMENT_condition.condition_desc AS 'condition',
        ASSIGNMENT_vehicles.condition_id AS 'conditionid',
        ASSIGNMENT_cylinders.cylinders AS 'cylinders',
        ASSIGNMENT_vehicles.cylinders_id AS 'cylindersid',
        ASSIGNMENT_fuel_type.fuel_type AS 'fuel',
        ASSIGNMENT_vehicles.fuel_type_id AS 'fuelid',
        `odometer` AS 'odometer',
        ASSIGNMENT_title_status.title_name AS 'title',
        ASSIGNMENT_vehicles.title_status_id AS 'titleid',
        ASSIGNMENT_transmission.transmission AS 'transmission',
        ASSIGNMENT_vehicles.transmission_id AS 'transmissionid',
        `vin_number` AS 'vin',
        ASSIGNMENT_drive_type.drive_type AS 'drive',
        ASSIGNMENT_vehicles.drive_type_id AS 'driveid',
        ASSIGNMENT_vehicle_type.vehicle_type AS 'vehicletype',
        ASSIGNMENT_vehicles.vehicle_type_id as 'vehicletypeid',
        ASSIGNMENT_paint_colour.paint_colour AS 'colour',
        ASSIGNMENT_vehicles.paint_colour_id AS 'colourid',
        `image_url` AS 'photourl',
        `latitude` AS 'lat',
        `longitude` AS 'long',
        ASSIGNMENT_manufacturer.manu_logo_url AS 'logo',
        ASSIGNMENT_vehicles.user_ID AS 'userID',
        ASSIGNMENT_photos.carousel_photo_1 AS 'photoOne',
        ASSIGNMENT_photos.carousel_photo_2 AS 'photoTwo',
        ASSIGNMENT_photos.carousel_photo_3 AS 'photoThree',
        ASSIGNMENT_photos.carousel_photo_4 AS 'photoFour',
        ASSIGNMENT_photos.carousel_photo_5 AS 'photoFive'
        FROM ASSIGNMENT_vehicles
        LEFT JOIN ASSIGNMENT_manufacturer ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
        LEFT JOIN ASSIGNMENT_condition ON ASSIGNMENT_vehicles.condition_id = ASSIGNMENT_condition.condition_id
        LEFT JOIN ASSIGNMENT_cylinders ON ASSIGNMENT_vehicles.cylinders_id = ASSIGNMENT_cylinders.cylinder_id
        LEFT JOIN ASSIGNMENT_fuel_type ON ASSIGNMENT_vehicles.fuel_type_id = ASSIGNMENT_fuel_type.fuel_id
        LEFT JOIN ASSIGNMENT_title_status ON ASSIGNMENT_vehicles.title_status_id = ASSIGNMENT_title_status.title_id
        LEFT JOIN ASSIGNMENT_transmission ON ASSIGNMENT_vehicles.transmission_id = ASSIGNMENT_transmission.transmission_id
        LEFT JOIN ASSIGNMENT_drive_type ON ASSIGNMENT_vehicles.drive_type_id = ASSIGNMENT_drive_type.drive_type_id
        LEFT JOIN ASSIGNMENT_vehicle_type ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_vehicle_type.vehicle_type_id
        LEFT JOIN ASSIGNMENT_paint_colour ON ASSIGNMENT_vehicles.paint_colour_id = ASSIGNMENT_paint_colour.paint_colour_id
        LEFT JOIN ASSIGNMENT_region ON ASSIGNMENT_vehicles.region_id = ASSIGNMENT_region.region_id
        LEFT JOIN ASSIGNMENT_photos ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id
        WHERE vehicle_id = $queryVehicleID";

        $vehicleInfo = $conn->query($getVehicleInfo);

        if(!$vehicleInfo){
            echo $conn->error;
        }

        $result = $vehicleInfo->fetch_array(MYSQLI_ASSOC);

        return json_encode($result);
    }

    //Get basic vehicle information by type
    function getBasicVehicleInfoByType($type, $pageNo) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $safePageNo = $conn->real_escape_string($pageNo);
        $safePageNo = htmlentities($safePageNo);
        $queryType = $conn->real_escape_string($type);
        $queryType = htmlentities($queryType);

        $offset = 20 * ($safePageNo - 1);

        $getBasicVehicleInfo = "SELECT `vehicle_id` AS 'ID', 
        `price` AS 'price', 
        `year` AS 'year', 
        `ASSIGNMENT_photos`.`thumbnail_photo` AS 'thumbnail', 
        ASSIGNMENT_manufacturer.manu_name AS 'manufacturer', 
        `model` AS 'model', 
        ASSIGNMENT_manufacturer.manu_logo_url AS 'logo',
        ASSIGNMENT_vehicle_type.vehicle_type AS 'type'
        FROM ASSIGNMENT_vehicles 
        LEFT JOIN ASSIGNMENT_manufacturer ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id 
        LEFT JOIN ASSIGNMENT_photos ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id 
        LEFT JOIN ASSIGNMENT_vehicle_type ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_vehicle_type.vehicle_type_id
        WHERE ASSIGNMENT_vehicles.vehicle_type_id = $queryType
        AND ASSIGNMENT_vehicles.vehicle_owner = 0 
        ORDER BY ASSIGNMENT_vehicles.vehicle_id ASC
        LIMIT 20
        OFFSET $offset";

        $basicVehicleInfo = $conn->query($getBasicVehicleInfo);

        if(!$basicVehicleInfo){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($basicVehicleInfo)) {
            $rows[] = $r;
        }

        return json_encode($rows);


    }

    //---- RECOMMENDATIONS FUNCTIONS --------------------------------------------------------------------

    //Get The most common manufacturer from the user's view history
    function getMostCommonHistoryManufacturer($userID) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
        
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getQuery = "SELECT ASSIGNMENT_manufacturer.manu_name AS 'manufacturer',
        ASSIGNMENT_manufacturer.manufacturer_id AS 'manufacturerID',
        COUNT(ASSIGNMENT_vehicles.manufacturer_id) AS `count` 
        FROM ASSIGNMENT_view_history
        LEFT JOIN ASSIGNMENT_vehicles
        ON ASSIGNMENT_view_history.view_history_vehicle_id = ASSIGNMENT_vehicles.vehicle_id
        LEFT JOIN ASSIGNMENT_manufacturer
        ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
        WHERE ASSIGNMENT_view_history.view_history_user_id = $queryUserID
        GROUP BY ASSIGNMENT_vehicles.manufacturer_id
        ORDER BY ASSIGNMENT_vehicles.manufacturer_id DESC
        LIMIT 1";

        $queryResult = $conn->query($getQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $topManufacturer = $queryResult->fetch_array(MYSQLI_ASSOC);

        return json_encode($topManufacturer);
    }

    //Get The most common paint colour from the user's view history
    function getMostCommonHistoryColour($userID) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getQuery = "SELECT ASSIGNMENT_paint_colour.paint_colour AS 'colour',
        ASSIGNMENT_paint_colour.paint_colour_id AS 'colourID',
        COUNT(ASSIGNMENT_vehicles.paint_colour_id) AS `count` 
        FROM ASSIGNMENT_view_history
        LEFT JOIN ASSIGNMENT_vehicles
        ON ASSIGNMENT_view_history.view_history_vehicle_id = ASSIGNMENT_vehicles.vehicle_id
        LEFT JOIN ASSIGNMENT_paint_colour
        ON ASSIGNMENT_vehicles.paint_colour_id = ASSIGNMENT_paint_colour.paint_colour_id
        WHERE ASSIGNMENT_view_history.view_history_user_id = $queryUserID
        GROUP BY ASSIGNMENT_paint_colour.paint_colour_id
        ORDER BY ASSIGNMENT_paint_colour.paint_colour_id DESC
        LIMIT 1";

        $queryResult = $conn->query($getQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $topColour = $queryResult->fetch_array(MYSQLI_ASSOC);

        return json_encode($topColour);
    }

    //Get The most common vehicle type from the user's view history
    function getMostCommonHistoryType($userID) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getQuery = "SELECT ASSIGNMENT_vehicle_type.vehicle_type AS 'type',
        ASSIGNMENT_vehicle_type.vehicle_type_id AS 'typeID',
        COUNT(ASSIGNMENT_vehicles.vehicle_type_id) AS `count` 
        FROM ASSIGNMENT_view_history
        LEFT JOIN ASSIGNMENT_vehicles
        ON ASSIGNMENT_view_history.view_history_vehicle_id = ASSIGNMENT_vehicles.vehicle_id
        LEFT JOIN ASSIGNMENT_vehicle_type
        ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_vehicle_type.vehicle_type_id
        WHERE ASSIGNMENT_view_history.view_history_user_id = $queryUserID
        GROUP BY ASSIGNMENT_vehicle_type.vehicle_type_id
        ORDER BY ASSIGNMENT_vehicle_type.vehicle_type_id DESC
        LIMIT 1";

        $queryResult = $conn->query($getQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $topType = $queryResult->fetch_array(MYSQLI_ASSOC);

        return json_encode($topType);
    }

    //Get The most common manufacturer from the user's wishlist
    function getMostCommonWishlistManufacturer($userID) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getQuery = "SELECT ASSIGNMENT_manufacturer.manu_name AS 'manufacturer',
        ASSIGNMENT_manufacturer.manufacturer_id AS 'manufacturerID',
        COUNT(ASSIGNMENT_vehicles.manufacturer_id) AS `count` 
        FROM ASSIGNMENT_wishlist
        LEFT JOIN ASSIGNMENT_vehicles
        ON ASSIGNMENT_wishlist.vehicle_ID = ASSIGNMENT_vehicles.vehicle_id
        LEFT JOIN ASSIGNMENT_manufacturer
        ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
        WHERE ASSIGNMENT_wishlist.User_ID = $queryUserID
        GROUP BY ASSIGNMENT_vehicles.manufacturer_id
        ORDER BY ASSIGNMENT_vehicles.manufacturer_id DESC
        LIMIT 1";

        $queryResult = $conn->query($getQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $topManufacturer = $queryResult->fetch_array(MYSQLI_ASSOC);

        return json_encode($topManufacturer);
    }

    //Get The most common paint colour from the user's wishlist
    function getMostCommonWishlistColour($userID) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getQuery = "SELECT ASSIGNMENT_paint_colour.paint_colour AS 'colour',
        ASSIGNMENT_paint_colour.paint_colour_id AS 'colourID',
        COUNT(ASSIGNMENT_vehicles.paint_colour_id) AS `count` 
        FROM ASSIGNMENT_wishlist
        LEFT JOIN ASSIGNMENT_vehicles
        ON ASSIGNMENT_wishlist.vehicle_ID = ASSIGNMENT_vehicles.vehicle_id
        LEFT JOIN ASSIGNMENT_paint_colour
        ON ASSIGNMENT_vehicles.paint_colour_id = ASSIGNMENT_paint_colour.paint_colour_id
        WHERE ASSIGNMENT_wishlist.User_ID = $queryUserID
        GROUP BY ASSIGNMENT_paint_colour.paint_colour_id
        ORDER BY ASSIGNMENT_paint_colour.paint_colour_id DESC
        LIMIT 1";

        $queryResult = $conn->query($getQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $topColour = $queryResult->fetch_array(MYSQLI_ASSOC);

        return json_encode($topColour);
    }

    //Get The most common vehicle type from the user's wishlist
    function getMostCommonWishlistType($userID) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getQuery = "SELECT ASSIGNMENT_vehicle_type.vehicle_type AS 'type',
        ASSIGNMENT_vehicle_type.vehicle_type_id AS 'typeID',
        COUNT(ASSIGNMENT_vehicles.vehicle_type_id) AS `count` 
        FROM ASSIGNMENT_wishlist
        LEFT JOIN ASSIGNMENT_vehicles
        ON ASSIGNMENT_wishlist.vehicle_ID = ASSIGNMENT_vehicles.vehicle_id
        LEFT JOIN ASSIGNMENT_vehicle_type
        ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_vehicle_type.vehicle_type_id
        WHERE ASSIGNMENT_wishlist.User_ID = $queryUserID
        GROUP BY ASSIGNMENT_vehicle_type.vehicle_type_id
        ORDER BY ASSIGNMENT_vehicle_type.vehicle_type_id DESC
        LIMIT 1";

        $queryResult = $conn->query($getQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $topType = $queryResult->fetch_array(MYSQLI_ASSOC);

        return json_encode($topType);
    }

    //Get basic vehicle information by type for recommendation
    function getRecommendationInfoByType($type) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryType = $conn->real_escape_string($type);
        $queryType = htmlentities($queryType);

        $getBasicVehicleInfo = "SELECT `vehicle_id` AS 'ID', 
        `price` AS 'price', 
        `year` AS 'year', 
        `ASSIGNMENT_photos`.
        `thumbnail_photo` AS 'thumbnail', 
        ASSIGNMENT_manufacturer.manu_name AS 'manufacturer', 
        `model` AS 'model', 
        ASSIGNMENT_manufacturer.manu_logo_url AS 'logo' 
        FROM ASSIGNMENT_vehicles 
        LEFT JOIN ASSIGNMENT_manufacturer ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id 
        LEFT JOiN ASSIGNMENT_photos ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id 
        WHERE ASSIGNMENT_vehicles.vehicle_type_id = $queryType 
        ORDER BY RAND()
        LIMIT 5";

        $basicVehicleInfo = $conn->query($getBasicVehicleInfo);

        if(!$basicVehicleInfo){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($basicVehicleInfo)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get basic vehicle information by colour for recommendation
    function getRecommendationInfoByColour($colour) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryColour = $conn->real_escape_string($colour);
        $queryColour = htmlentities($queryColour);

        $getBasicVehicleInfo = "SELECT `vehicle_id` AS 'ID', 
        `price` AS 'price', 
        `year` AS 'year', 
        `ASSIGNMENT_photos`.
        `thumbnail_photo` AS 'thumbnail', 
        ASSIGNMENT_manufacturer.manu_name AS 'manufacturer', 
        `model` AS 'model', 
        ASSIGNMENT_manufacturer.manu_logo_url AS 'logo' 
        FROM ASSIGNMENT_vehicles 
        LEFT JOIN ASSIGNMENT_manufacturer ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id 
        LEFT JOiN ASSIGNMENT_photos ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id 
        WHERE ASSIGNMENT_vehicles.paint_colour_id = $queryColour 
        ORDER BY RAND()
        LIMIT 5";

        $basicVehicleInfo = $conn->query($getBasicVehicleInfo);

        if(!$basicVehicleInfo){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($basicVehicleInfo)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get basic vehicle information by colour for recommendation
    function getRecommendationInfoByManu($manu) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryManu = $conn->real_escape_string($manu);
        $queryManu = htmlentities($queryManu);

        $getBasicVehicleInfo = "SELECT `vehicle_id` AS 'ID', 
        `price` AS 'price', 
        `year` AS 'year', 
        `ASSIGNMENT_photos`.
        `thumbnail_photo` AS 'thumbnail', 
        ASSIGNMENT_manufacturer.manu_name AS 'manufacturer', 
        `model` AS 'model', 
        ASSIGNMENT_manufacturer.manu_logo_url AS 'logo' 
        FROM ASSIGNMENT_vehicles 
        LEFT JOIN ASSIGNMENT_manufacturer ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id 
        LEFT JOiN ASSIGNMENT_photos ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id 
        WHERE ASSIGNMENT_vehicles.manufacturer_id = $queryManu 
        ORDER BY RAND()
        LIMIT 5";

        $basicVehicleInfo = $conn->query($getBasicVehicleInfo);

        if(!$basicVehicleInfo){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($basicVehicleInfo)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //---------------------------------------------------------------------------------------------------

    //Check if a vehicle is in a user's history
    function checkUserHistory($userID, $vehicleID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);
        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);

        $checkQuery = "SELECT * FROM ASSIGNMENT_view_history 
            WHERE `view_history_user_id` = $queryUserID
            AND `view_history_vehicle_id` = $queryVehicleID
        ";

        $queryResult = $conn->query($checkQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $num = $queryResult->num_rows;

        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Check if a vehicle is in a user's wishlist
    function checkUserWishlist($userID, $vehicleID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);
        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);

        $selectQuery = "SELECT * 
            FROM ASSIGNMENT_wishlist 
            WHERE `User_id` = $queryUserID 
            AND `vehicle_id` = $queryVehicleID
        ";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        } else {
            $num = $queryResult->num_rows;

            if ($num > 0) {
                echo "1";
            } else {
                echo "0";
            }
        }

        
    }

    //Add vehicle to a user's view history
    function addToViewHistory($userID, $vehicleID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);
        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);

        $insertQuery = "INSERT INTO ASSIGNMENT_view_history 
        (`view_history_user_id`,
        `view_history_vehicle_id`,
        `view_history_view_date`) 
        VALUES ($queryUserID, 
        $queryVehicleID, 
        NOW())";

        $queryResult = $conn->query($insertQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $result = $queryResult->fetch_array(MYSQLI_ASSOC);

        return json_encode($result);
    
    }

    //Add vehicle record to wishlist
    function addToWishlist($userID, $vehicleID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);
    
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);
        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);

        $insertQuery = "INSERT INTO ASSIGNMENT_wishlist 
        (`User_ID`,
        `vehicle_ID`) 
        VALUES ($queryUserID, 
        $queryVehicleID)";

        $queryResult = $conn->query($insertQuery);

        if(!$queryResult){
            return $conn->error;
        } else {
            return "Added to Wishlist";
        }

        //$result = $queryResult->fetch_array(MYSQLI_ASSOC);

        //return json_encode($result);

    }

    //Remove vehicle record from wishlist
    function removeFromWishlist($userID, $vehicleID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);
        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);

        $deleteQuery = "DELETE 
            FROM `ASSIGNMENT_wishlist`
            WHERE User_ID = $queryUserID 
            AND vehicle_ID = $queryVehicleID
        ";

        $queryResult = $conn->query($deleteQuery);

        if(!$queryResult){
            return $conn->error;
        } else {
            return "Removed from Wishlist";
        }

    }

    //Get basic vehicle information from wishlist
    function getBasicVehicleInfoFromWishlist($userID, $pageNo) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
    
        $safePageNo = $conn->real_escape_string($pageNo);
        $safePageNo = htmlentities($safePageNo);
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $offset = 20 * ($safePageNo - 1);

        $getBasicVehicleInfo = "SELECT
        ASSIGNMENT_vehicles.vehicle_id AS 'ID',
        ASSIGNMENT_manufacturer.manu_name AS 'manufacturer',
        ASSIGNMENT_vehicles.model AS 'model',
        ASSIGNMENT_photos.`thumbnail_photo` AS 'thumbnail',
        ASSIGNMENT_vehicles.year AS 'year',
        ASSIGNMENT_vehicles.price AS 'price',
        ASSIGNMENT_vehicles.user_ID AS 'userID'
        FROM ASSIGNMENT_wishlist
        LEFT JOIN ASSIGNMENT_vehicles
        ON ASSIGNMENT_wishlist.vehicle_ID = ASSIGNMENT_vehicles.vehicle_id
        LEFT JOIN ASSIGNMENT_manufacturer
        ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
        LEFT JOiN ASSIGNMENT_photos 
        ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id 
        WHERE ASSIGNMENT_wishlist.User_ID = $queryUserID
        LIMIT 20
        OFFSET $offset";

        $basicVehicleInfo = $conn->query($getBasicVehicleInfo);

        if(!$basicVehicleInfo){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($basicVehicleInfo)) {
            $rows[] = $r;
        }

        return json_encode($rows);


    }

    //Get basic vehicle information from view history
    function getBasicVehicleInfoFromHistory($userID, $pageNo) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
    
        $safePageNo = $conn->real_escape_string($pageNo);
        $safePageNo = htmlentities($safePageNo);
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);
        
        $offset = 20 * ($safePageNo - 1);

        $selectQuery = "SELECT
        ASSIGNMENT_vehicles.vehicle_id AS 'ID',
        ASSIGNMENT_manufacturer.manu_name AS 'manufacturer',
        ASSIGNMENT_vehicles.model AS 'model',
        ASSIGNMENT_photos.`thumbnail_photo` AS 'thumbnail',
        ASSIGNMENT_vehicles.year AS 'year',
        ASSIGNMENT_vehicles.price AS 'price',
        ASSIGNMENT_vehicles.user_ID AS 'userID',
        ASSIGNMENT_view_history.view_history_view_date AS 'dateviewed'
        FROM ASSIGNMENT_view_history
        LEFT JOIN ASSIGNMENT_vehicles
        ON ASSIGNMENT_view_history.view_history_vehicle_id = ASSIGNMENT_vehicles.vehicle_id
        LEFT JOIN ASSIGNMENT_manufacturer
        ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
        LEFT JOiN ASSIGNMENT_photos 
        ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id
        WHERE ASSIGNMENT_view_history.view_history_user_id = $queryUserID
        ORDER BY ASSIGNMENT_view_history.view_history_view_date DESC
        LIMIT 20
        OFFSET $offset";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);


    }

    //Remove vehicle record from view History
    function removeFromHistory($userID, $vehicleID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);
        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);

        $deleteQuery = "DELETE 
            FROM `ASSIGNMENT_view_history`
            WHERE view_history_user_id = $queryUserID 
            AND view_history_vehicle_id = $queryVehicleID
        ";

        $queryResult = $conn->query($deleteQuery);

        if(!$queryResult){
            return $conn->error;
        } else {
            return "Removed from view history";
        }

    }

    //Count the number of vehicles by type to determine how many pages of results there should be
    function countVehicleTypes($type) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryType = $conn->real_escape_string($type);
        $queryType = htmlentities($queryType);

        $countQuery = "SELECT COUNT(*) 
            FROM ASSIGNMENT_vehicles 
            WHERE vehicle_type_id = $queryType
        ";

        $queryResult = $conn->query($countQuery);
        $total_rows = mysqli_fetch_array($queryResult)[0];

        if(!$queryResult){
            return $conn->error;
        } else {
            return $total_rows;
        } 
    }

    //check that a user's view history has vehicles in it
    function checkViewHistory($userID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getQuery = "SELECT COUNT(*) 
            AS 'rows' 
            FROM `ASSIGNMENT_view_history` 
            WHERE view_history_user_id = $queryUserID
        ";

        $queryResult = $conn->query($getQuery);
        $rows = mysqli_fetch_array($queryResult)[0];

        if(!$queryResult){
            return $conn->error;
        }

        if ($rows > 0){
            //if there are rows
            return 1;
        } else {
            //if there are not rows
            return 0;
        }
    }

    //check that a user's wishlist has vehicles in it
    function checkWishlist($userID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getQuery = "SELECT COUNT(*) 
            AS 'rows' 
            FROM `ASSIGNMENT_wishlist` 
            WHERE User_ID = $queryUserID
        ";

        $queryResult = $conn->query($getQuery);
        $rows = mysqli_fetch_array($queryResult)[0];

        if(!$queryResult){
            return $conn->error;
        }

        if ($rows > 0){
            //if there are rows
            return 1;
        } else {
            //if there are not rows
            return 0;
        }
    }

    //Count how many vehicles are in a user's wishlist
    function countWishlist($userID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $countQuery = "SELECT COUNT(*) 
            AS 'count' 
            FROM ASSIGNMENT_wishlist 
            WHERE User_ID = $queryUserID
        ";

        $queryResult = $conn->query($countQuery);
        $total_rows = mysqli_fetch_array($queryResult)[0];

        if(!$queryResult){
            return $conn->error;
        } else {
            return $total_rows;
        } 
    }

    //Count how many vehicles are being sold by a user
    function countMyVehicles($userID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $countQuery = "SELECT COUNT(*) 
            AS 'count' 
            FROM ASSIGNMENT_vehicles 
            WHERE user_ID = $queryUserID
        ";

        $queryResult = $conn->query($countQuery);
        $total_rows = mysqli_fetch_array($queryResult)[0];

        if(!$queryResult){
            return $conn->error;
        } else {
            return $total_rows;
        } 

    }

    //Count how many vehicles are in a user's view history
    function countHistory($userID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $countQuery = "SELECT COUNT(*) 
            AS 'count' 
            FROM ASSIGNMENT_view_history 
            WHERE view_history_user_id = $queryUserID
        ";

        $queryResult = $conn->query($countQuery);
        $total_rows = mysqli_fetch_array($queryResult)[0];

        if(!$queryResult){
            return $conn->error;
        } else {
            return $total_rows;
        } 
    }

    //Get Information on all vehicles that were listed by a specific user
    function getMyListedVehicles($userID, $pageNo) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);
    
        $safePageNo = $conn->real_escape_string($pageNo);
        $safePageNo = htmlentities($safePageNo);
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $offset = 20 * ($safePageNo - 1);

        $selectQuery = "SELECT
        ASSIGNMENT_vehicles.vehicle_id AS 'id',
        ASSIGNMENT_photos.thumbnail_photo AS 'thumb',
        ASSIGNMENT_manufacturer.manu_name AS 'manu',
        ASSIGNMENT_vehicles.model AS 'model',
        ASSIGNMENT_vehicles.year AS 'year',
        ASSIGNMENT_vehicles.price AS 'price'
        FROM ASSIGNMENT_vehicles
        INNER JOIN ASSIGNMENT_manufacturer
        ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
        INNER JOIN ASSIGNMENT_photos
        ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id
        WHERE ASSIGNMENT_vehicles.user_ID = $queryUserID
        LIMIT 20
        OFFSET $offset";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Delete vehicle record
    function deleteVehicle($vehicleID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);

        //Delete record from view history -> wishlist -> vehicles
        $queryDeleteHistory = "DELETE FROM ASSIGNMENT_view_history
        WHERE view_history_vehicle_id = $queryVehicleID";

        $queryDeleteWishlist = "DELETE FROM ASSIGNMENT_wishlist
        WHERE vehicle_ID = $queryVehicleID";

        $queryDeleteVehicles = "DELETE FROM ASSIGNMENT_vehicles
        WHERE vehicle_id = $queryVehicleID";

        $deleteHistoryResult = $conn->query($queryDeleteHistory);
        if (!$deleteHistoryResult) {
            return $conn->error;
        } else {
            $deleteWishlistResult = $conn->query($queryDeleteWishlist);
            if (!$deleteWishlistResult){
                return $conn->error;
            } else {
                $deleteVehiclesResult = $conn->query($queryDeleteVehicles);
                if (!$deleteVehiclesResult){
                    return $conn->error;
                } else {
                    return "Vehicle Removed";
                }
            }
        }
    }

    //---- NEW VEHICLE FORM FUNCTIONS -------------------------------------------------------------------

    //Get a list of condition options
    function getConditions() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_condition.condition_desc AS 'condition' FROM `ASSIGNMENT_condition`";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of cylinder options
    function getCylinders() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_cylinders.cylinders AS 'cylinders' FROM ASSIGNMENT_cylinders";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of drive type options
    function getDriveTypes() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_drive_type.drive_type AS 'drivetype' FROM ASSIGNMENT_drive_type";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of fuel type options
    function getFuelTypes() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_fuel_type.fuel_type AS 'fueltype' FROM ASSIGNMENT_fuel_type";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of manufacturer options
    function getManu() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT * FROM ASSIGNMENT_manufacturer";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of colour options
    function getColour() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_paint_colour.paint_colour AS 'colour' FROM ASSIGNMENT_paint_colour";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of region options
    function getRegion() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_region.region_name AS 'region' FROM ASSIGNMENT_region";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of title options
    function getTitle() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_title_status.title_name AS 'title' FROM ASSIGNMENT_title_status";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of transmission type options
    function getTrans() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_transmission.transmission AS 'trans' FROM ASSIGNMENT_transmission";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Get a list of vehicle type options
    function getVehType() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $selectQuery = "SELECT ASSIGNMENT_vehicle_type.vehicle_type AS 'type' FROM ASSIGNMENT_vehicle_type";
        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Create a new vehicle record
    function newVehicle($manufacturer, $condition, $year, $vehType, $driveType, $colour,$region,$cylinders,$fuelType,$title,$transmission,$lat,$long,$odometer,$vin,$price,$model,$user) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryManufacturer = $conn->real_escape_string($manufacturer);
        $queryManufacturer = htmlentities($queryManufacturer);
        $queryCondition = $conn->real_escape_string($condition);
        $queryCondition = htmlentities($queryCondition);
        $queryYear = $conn->real_escape_string($year);
        $queryYear = htmlentities($queryYear);
        $queryVehicleType = $conn->real_escape_string($vehType);
        $queryVehicleType = htmlentities($queryVehicleType);
        $queryDriveType = $conn->real_escape_string($driveType);
        $queryDriveType = htmlentities($queryDriveType);
        $queryColour = $conn->real_escape_string($colour);
        $queryColour = htmlentities($queryColour);
        $queryRegion = $conn->real_escape_string($region);
        $queryRegion = htmlentities($queryRegion);
        $queryCylinders = $conn->real_escape_string($cylinders);
        $queryCylinders = htmlentities($queryCylinders);
        $queryFuelType = $conn->real_escape_string($fuelType);
        $queryFuelType = htmlentities($queryFuelType);
        $queryTitle = $conn->real_escape_string($title);
        $queryTitle = htmlentities($queryTitle);
        $queryTransmission = $conn->real_escape_string($transmission);
        $queryTransmission = htmlentities($queryTransmission);
        $queryLatitude = $conn->real_escape_string($lat);
        $queryLatitude = htmlentities($queryLatitude);
        $queryLongitude = $conn->real_escape_string($long);
        $queryLongitude = htmlentities($queryLongitude);
        $queryOdometer = $conn->real_escape_string($odometer);
        $queryOdometer = htmlentities($queryOdometer);
        $queryVIN = $conn->real_escape_string($vin);
        $queryVIN = htmlentities($queryVIN);
        $queryPrice = $conn->real_escape_string($price);
        $queryPrice = htmlentities($queryPrice);
        $queryModel = $conn->real_escape_string($model);
        $queryModel = htmlentities($queryModel);
        $queryUser = $conn->real_escape_string($user);
        $queryUser = htmlentities($queryUser);

        if ($queryCondition == "--Select--") {
            $queryCondition = 0;
        }

        if ($queryCylinders == "--Select--") {
            $queryCylinders = 0;
        }

        if ($queryFuelType == "--Select--") {
            $queryFuelType = 0;
        }

        if ($queryOdometer == null) {
            $queryOdometer = 0;
        }

        if ($queryTitle == "--Select--") {
            $queryTitle = 0;
        }

        if ($queryTransmission == "--Select--") {
            $queryTransmission = 0;
        }

        if ($queryVIN == null) {
            $queryVIN = "unknown";
        }

        if ($queryDriveType == "--Select--") {
            $queryDriveType = 0;
        }

        if ($queryLatitude == null) {
            $queryLatitude = 0;
        }

        if ($queryLongitude == null) {
            $queryLongitude = 0;
        }

        $insertQuery = "INSERT INTO `ASSIGNMENT_vehicles`(
            `region_id`, 
            `price`, 
            `year`, 
            `manufacturer_id`, 
            `model`, 
            `condition_id`, 
            `cylinders_id`, 
            `fuel_type_id`, 
            `odometer`, 
            `title_status_id`, 
            `transmission_id`,
            `vin_number`, 
            `drive_type_id`,
            `vehicle_type_id`, 
            `paint_colour_id`,
            `latitude`, 
            `longitude`, 
            `user_ID`, 
            `date_added`,
            `vehicle_owner`) 
            VALUES ($queryRegion,'$queryPrice',$queryYear,$queryManufacturer,'$queryModel',$queryCondition,$queryCylinders,$queryFuelType,$queryOdometer,$queryTitle,$queryTransmission,'$queryVIN',$queryDriveType,$queryVehicleType,$queryColour,$queryLatitude,$queryLongitude,$queryUser,NOW(), 0)
        ";
        
        $insertResult = $conn->query($insertQuery);

        if(!$insertResult){
            return $conn->error;
        } else {
            return 1;
        }
        
    }

//---------------------------------------------------------------------------------------------------

//---- LANDING PAGE FUNCTIONS -----------------------------------------------------------------------

    //Count how many vehicles there are for each region
    function countByRegion() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $countQuery = "SELECT
            ASSIGNMENT_region.region_name AS 'region',
            COUNT(ASSIGNMENT_vehicles.region_id) AS 'count'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_region
            ON ASSIGNMENT_vehicles.region_id = ASSIGNMENT_region.region_id
            GROUP BY ASSIGNMENT_vehicles.region_id
        ";
        $queryResult = $conn->query($countQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Count how many vehicles there are for each manufacturer
    function countByManu() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $countQuery = "SELECT
            ASSIGNMENT_manufacturer.manu_name AS 'name',
            COUNT(ASSIGNMENT_vehicles.manufacturer_id) AS 'count'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_manufacturer
            ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
            GROUP BY ASSIGNMENT_vehicles.manufacturer_id
        ";
        $queryResult = $conn->query($countQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Count how many vehicles there are for each condition
    function countByCond() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $countQuery = "SELECT
            ASSIGNMENT_condition.condition_desc as 'condition',
            COUNT(ASSIGNMENT_vehicles.condition_id) AS 'count'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_condition
            ON ASSIGNMENT_vehicles.condition_id = ASSIGNMENT_condition.condition_id
            GROUP BY ASSIGNMENT_vehicles.condition_id
        ";
        $queryResult = $conn->query($countQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Count how many vehicles there are for each fuel type
    function countByFuel() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $countQuery = "SELECT
            ASSIGNMENT_fuel_type.fuel_type AS 'type',
            COUNT(ASSIGNMENT_vehicles.fuel_type_id) AS 'count'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_fuel_type
            ON ASSIGNMENT_vehicles.fuel_type_id = ASSIGNMENT_fuel_type.fuel_id
            GROUP BY ASSIGNMENT_vehicles.fuel_type_id
        ";
        $queryResult = $conn->query($countQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Count how many vehicles there are for each title status
    function countByTitle() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $countQuery = "SELECT
            ASSIGNMENT_title_status.title_name as 'title',
            COUNT(ASSIGNMENT_vehicles.title_status_id) AS 'count'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_title_status
            ON ASSIGNMENT_vehicles.title_status_id = ASSIGNMENT_title_status.title_id
            GROUP BY ASSIGNMENT_vehicles.title_status_id
        ";
        $queryResult = $conn->query($countQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Count how many vehicles there are for each transmission type
    function countByTrans() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $countQuery = "SELECT
            ASSIGNMENT_transmission.transmission as 'transmission',
            COUNT(ASSIGNMENT_vehicles.transmission_id) AS 'count'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_transmission
            ON ASSIGNMENT_vehicles.transmission_id = ASSIGNMENT_transmission.transmission_id
            GROUP BY ASSIGNMENT_vehicles.transmission_id
        ";
        $queryResult = $conn->query($countQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Count how many vehicles there are for each drive type
    function countByDrive() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $countQuery = "SELECT
            ASSIGNMENT_drive_type.drive_type as 'drive',
            COUNT(ASSIGNMENT_vehicles.drive_type_id) AS 'count'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_drive_type
            ON ASSIGNMENT_vehicles.drive_type_id = ASSIGNMENT_drive_type.drive_type_id
            GROUP BY ASSIGNMENT_vehicles.drive_type_id
        ";
        $queryResult = $conn->query($countQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Count how many vehicles there are for each paint colour
    function countByColour() {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $countQuery = "SELECT
            ASSIGNMENT_paint_colour.paint_colour AS 'colour',
            COUNT(ASSIGNMENT_vehicles.paint_colour_id) AS 'count'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_paint_colour
            ON ASSIGNMENT_vehicles.paint_colour_id = ASSIGNMENT_paint_colour.paint_colour_id
            GROUP BY ASSIGNMENT_vehicles.paint_colour_id
        ";
        $queryResult = $conn->query($countQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //---------------------------------------------------------------------------------------------------

    //---- SEARCH PAGE FUNCTIONS ------------------------------------------------------------------------

    //Find information for records using query parameters passed in from the search field
    function detailedSearch($manu, $cond, $driveType, $vehType, $colour, $region, $cylinders, $fuelType, $title, $transmission, $priceMax, $priceMin, $yearMax, $yearMin) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryManufacturer = $conn->real_escape_string($manu);
        $queryManufacturer = htmlentities($queryManufacturer);
        $queryCondition = $conn->real_escape_string($cond);
        $queryCondition = htmlentities($queryCondition);
        $queryDriveType = $conn->real_escape_string($driveType);
        $queryDriveType = htmlentities($queryDriveType);
        $queryVehicleType = $conn->real_escape_string($vehType);
        $queryVehicleType = htmlentities($queryVehicleType);
        $queryColour = $conn->real_escape_string($colour);
        $queryColour = htmlentities($queryColour);
        $queryRegion = $conn->real_escape_string($region);
        $queryRegion = htmlentities($queryRegion);
        $queryCylinders = $conn->real_escape_string($cylinders);
        $queryCylinders = htmlentities($queryCylinders);
        $queryFuelType = $conn->real_escape_string($fuelType);
        $queryFuelType = htmlentities($queryFuelType);
        $queryTitle = $conn->real_escape_string($title);
        $queryTitle = htmlentities($queryTitle);
        $queryTransmission = $conn->real_escape_string($transmission);
        $queryTransmission = htmlentities($queryTransmission);
        $queryPriceMax = $conn->real_escape_string($priceMax);
        $queryPriceMax = htmlentities($queryPriceMax);
        $queryPriceMin = $conn->real_escape_string($priceMin);
        $queryPriceMin = htmlentities($queryPriceMin);
        $queryYearMax = $conn->real_escape_string($yearMax);
        $queryYearMax = htmlentities($queryYearMax);
        $queryYearMin = $conn->real_escape_string($yearMin);
        $queryYearMin = htmlentities($queryYearMin);

        if ($queryPriceMax == '') {
            $queryPriceMax = -1;
        }

        if($queryPriceMin == '') {
            $queryPriceMin = -1;
        }

        if ($queryYearMax == '') {
            $queryYearMax = -1;
        }

        if($queryYearMin == '') {
            $queryYearMin = -1;
        }

        $selectQuery = "SELECT ASSIGNMENT_vehicles.vehicle_id AS 'ID',
            ASSIGNMENT_vehicles.price AS 'price',
            ASSIGNMENT_vehicles.year AS 'year',
            ASSIGNMENT_manufacturer.manu_name AS 'manufacturer',
            ASSIGNMENT_vehicles.model AS 'model',
            ASSIGNMENT_photos.thumbnail_photo AS 'thumbnail'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_manufacturer
            ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
            INNER JOIN ASSIGNMENT_photos
            ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id
            WHERE (ASSIGNMENT_vehicles.manufacturer_id = $queryManufacturer OR $queryManufacturer = -1)
            AND (ASSIGNMENT_vehicles.condition_id = $queryCondition OR $queryCondition = -1)
            AND (ASSIGNMENT_vehicles.drive_type_id = $queryDriveType OR $queryDriveType = -1)
            AND (ASSIGNMENT_vehicles.vehicle_type_id = $queryVehicleType OR $queryVehicleType = -1)
            AND (ASSIGNMENT_vehicles.paint_colour_id = $queryColour OR $queryColour = -1)
            AND (ASSIGNMENT_vehicles.region_id = $queryRegion OR $queryRegion = -1)
            AND (ASSIGNMENT_vehicles.cylinders_id = $queryCylinders OR $queryCylinders = -1)
            AND (ASSIGNMENT_vehicles.fuel_type_id = $queryFuelType OR $queryFuelType = -1)
            AND (ASSIGNMENT_vehicles.title_status_id = $queryTitle OR $queryTitle = -1)
            AND (ASSIGNMENT_vehicles.transmission_id = $queryTransmission OR $queryTransmission = -1)
            AND (ASSIGNMENT_vehicles.price >= $queryPriceMin OR $queryPriceMin = -1)
            AND (ASSIGNMENT_vehicles.price <= $queryPriceMax OR $queryPriceMax = -1)
            AND (ASSIGNMENT_vehicles.year >= $queryYearMin OR $queryYearMin = -1)
            AND (ASSIGNMENT_vehicles.year <= $queryYearMax OR $queryYearMax = -1)
            AND ASSIGNMENT_vehicles.vehicle_owner = 0
        ";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            echo $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //---------------------------------------------------------------------------------------------------

    //Update vehicle record
    function updateVehicle($vehicleID,$manufacturer,$model,$condition,$price,$year,$vehicleType,$driveType,$paintColour,$region,$cylinders,$fuelType,$titleStatus,$transmissionType,$latitude,$longitude,$odometer,$vin) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);
        $queryManufacturer = $conn->real_escape_string($manufacturer);
        $queryManufacturer = htmlentities($queryManufacturer);
        $queryModel = $conn->real_escape_string($model);
        $queryModel = htmlentities($queryModel);
        $queryCondition = $conn->real_escape_string($condition);
        $queryCondition = htmlentities($queryCondition);
        $queryPrice = $conn->real_escape_string($price);
        $queryPrice = htmlentities($queryPrice);
        $queryYear = $conn->real_escape_string($year);
        $queryYear = htmlentities($queryYear);
        $queryVehicleType = $conn->real_escape_string($vehicleType);
        $queryVehicleType = htmlentities($queryVehicleType);
        $queryDriveType = $conn->real_escape_string($driveType);
        $queryDriveType = htmlentities($queryDriveType);
        $queryColour = $conn->real_escape_string($paintColour);
        $queryColour = htmlentities($queryColour);
        $queryRegion = $conn->real_escape_string($region);
        $queryRegion = htmlentities($queryRegion);
        $queryCylinders = $conn->real_escape_string($cylinders);
        $queryCylinders = htmlentities($queryCylinders);
        $queryFuelType = $conn->real_escape_string($fuelType);
        $queryFuelType = htmlentities($queryFuelType);
        $queryTitle = $conn->real_escape_string($titleStatus);
        $queryTitle = htmlentities($queryTitle);
        $queryTransmission = $conn->real_escape_string($transmissionType);
        $queryTransmission = htmlentities($queryTransmission);
        $queryLatitude = $conn->real_escape_string($latitude);
        $queryLatitude = htmlentities($queryLatitude);
        $queryLongitude = $conn->real_escape_string($longitude);
        $queryLongitude = htmlentities($queryLongitude);
        $queryOdometer = $conn->real_escape_string($odometer);
        $queryOdometer = htmlentities($queryOdometer);
        $queryVIN = $conn->real_escape_string($vin);
        $queryVIN = htmlentities($queryVIN);

        $updateQuery = "UPDATE ASSIGNMENT_vehicles
        SET ASSIGNMENT_vehicles.region_id=$queryRegion,
        ASSIGNMENT_vehicles.price=$queryPrice,
        ASSIGNMENT_vehicles.year=$queryYear,
        ASSIGNMENT_vehicles.manufacturer_id=$queryManufacturer,
        ASSIGNMENT_vehicles.model='$queryModel',
        ASSIGNMENT_vehicles.condition_id=$queryCondition,
        ASSIGNMENT_vehicles.cylinders_id=$queryCylinders,
        ASSIGNMENT_vehicles.fuel_type_id=$queryFuelType,
        ASSIGNMENT_vehicles.odometer=$queryOdometer,
        ASSIGNMENT_vehicles.title_status_id=$queryTitle,
        ASSIGNMENT_vehicles.transmission_id=$queryTransmission,
        ASSIGNMENT_vehicles.vin_number='$queryVIN',
        ASSIGNMENT_vehicles.drive_type_id=$queryDriveType,
        ASSIGNMENT_vehicles.vehicle_type_id=$queryVehicleType,
        ASSIGNMENT_vehicles.paint_colour_id=$queryColour,
        ASSIGNMENT_vehicles.latitude=$queryLatitude,
        ASSIGNMENT_vehicles.longitude=$queryLongitude
        WHERE ASSIGNMENT_vehicles.vehicle_id = $queryVehicleID";

        $queryResult = $conn->query($updateQuery);

        if(!$queryResult){
            return $conn->error;
        } else {
            return "success";
        }
    }

    //Get vehicle type
    function getVehicleType($type) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryType = $conn->real_escape_string($type);
        $queryType = htmlentities($queryType);

        $selectQuery = "SELECT ASSIGNMENT_vehicle_type.vehicle_type AS 'type'
            FROM ASSIGNMENT_vehicle_type
            WHERE ASSIGNMENT_vehicle_type.vehicle_type_id = $queryType    
        ";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            return $conn->error;
        } else {
            
            $singleRow = $queryResult->fetch_row();

            return json_encode($singleRow);
        }
    }

    //Get a manufacturer by ID
    function getManufacturerByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_manufacturer
            WHERE ASSIGNMENT_manufacturer.manufacturer_id = $queryID    
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get a Condition by ID
    function getConditionByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_condition
            WHERE ASSIGNMENT_condition.condition_id = $queryID    
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get a Drive Type by ID
    function getDriveTypeByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_drive_type
            WHERE ASSIGNMENT_drive_type.drive_type_id = $queryID    
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get a Vehicle Type by ID
    function getVehicleTypeByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_vehicle_type
            WHERE ASSIGNMENT_vehicle_type.vehicle_type_id = $queryID    
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get Paint Colour by ID
    function getPaintColourByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_paint_colour
            WHERE ASSIGNMENT_paint_colour.paint_colour_id = $queryID    
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get Region by ID
    function getRegionByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_region
            WHERE ASSIGNMENT_region.region_id = $queryID    
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get Cylinders by ID
    function getCylindersByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_cylinders
            WHERE ASSIGNMENT_cylinders.cylinder_id = $queryID    
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get Fuel Type by ID
    function getFuelTypeByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_fuel_type
            WHERE ASSIGNMENT_fuel_type.fuel_id = $queryID
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get Title Status by ID
    function getTitleByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_title_status
            WHERE ASSIGNMENT_title_status.title_id = $queryID
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Get Transmission by ID
    function getTransmissionByID ($id){

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryID = $conn->real_escape_string($id);
        $queryID = htmlentities($queryID);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_transmission
            WHERE ASSIGNMENT_transmission.transmission_id = $queryID    
        ";

        $queryResult = $conn->query($selectQuery);

        $singleRow = $queryResult->fetch_row();

        return json_encode($singleRow);
    }

    //Update the owner attribute on a vehicle for when a user buys a vehicle, delete it from their view hisotry and wish list
    function buyVehicle($vehicleID, $userID) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryVehicleID = $conn->real_escape_string($vehicleID);
        $queryVehicleID = htmlentities($queryVehicleID);
        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $updateQuery = "UPDATE ASSIGNMENT_vehicles
            SET ASSIGNMENT_vehicles.vehicle_owner = $queryUserID
            WHERE ASSIGNMENT_vehicles.vehicle_id = $queryVehicleID
        ";

        $updateQueryResult = $conn->query($updateQuery);

        //Remove the vehicle from the user's wishlist
        $deleteFromWishlist = removeFromWishlist($userID, $vehicleID);

        //Remove the vehicle from the user's view history
        $deleteFromHistory = removeFromHistory($userID, $vehicleID);

        $updateQueryResult = $conn->query($updateQuery);
        if(!$updateQueryResult) {
            return $conn->error;
        } else {
            return 1;
        }
    }

    //Retrieve a list of the vehicles that a user has bought
    function myOwnedVehicles($userID) {

        $dbPath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbPath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $selectQuery = "SELECT ASSIGNMENT_manufacturer.manu_name AS 'manufacturer',
            ASSIGNMENT_vehicles.model AS 'model',
            ASSIGNMENT_photos.thumbnail_photo AS 'photo',
            ASSIGNMENT_vehicles.price AS 'price'
            FROM ASSIGNMENT_vehicles
            INNER JOIN ASSIGNMENT_photos
            ON ASSIGNMENT_vehicles.vehicle_type_id = ASSIGNMENT_photos.vehicle_type_id
            INNER JOIN ASSIGNMENT_manufacturer
            ON ASSIGNMENT_vehicles.manufacturer_id = ASSIGNMENT_manufacturer.manufacturer_id
            WHERE ASSIGNMENT_vehicles.vehicle_owner = $queryUserID
        ";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult) {
            return $conn->error;
        } else {

            $rows = array();

            while ($r = mysqli_fetch_assoc($queryResult)) {
                $rows[] = $r;
            }

            return json_encode($rows);

        }
    }
?>

