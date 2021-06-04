<?php

    //------------------------------------------------------------------
    //--- Checks to see if an API key already exists in the database ---
    //------------------------------------------------------------------

    if(isset($_GET['info'])) {

        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl' crossorigin='anonymous'>";

        echo "
            <p><strong>apiKeyExists.php</strong></p>
            <p>Checks that an API key exists in the database [NO LONGER USED] </p>

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

        $apiKey = base64_decode($_GET['apiKey']);

        //call the function, passing in the attributes from the url
        $result = apiKeyExists($apiKey);

        //return the result
        echo $result;
    
    }

?>