<?php

    //------------------------------------------------------------------------------------------
    //--- Checks to see if a given user ID and apikey have a matching record in the database ---
    //------------------------------------------------------------------------------------------

    if(isset($_GET['info'])) {

        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl' crossorigin='anonymous'>";

        echo "
            <p><strong>checkAPIKey.php</strong></p>
            <p>Checks that a given API key and User ID combination have a matching record in the database </p>

            <p><strong>Method:</strong> GET<p>

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
                        <td>The ID number of the user</td>
                    </tr>
                    <tr>
                        <td>apikey</td>
                        <td>string</td>
                        <td>The api key of the currently logged in user</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Returns on success:</strong> (integer)1</p>
            <p><strong>Returns on fail:</strong> conn->error</p>
        ";

    } else {

        //include the functions file
        $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
        include($functionpath);

        //get the attributes from the endpoint url
        $userID = $_GET['userid'];
        $apiKey = base64_decode($_GET['apikey']);

        //call the function, passing in the attributes from the url
        $result = checkAPIKey($userID, $apiKey);

        //return the result
        echo $result;
    
    }

?>