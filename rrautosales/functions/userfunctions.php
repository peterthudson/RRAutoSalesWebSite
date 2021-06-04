<?php

    header('Content-Type: application/json');

    //Check user's API key
    function checkAPIKey($userID, $apiKey) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);
        $queryApiKey = $conn->real_escape_string($apiKey);
        $queryApiKey = htmlentities($queryApiKey);

        $selectQuery = "SELECT ASSIGNMENT_user.user_apikey AS 'key'
            FROM ASSIGNMENT_user
            WHERE ASSIGNMENT_user.User_ID = $queryUserID
            AND ASSIGNMENT_user.user_apikey = '$queryApiKey'
        ";
    
        $queryResult = $conn->query($selectQuery);

        $num = $queryResult->num_rows;

        if ($num > 0) {
            return 1; //API Key is correct
        } else {
            return 0; //API Key is incorrect
        }
    
    }
    
    //Get all user info
    function getUserAllInfo($user_id){

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($user_id);
        $queryUserID = htmlentities($queryUserID);
    
        $getuserinfo = "SELECT 
        `User_ID` AS 'userid',
        `user_forename` AS 'firstname',
        `user_surname` AS 'surname',
        `user_email` AS 'email',
        `user_password` AS 'password',
        `user_title` AS 'title',
        `user_dob` AS 'dob',
        `user_gender` AS 'gender',
        `user_phone` AS 'phone',
        `user_mobile` AS 'mobile',
        `user_ship_line_one` AS 'shiplineone',
        `user_ship_line_two` AS 'shiplinetwo',
        `user_ship_town` AS 'shiptown',
        `user_ship_zip` AS 'shipzip',
        `user_ship_state` AS 'shipstate',
        `user_ship_country` AS 'shipcountry',
        `user_inv_line_one` AS 'invlineone',
        `user_inv_line_two` AS 'invlinetwo',
        `user_inv_town` AS 'invtown',
        `user_inv_zip` AS 'invzip',
        `user_inv_state` AS 'invstate',
        `user_inv_country` AS 'invcountry',
        `user_admin` AS 'adminstatus',
        `user_photo_url` AS 'photourl',
        `user_apikey` AS 'apikey'
        FROM `ASSIGNMENT_user`
        WHERE User_ID = $queryUserID";

        $userinfo = $conn->query($getuserinfo);

        if(!$userinfo){
            echo $conn->error;
        }

        $result = $userinfo->fetch_array(MYSQLI_ASSOC);

        return json_encode($result);
    }

    //Get required session information
    function getSessionInfo($email, $password) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryEmail = $conn->real_escape_string($email);
        $queryEmail = htmlentities($queryEmail);
        $queryPassword = $conn->real_escape_string($password);
        $queryPassword = htmlentities($queryPassword);

        $selectQuery = "SELECT ASSIGNMENT_user.User_ID AS 'id',
            ASSIGNMENT_user.user_admin AS 'admin',
            ASSIGNMENT_user.user_photo_url AS 'photourl',
            ASSIGNMENT_user.user_apikey AS 'apikey'
            FROM ASSIGNMENT_user 
            WHERE user_email = '$queryEmail' 
            AND user_password = '$queryPassword'
        ";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult) {
            return $conn->error;
        } else {

            $singleRow = $queryResult->fetch_row();

            return json_encode($singleRow);
        }
    
    }

    //Validate login
    function validateLogin($email, $password) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryEmail = $conn->real_escape_string($email);
        $queryEmail = htmlentities($queryEmail);
        $queryPassword = $conn->real_escape_string($password);
        $queryPassword = htmlentities($queryPassword);

        $selectQuery = "SELECT *
            FROM ASSIGNMENT_user 
            WHERE user_email = '$queryEmail' 
            AND user_password = '$queryPassword'
        ";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult) {
            return $conn->error;
        } else {
            $rows = $queryResult->num_rows;

            if($rows > 0) {
                return 1; //If there is a match
            } else {
                return 0; //If there is not a match
            }
        }
        

    }
    //Produce a random string that will be used for the user's API Key
    function generate_string($input, $strength) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
 
        return $random_string;
    }

    //Generate a new API Key and check that it is not already being used by another user
    function generateKey() {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return generate_string($permitted_chars, 30);

    }

    //Create new user record
    function createNewUser($user_title, $user_forename, $user_surname, $user_email, $user_password, $user_dob, $user_gender, $user_phone, $user_mobile, $user_shiplineone, $user_shiplinetwo, $user_shiptown, $user_shipzip, $user_shipstate, $user_shipcountry, $user_invlineone, $user_invlinetwo, $user_invtown, $user_invzip, $user_invstate, $user_invcountry, $user_admin, $user_photourl) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $QueryTitle = $conn->real_escape_string($user_title);
        $QueryTitle = htmlentities($QueryTitle);
        $QueryForename = $conn->real_escape_string($user_forename);
        $QueryForename = htmlentities($QueryForename);
        $QuerySurname = $conn->real_escape_string($user_surname);
        $QuerySurname = htmlentities($QuerySurname);
        $QueryEmail = $conn->real_escape_string($user_email);
        $QueryEmail = htmlentities($QueryEmail);
        $QueryPassword = $conn->real_escape_string($user_password);
        $QueryPassword = htmlentities($QueryPassword);
        $QueryDOB = $conn->real_escape_string($user_dob);
        $QueryDOB = htmlentities($QueryDOB);
        $QueryGender = $conn->real_escape_string($user_gender);
        $QueryGender = htmlentities($QueryGender);
        $QueryPhone = $conn->real_escape_string($user_phone);
        $QueryPhone = htmlentities($QueryPhone);
        $QueryMobile = $conn->real_escape_string($user_mobile);
        $QueryMobile = htmlentities($QueryMobile);
        $QueryShipLineOne = $conn->real_escape_string($user_shiplineone);
        $QueryShipLineOne = htmlentities($QueryShipLineOne);
        $QueryShipLineTwo = $conn->real_escape_string($user_shiplinetwo);
        $QueryShipLineTwo = htmlentities($QueryShipLineTwo);
        $QueryShipTown = $conn->real_escape_string($user_shiptown);
        $QueryShipTown = htmlentities($QueryShipTown);
        $QueryShipZip = $conn->real_escape_string($user_shipzip);
        $QueryShipZip = htmlentities($QueryShipZip);
        $QueryShipState = $conn->real_escape_string($user_shipstate);
        $QueryShipState = htmlentities($QueryShipState);
        $QueryShipCountry = $conn->real_escape_string($user_shipcountry);
        $QueryShipCountry = htmlentities($QueryShipCountry);
        $QueryInvLineOne = $conn->real_escape_string($user_invlineone);
        $QueryInvLineOne = htmlentities($QueryInvLineOne);
        $QueryInvLineTwo = $conn->real_escape_string($user_invlinetwo);
        $QueryInvLineTwo = htmlentities($QueryInvLineTwo);
        $QueryInvTown = $conn->real_escape_string($user_invtown);
        $QueryInvTown = htmlentities($QueryInvTown);
        $QueryInvZip = $conn->real_escape_string($user_invzip);
        $QueryInvZip = htmlentities($QueryInvZip);
        $QueryInvState = $conn->real_escape_string($user_invstate);
        $QueryInvState = htmlentities($QueryInvState);
        $QueryInvCountry = $conn->real_escape_string($user_invcountry);
        $QueryInvCountry = htmlentities($QueryInvCountry);
        $QueryAdmin = $conn->real_escape_string($user_admin);
        $QueryAdmin = htmlentities($QueryAdmin);
        $QueryPhotoURL = $conn->real_escape_string($user_photourl);
        $QueryPhotoURL = htmlentities($QueryPhotoURL);

        if ($user_photourl == ""){
            $photourl = null;
        }

        $apiKey = generateKey();
        
        $insert = "INSERT INTO `ASSIGNMENT_user` (`user_title`,`user_forename`,
        `user_surname`,
        `user_email`,
        `user_password`,
        `user_dob`,
        `user_gender`,
        `user_phone`,
        `user_mobile`,
        `user_ship_line_one`,
        `user_ship_line_two`,
        `user_ship_town`,
        `user_ship_zip`,
        `user_ship_state`,
        `user_ship_country`,
        `user_inv_line_one`,
        `user_inv_line_two`,
        `user_inv_town`,
        `user_inv_zip`,
        `user_inv_state`,
        `user_inv_country`,
        `user_admin`,
        `user_photo_url`,
        `user_apikey`) VALUES ('$QueryTitle',
        '$QueryForename',
        '$QuerySurname',
        '$QueryEmail',
        '$QueryPassword',
        '$QueryDOB',
        '$QueryGender',
        '$QueryPhone',
        '$QueryMobile',
        '$QueryShipLineOne',
        '$QueryShipLineTwo',
        '$QueryShipTown',
        '$QueryShipZip',
        '$QueryShipState',
        '$QueryShipCountry',
        '$QueryInvLineOne',
        '$QueryInvLineTwo',
        '$QueryInvTown',
        '$QueryInvZip',
        '$QueryInvState',
        '$QueryInvCountry',
         $QueryAdmin,
        '$QueryPhotoURL',
        '$apiKey')";
        
        
        $insertresult = $conn->query($insert);

        if(!$insertresult){
            return $conn->error;
        } else {
            return "$user_forename";
        }
        

    }

    //Delete user
    function deleteUser($user_id) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($user_id);
        $queryUserID = htmlentities($queryUserID);

        //Delete record from view history -> wishlist -> vehicles -> user profile
        $queryDeleteHistory = "DELETE FROM ASSIGNMENT_view_history
        WHERE view_history_user_id = $queryUserID";

        $queryDeleteWishlist = "DELETE FROM ASSIGNMENT_wishlist
        WHERE User_ID = $queryUserID";

        $queryDeleteVehicles = "DELETE FROM ASSIGNMENT_vehicles
        WHERE user_ID = $queryUserID";

        $queryDeleteUser = "DELETE FROM ASSIGNMENT_user
        WHERE User_ID = $queryUserID";

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
                    $deleteUserResult = $conn->query($queryDeleteUser);
                    if (!$deleteUserResult){
                        return $conn->error;
                    } else {
                        return "Success";
                    }
                }
            }
        }
        

    }

    //Check if user is a site admin
    function checkSiteAdmin($userID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userID);
        $queryUserID = htmlentities($queryUserID);

        $getUserLoginInfo = "SELECT 
            ASSIGNMENT_user.user_admin AS 'admin' 
            FROM `ASSIGNMENT_user` 
            WHERE ASSIGNMENT_user.User_ID = $queryUserID";

        $UserLoginInfo = $conn->query($getUserLoginInfo);

        if(!$UserLoginInfo){
            echo $conn->error;
        }

        $result = $UserLoginInfo->fetch_array(MYSQLI_ASSOC);

        echo json_encode($result);

    }

    //Update a user record
    function updateUser($userid, $title, $forename, $surname, $email, $password, $dob, $gender, $phone, $mobile, $shiplineone, $shiplinetwo, $shiptown, $shipzip, $shipstate, $shipcountry, $invlineone, $invlinetwo, $invtown, $invzip, $invstate, $invcountry, $photourl){

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userid);
        $queryUserID = htmlentities($queryUserID);
        $QueryTitle = $conn->real_escape_string($title);
        $QueryTitle = htmlentities($QueryTitle);
        $QueryForename = $conn->real_escape_string($forename);
        $QueryForename = htmlentities($QueryForename);
        $QuerySurname = $conn->real_escape_string($surname);
        $QuerySurname = htmlentities($QuerySurname);
        $QueryEmail = $conn->real_escape_string($email);
        $QueryEmail = htmlentities($QueryEmail);
        $QueryPassword = $conn->real_escape_string($password);
        $QueryPassword = htmlentities($QueryPassword);
        $QueryDOB = $conn->real_escape_string($dob);
        $QueryDOB = htmlentities($QueryDOB);
        $QueryGender = $conn->real_escape_string($gender);
        $QueryGender = htmlentities($QueryGender);
        $QueryPhone = $conn->real_escape_string($phone);
        $QueryPhone = htmlentities($QueryPhone);
        $QueryMobile = $conn->real_escape_string($mobile);
        $QueryMobile = htmlentities($QueryMobile);
        $QueryShipLineOne = $conn->real_escape_string($shiplineone);
        $QueryShipLineOne = htmlentities($QueryShipLineOne);
        $QueryShipLineTwo = $conn->real_escape_string($shiplinetwo);
        $QueryShipLineTwo = htmlentities($QueryShipLineTwo);
        $QueryShipTown = $conn->real_escape_string($shiptown);
        $QueryShipTown = htmlentities($QueryShipTown);
        $QueryShipZip = $conn->real_escape_string($shipzip);
        $QueryShipZip = htmlentities($QueryShipZip);
        $QueryShipState = $conn->real_escape_string($shipstate);
        $QueryShipState = htmlentities($QueryShipState);
        $QueryShipCountry = $conn->real_escape_string($shipcountry);
        $QueryShipCountry = htmlentities($QueryShipCountry);
        $QueryInvLineOne = $conn->real_escape_string($invlineone);
        $QueryInvLineOne = htmlentities($QueryInvLineOne);
        $QueryInvLineTwo = $conn->real_escape_string($invlinetwo);
        $QueryInvLineTwo = htmlentities($QueryInvLineTwo);
        $QueryInvTown = $conn->real_escape_string($invtown);
        $QueryInvTown = htmlentities($QueryInvTown);
        $QueryInvZip = $conn->real_escape_string($invzip);
        $QueryInvZip = htmlentities($QueryInvZip);
        $QueryInvState = $conn->real_escape_string($invstate);
        $QueryInvState = htmlentities($QueryInvState);
        $QueryInvCountry = $conn->real_escape_string($invcountry);
        $QueryInvCountry = htmlentities($QueryInvCountry);
        $QueryPhotoURL = $conn->real_escape_string($photourl);
        $QueryPhotoURL = htmlentities($QueryPhotoURL);

        $updateQuery = "UPDATE ASSIGNMENT_user
            SET ASSIGNMENT_user.user_title = '$QueryTitle',
            ASSIGNMENT_user.user_forename = '$QueryForename',
            ASSIGNMENT_user.user_surname = '$QuerySurname',
            ASSIGNMENT_user.user_email = '$QueryEmail',
            ASSIGNMENT_user.user_password = '$QueryPassword',
            ASSIGNMENT_user.user_dob = '$QueryDOB',
            ASSIGNMENT_user.user_gender = '$QueryGender',
            ASSIGNMENT_user.user_phone = '$QueryPhone',
            ASSIGNMENT_user.user_mobile = '$QueryMobile',
            ASSIGNMENT_user.user_ship_line_one = '$QueryShipLineOne',
            ASSIGNMENT_user.user_ship_line_two = '$QueryShipLineTwo',
            ASSIGNMENT_user.user_ship_town = '$QueryShipTown',
            ASSIGNMENT_user.user_ship_zip = '$QueryShipZip',
            ASSIGNMENT_user.user_ship_state = '$QueryShipState',
            ASSIGNMENT_user.user_ship_country = '$QueryShipCountry',
            ASSIGNMENT_user.user_inv_line_one = '$QueryInvLineOne',
            ASSIGNMENT_user.user_inv_line_two = '$QueryInvLineTwo',
            ASSIGNMENT_user.user_inv_town = '$QueryInvTown',
            ASSIGNMENT_user.user_inv_zip = '$QueryInvZip',
            ASSIGNMENT_user.user_inv_state = '$QueryInvState',
            ASSIGNMENT_user.user_inv_country = '$QueryInvCountry',
            ASSIGNMENT_user.user_photo_url = '$QueryPhotoURL'
            WHERE ASSIGNMENT_user.User_ID = $queryUserID
        ";

        $queryResult = $conn->query($updateQuery);
        
        if(!$queryResult){
            return $conn->error;
        } else {
            return "success";
        }

    }

    //Get payment cards for a user
    function getPaymentMethods($userid) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userid);
        $queryUserID = htmlentities($queryUserID);

        $selectQuery = "SELECT ASSIGNMENT_payment_options.payment_option_id AS 'paymentid',
        ASSIGNMENT_payment_options.payment_card_type AS 'cardtype',
        ASSIGNMENT_payment_options.payment_card_no AS 'cardno',
        ASSIGNMENT_payment_options.payment_expiry_month AS 'expmonth',
        ASSIGNMENT_payment_options.payment_expiry_year AS 'expyear'
        FROM ASSIGNMENT_payment_options
        WHERE ASSIGNMENT_payment_options.user_id = $queryUserID";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            return $conn->error;
        }

        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);

    }

    //Add a new payment card
    function addPaymentCard($userid, $cardNumber, $cardType, $expMonth, $expYear) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryUserID = $conn->real_escape_string($userid);
        $queryUserID = htmlentities($queryUserID);
        $queryCardNumber = $conn->real_escape_string($cardNumber);
        $queryCardNumber = htmlentities($queryCardNumber);
        $queryCardType = $conn->real_escape_string($cardType);
        $queryCardType = htmlentities($queryCardType);
        $queryExpMonth = $conn->real_escape_string($expMonth);
        $queryExpMonth = htmlentities($queryExpMonth);
        $queryExpYear = $conn->real_escape_string($expYear);
        $queryExpYear = htmlentities($queryExpYear);

        $insertQuery = "INSERT INTO ASSIGNMENT_payment_options
            (user_id,payment_card_type,payment_card_no,payment_expiry_month,payment_expiry_year)
            VALUES($queryUserID,'$queryCardType','$queryCardNumber','$queryExpMonth','$queryExpYear')
        ";

        $queryResult = $conn->query($insertQuery);

        if(!$queryResult){
            return $conn->error;
        } else {
            return "success";
        }

    }

    //Delete a payment card
    function deletePaymentCard($cardID) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryCardID = $conn->real_escape_string($cardID);
        $queryCardID = htmlentities($queryCardID);

        $deleteQuery = "DELETE FROM ASSIGNMENT_payment_options
        WHERE ASSIGNMENT_payment_options.payment_option_id = $queryCardID
        ";

        $queryResult = $conn->query($deleteQuery);

        if(!$queryResult){
            return $conn->error;
        } else {
            return "success";
        }
    }

    //Get all information on all users for the user admin page
    function allUsers() {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $selectQuery = "SELECT * FROM ASSIGNMENT_user";

        $queryResult = $conn->query($selectQuery);

        if(!$queryResult){
            return $conn->error;
        }
        
        $rows = array();

        while ($r = mysqli_fetch_assoc($queryResult)) {
            $rows[] = $r;
        }

        return json_encode($rows);
    }

    //Check that a given email address and date of birth combination is in the database
    function confirmAccount($email) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryEmail = $conn->real_escape_string($email);
        $queryEmail = htmlentities($queryEmail);

        $selectQuery = " SELECT *
            FROM ASSIGNMENT_user
            WHERE ASSIGNMENT_user.user_email = '$queryEmail'
        ";

        $queryResult = $conn->query($selectQuery);

        $num = $queryResult->num_rows;

        if ($num > 0) {     //There is a match
            return 1; 
        } else {            //There is not a match
            return 0; 
        }
    }

    //Reset user password
    function passwordUpdate($email, $newPassword) {

        $dbpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/api/db/db.php";
        include($dbpath);

        $queryEmail = $conn->real_escape_string($email);
        $queryEmail = htmlentities($queryEmail);
        $queryNewPassword = $conn->real_escape_string($newPassword);
        $queryNewPassword = htmlentities($queryNewPassword);

        $updateQuery = "UPDATE ASSIGNMENT_user
            SET ASSIGNMENT_user.user_password = '$queryNewPassword'
            WHERE ASSIGNMENT_user.user_email = '$queryEmail'
        ";

        $updateResult = $conn->query($updateQuery);

        if(!$updateResult){
            return $conn->error;
        } else {
            return 1;
        }
    }
?>