<?php

    //--------------------------------------------------------
    //--- Updates the attributes for a given user account  ---
    //--------------------------------------------------------

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //include the functions file
        $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
        include($functionpath);

        //We reference the data by the keys in the array that was passed 
        $userid = $_POST['userid'];
        $title = $_POST['title'];
        $forename = $_POST['forename'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $mobile = $_POST['mobile'];
        $shiplineone = $_POST['shiplineone'];
        $shiplinetwo = $_POST['shiplinetwo'];
        $shiptown = $_POST['shiptown'];
        $shipzip = $_POST['shipzip'];
        $shipstate = $_POST['shipstate'];
        $shipcountry = $_POST['shipcountry'];
        $invlineone = $_POST['invlineone'];
        $invlinetwo = $_POST['invlinetwo'];
        $invtown = $_POST['invtown'];
        $invzip = $_POST['invzip'];
        $invstate = $_POST['invstate'];
        $invcountry = $_POST['invcountry'];
        $photourl = $_POST['photourl'];

        $updateUser = updateUser($userid, $title, $forename, $surname, $email, $password, $dob, $gender, $phone, $mobile, $shiplineone, $shiplinetwo, $shiptown, $shipzip, $shipstate, $shipcountry, $invlineone, $invlinetwo, $invtown, $invzip, $invstate, $invcountry, $photourl);

        //Return a message to say that the query has been completed or return the error message.
        echo $updateUser;

    }

?>




