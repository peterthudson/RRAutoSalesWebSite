<?php

    //--------------------------------------------------------------------------------------
    //--- Adds a new payment card to the database and associates it with a specific user ---
    //--------------------------------------------------------------------------------------

    if(isset($_GET['info'])) {

        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl' crossorigin='anonymous'>";

        echo "
            <p><strong>addPaymentCard.php</strong></p>
            <p>Adds a new payment card to the database</p>

            <p><strong>Method:</strong> POST<p>

            <table class='table'>
                <thead>
                    <tr>
                        <th>Attribute</th>
                        <th>Type</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>userid</td>
                        <td>string</td>
                        <td>The ID number of the currently logged in user</td>
                    </tr>
                    <tr>
                        <td>cardtype</td>
                        <td>string</td>
                        <td>The name of the card supplier</td>
                    </tr>
                    <tr>
                        <td>cardnumber</td>
                        <td>string</td>
                        <td>The sixteen digit number on the card</td>
                    </tr>
                    <tr>
                        <td>expmonth</td>
                        <td>string</td>
                        <td>The expiry month</td>
                    </tr>
                    <tr>
                        <td>expyear</td>
                        <td>string</td>
                        <td>The expiry year</td>
                    </tr>
                    <tr>
                        <td>apikey</td>
                        <td>string</td>
                        <td>The api key of the currently logged in user</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Returns on success:</strong> string(success)</p>
            <p><strong>Returns on fail:</strong> conn->error</p>
        ";

    } else {

        if(isset($_POST['apikey'])){
            
            //include the functions file
            $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
            include($functionpath);
    
            $userid = $_POST['userid'];
            $cardType = $_POST['cardtype'];
            $cardNumber = $_POST['cardnumber'];
            $expMonth = $_POST['expmonth'];
            $expYear = $_POST['expyear'];
            $apikey = base64_decode($_POST['apikey']);
    
            //check that the api key is valid
            $checkAPIKey = checkAPIKey($userid, $apikey);
    
            if ($checkAPIKey == 1) {
    
                //call the function, passing in the attributes from the url
                $result = addPaymentCard($userid, $cardNumber, $cardType, $expMonth, $expYear);
    
                //return the result
                echo $result;
            
            } else {
    
                echo "Invalid API Key";
    
            }
    
        } else {
    
            echo "No API Key is set";
        }
    }
?>