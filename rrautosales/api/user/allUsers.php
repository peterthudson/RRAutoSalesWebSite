<?php

    //---------------------------------------------------
    //--- Returns a list of all users in the database ---
    //---------------------------------------------------

    if(isset($_GET['info'])) {

        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl' crossorigin='anonymous'>";

        echo "
            <p><strong>allUsers.php</strong></p>
            <p>Returns a list of all the users in the database</p>

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
                        <td>The ID number of the currently logged in user</td>
                    </tr>
                    <tr>
                        <td>apikey</td>
                        <td>string</td>
                        <td>The api key of the currently logged in user</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Returns on success:</strong> All attributes for all records in the user table (JSON encoded)</p>
            <p><strong>Returns on fail:</strong> conn->error</p>
        ";

    } else {

        if(isset($_GET['apikey'])){

            //include the functions file
            $functionpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/functions/userfunctions.php";
            include($functionpath);

            $userid = $_GET['userid'];
            $apikey = base64_decode($_GET['apikey']);

            //check that the api key is valid
            $checkAPIKey = checkAPIKey($userid, $apikey);

            if ($checkAPIKey == 1) {

                //call the function, passing in the attributes from the url
                $result = allUsers();

                //return the result
                echo $result;
            
            } else {

                echo "Invalid API Key";
            }
        
        } else {

            echo "No API Key Set";
        }

    }
    
?>