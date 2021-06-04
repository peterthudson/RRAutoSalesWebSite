<?php

    session_start();

    if (isset($_SESSION['user_id'])){
        header("Location: profile.php");
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
        
        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <title>Register</title>

        <!--Styling for the password authentication message 
            This styling is only being used for the password authentication window on this page so I haven't included
            it in the CSS file 
        -->
        <style>

            #message {
            display:none;
            background: #FFFFFF;
            color: #000;
            position: relative;
            padding: 20px;
            margin-top: 10px;
            }

            /*18px*/
            #message p {
            padding: 10px 35px;
            font-size: 1rem;
            }

            .valid {
            color: green;
            }

            .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
            }

            .invalid {
            color: red;
            }

            .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
            }
        </style>

    </head>

    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <div class="container-fluid" id=mainbodycontent>
            <div class="container">
                <div class="row">
                    <div class="col-xs-9 col-sm-11 col-md-11 col-lg-11 col-xl-11 col-xxl-11">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center"><i class="material-icons text-info mr-2">new</i>User</h5>
                                <form class="form-signin" method='POST' action='newuser.php'>
                                    <div class="row justify-content-center">  
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">personal</i>Info</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Title</h6>
                                                <select class="form-select form-select-sm" name="title" style="border-radius:5px">
                                                    <option selected>Title</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Miss">Miss</option>
                                                    <option value="Mx">Mx</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>First Name<i style="font-size:x-small"> (required)</i></h6>
                                                <input name="forename" class="form-control" required>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Surname<i style="font-size:x-small"> (required)</i></h6>
                                                <input name="surname" class="form-control" required>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Date of Birth</h6>
                                                <div class="row">
                                                    <div class="col">
                                                        <?php 
                                                            $date = date('Y-m-d');
                                                            $maxDate = date('Y-m-d');
                                                            echo "<input type='date' name='dob' value='$date' min='1950-01-01' max='$maxDate' required>"; 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Gender</h6>
                                                <input name="gender" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Phone<i style="font-size:x-small"> (required)</i></h6>
                                                <input name="phone" class="form-control" required>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Mobile</h6>
                                                <input name="mobile" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Profile Photo URL</h6>
                                                <input name="photourl" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">login</i>Info</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Email Address<i style="font-size:x-small"> (required)</i></h6>
                                                <input type="email" name="email" class="form-control" required autofocus>
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Password<i style="font-size:x-small"> (required)</i></h1>
                                                <input type="password" id="psw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" required>
                                            </div>
                                            <div id="message">
                                                <p><strong>Password must contain the following:</strong></p>
                                                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                                <p id="number" class="invalid">A <b>number</b></p>
                                                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                            </div>
                                        </div> 
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">invoice</i>Address</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Address Line One</h1>
                                                <input id="invlineone" name="invlineone" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Address Line Two</h1>
                                                <input id="invlinetwo" name="invlinetwo" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Town/City</h1>
                                                <input id="invtown" name="invtown" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>State</h1>
                                                <input id="invstate" name="invstate" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>ZIP Code</h1>
                                                <input id="invzip" name="invzip" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Country</h1>
                                                <input id="invcountry" name="invcountry" class="form-control">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="usesameaddress" name="usesameaddress">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Use the same address as my delivery address
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">shipping</i>Address</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Address Line One</h1>
                                                <input id="shiplineone" name="shiplineone" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Address Line Two</h1>
                                                <input id="shiplinetwo" name="shiplinetwo" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Town/City</h1>
                                                <input id="shiptown" name="shiptown" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>State</h1>
                                                <input id="shipstate" name="shipstate" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>ZIP Code</h1>
                                                <input id="shipzip" name="shipzip" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Country</h1>
                                                <input id="shipcountry" name="shipcountry" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-label-group">
                                            <button style="margin-top:10px" class="btn btn-lg btn-outline-info btn-block text-uppercase" type="submit">Submit</button>
                                        </div> 
                                    </div>     
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
        
        <script>
            var myInput = document.getElementById("psw");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");


            // When the user clicks on the password field, show the message box
            myInput.onfocus = function() {
                document.getElementById("message").style.display = "block";
            }

            // When the user clicks outside of the password field, hide the message box
            myInput.onblur = function() {
                document.getElementById("message").style.display = "none";
            }

            // When the user starts to type something inside the password field
            myInput.onkeyup = function() {
                // Validate lowercase letters
                var lowerCaseLetters = /[a-z]/g;
                if(myInput.value.match(lowerCaseLetters)) {  
                    letter.classList.remove("invalid");
                    letter.classList.add("valid");
                } else {
                    letter.classList.remove("valid");
                    letter.classList.add("invalid");
                }
            
                // Validate capital letters
                var upperCaseLetters = /[A-Z]/g;
                if(myInput.value.match(upperCaseLetters)) {  
                    capital.classList.remove("invalid");
                    capital.classList.add("valid");
                } else {
                    capital.classList.remove("valid");
                    capital.classList.add("invalid");
                }

                // Validate numbers
                var numbers = /[0-9]/g;
                if(myInput.value.match(numbers)) {  
                    number.classList.remove("invalid");
                    number.classList.add("valid");
                } else {
                    number.classList.remove("valid");
                    number.classList.add("invalid");
                }
                
                // Validate length
                if(myInput.value.length >= 8) {
                    length.classList.remove("invalid");
                    length.classList.add("valid");
                } else {
                    length.classList.remove("valid");
                    length.classList.add("invalid");
                }
            }

            $('#usesameaddress').change(function(){
                {
                    if($(this).prop('checked')){
                        var newValue = $('#invlineone').val();
                        $('#shiplineone').val(newValue);

                        var newValue = $('#invlinetwo').val();
                        $('#shiplinetwo').val(newValue);

                        var newValue = $('#invtown').val();
                        $('#shiptown').val(newValue);

                        var newValue = $('#invstate').val();
                        $('#shipstate').val(newValue);

                        var newValue = $('#invzip').val();
                        $('#shipzip').val(newValue);

                        var newValue = $('#invcountry').val();
                        $('#shipcountry').val(newValue);
                        
                    } else {
                        $('#shiplineone').val('');
                        $('#shiplinetwo').val('');
                        $('#shiptown').val('');
                        $('#shipstate').val('');
                        $('#shipzip').val('');
                        $('#shipcountry').val('');
                    }
                }
            });

            </script>
    </body>
</html>
