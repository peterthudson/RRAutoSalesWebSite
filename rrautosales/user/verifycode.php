<?php

    session_start();

    //email the token to the user
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mailerRequireOne = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/plugins/PHPMailer/src/Exception.php";
    $mailerRequireTwo = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/plugins/PHPMailer/src/PHPMailer.php";
    $mailerRequireThree = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/plugins/PHPMailer/src/SMTP.php";

    require $mailerRequireOne;
    require $mailerRequireTwo;
    require $mailerRequireThree;


    if(isset($_SESSION["user_id"])) {

        header("Location: profile.php");

    } 

    if(isset($_POST['confirm'])) {

        $email = $_POST['email'];

        $verifyEmailEndp = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/confirmAccount.php?email=$email";
        $verifyEmailResult = file_get_contents($verifyEmailEndp);

        if($verifyEmailResult == 1){
        
            //Generate a random token
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $input_length = strlen($permitted_chars);
            
            $systemToken = '';

            for($i = 0; $i < 10; $i++) {
                $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
                $systemToken .= $random_character;
            }

            $companyEmail = "phudson03@qub.ac.uk";
            $companyName = "RR Auto Sales";

            $messageBody = "
                <p>We have recieved a request to reset the password for this account.<p>
                <p>Your verification code is: <strong>$systemToken</strong></p>
                <p>Please enter this code to continue</p>
            ";

            $mail = new PHPMailer(true);

            try {

                //Recipients
                $mail->setFrom($companyEmail, $companyName); //Sender
                $mail->addAddress($email); //Recipient

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Verification Code';
                $mail->Body    = $messageBody;
                $mail->AltBody = strip_tags($messageBody);

                $mail->send();

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

    } else {
        header("Location: verifyemail.php");
    }
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

        <div class='container-fluid' id=mainbodycontent>
            <div class='container'>
                <div class='row'>
                    <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                        <div class='card card-signin my-5'>
                            <div class='card-body'>
                                <h5 class='card-title text-center'><i class='material-icons text-info mr-2'>password</i>Reset</h5>
                                <form class='form-signin' method='POST' action='verifypassword.php'>
                                    <?php

                                        if($verifyEmailResult == 1){
                                            echo "
            
                                                <p>We've emailed you a verification code. Enter it here to continue</p>
                                                <div class='form-label-group'>
                                                    <h6>Verification Code</h6>
                                                    <input type='text' name='usertoken' class='form-control' required autofocus>
                                                    <input type='hidden' name='systemtoken' class='form-control' value='$systemToken'></input>
                                                    <input type='hidden' name='email' class='form-control' value='$email'></input>
                                                </div>
                                                <div class='form-label-group text-center'>
                                                    <button class='btn btn-outline-info' name='confirm' type='submit'>Confirm</button>
                                                </div>
                                            ";
                                        } else {
                                            echo "
                                                <p>The email address you entered is not valid.        
                                                <div class='text-center'>
                                                    <a class='btn btn-outline-info' href='verifyemail.php'>Back</a>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add the Footer to the bottom of the page -->
        <?php
            $footerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/footer.php";
            include($footerpath);
        ?>

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    </body>
</html>
