<?php

    session_start();

    if(isset($_SESSION["user_id"])) {

        header("Location: profile.php");

    } 

    $systemToken = $_POST['systemtoken'];
    $userToken = $_POST['usertoken'];
    $email = $_POST['email'];

?>

<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link href="/rrautosales/css/mystyles.css" rel="stylesheet">

        <!-- favicon -->
        <link rel="icon" href="/rrautosales/img/favicon.png" type="image/png" sizes="16x16">
        
        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Icons from ionicons.com -->
        <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>

        <title>Password Reset</title>
        
    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <?php
            if ($userToken == $systemToken) {
                echo "
                    <div class='container-fluid' id=mainbodycontent>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                                    <div class='card card-signin my-5'>
                                        <div class='card-body' style='height:411px'>
                                            <h5 class='card-title text-center'><i class='material-icons text-info mr-2'>password</i>Reset</h5>
                                            <form class='form-signin' method='POST' action='verifypasswordchange.php'>
                                                <p>Enter your new password</p>
                                                <div class='form-label-group'>
                                                    <h6>New Password</h6>
                                                    <input type='password' name='passwordone' id='passwordone' class='form-control' required autofocus>
                                                </div>
                                                <div class='form-label-group'>
                                                    <h6>Confirm New Password</h6>
                                                    <input type='password' name='passwordtwo' id='passwordtwo' class='form-control' required>
                                                </div>
                                                <input type='hidden' name='email' value='$email' class='form-control'>
                                                <div>
                                                    <p id='result'>The Passwords Do Not Match</p>
                                                </div>
                                                <div class='form-label-group text-center'>
                                                    <button id='confirmbutton' class='btn btn-outline-info' name='confirm' type='submit'>Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            } else {
                echo "
                    <div class='container-fluid' id=mainbodycontent>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                                    <div class='card card-signin my-5'>
                                        <div class='card-body'>
                                            <h5 class='card-title text-center'><i class='material-icons text-info mr-2'>password</i>Reset</h5>
                                            <form class='form-signin' method='POST' action='verifypasswordchange.php'>
                                                <p>The token you entered does not match</p>
                                                <div class='text-center'>
                                                    <a class='btn btn-outline-info' href='verifyemail.php'>Back</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        ?>
        <script>
            $(function() {
                $('#result').hide();
                $('#confirmbutton').hide();
            });

            $('input').blur(function() {
                var pass = $('#passwordone').val();
                var repass = $('input[name=passwordtwo]').val();
                if(($('#passwordone').val().length == 0) || ($('#passwordtwo').val().length == 0)){
                    $('#result').hide();
                    $('#confirmbutton').hide();
                }
                else if (pass != repass) {
                    $('#result').css('color', 'red');
                    $('#result').html('The passwords do not match');
                    $('#result').show();
                    $('#confirmbutton').hide();
                }
                else {
                    $('#result').css('color', 'green');
                    $('#result').html('The passwords match');
                    $('#result').show();
                    $('#confirmbutton').show();
                }
            });
        </script>
        <!-- Add the Footer to the bottom of the page -->
        <?php
            $footerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/footer.php";
            include($footerpath);
        ?>

        

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    </body>
</html>
