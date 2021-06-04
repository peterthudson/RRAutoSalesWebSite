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
        
        <title>Register</title>
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
                                                        <input type="date" name="dob" value="2018-07-22" min="2018-01-01" max="2018-12-31">
                                                        <!--
                                                        <select class="form-select form-select-sm" name="dobday" style="border-radius:5px">                                              
                                                            <option selected>Day</option>
                                                            <option value="01">1st</option>
                                                            <option value="02">2nd</option>
                                                            <option value="03">3rd</option>
                                                            <option value="04">4th</option>
                                                            <option value="05">5th</option>
                                                            <option value="06">6th</option>
                                                            <option value="07">7th</option>
                                                            <option value="08">8th</option>
                                                            <option value="09">9th</option>
                                                            <option value="10">10th</option>
                                                            <option value="11">11th</option>
                                                            <option value="12">12th</option>
                                                            <option value="13">13th</option>
                                                            <option value="14">14th</option>
                                                            <option value="15">15th</option>
                                                            <option value="16">16th</option>
                                                            <option value="17">17th</option>
                                                            <option value="18">18th</option>
                                                            <option value="19">19th</option>
                                                            <option value="20">20th</option>
                                                            <option value="21">21st</option>
                                                            <option value="22">22nd</option>
                                                            <option value="23">23rd</option>
                                                            <option value="24">24th</option>
                                                            <option value="25">25th</option>
                                                            <option value="26">26th</option>
                                                            <option value="27">27th</option>
                                                            <option value="28">28th</option>
                                                            <option value="29">29th</option>
                                                            <option value="30">39th</option>
                                                            <option value="31">31st</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-select form-select-sm" name="dobmonth" style="border-radius:5px">
                                                            <option selected>Month</option>
                                                            <option value="01">January</option>
                                                            <option value="02">February</option>
                                                            <option value="03">March</option>
                                                            <option value="04">April</option>
                                                            <option value="05">May</option>
                                                            <option value="06">June</option>
                                                            <option value="07">July</option>
                                                            <option value="08">August</option>
                                                            <option value="09">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-select form-select-sm" name="dobyear" style="border-radius:5px">
                                                            <option selected>Year</option>
                                                            <option value="2003">2003</option>
                                                            <option value="2002">2002</option>
                                                            <option value="2001">2001</option>
                                                            <option value="2000">2000</option>
                                                            <option value="1999">1999</option>
                                                            <option value="1998">1998</option>
                                                            <option value="1997">1997</option>
                                                            <option value="1996">1996</option>
                                                            <option value="1995">1995</option>
                                                            <option value="1994">1994</option>
                                                            <option value="1993">1993</option>
                                                            <option value="1992">1992</option>
                                                            <option value="1991">1991</option>
                                                            <option value="1990">1990</option>
                                                            <option value="1989">1989</option>
                                                            <option value="1988">1988</option>
                                                            <option value="1987">1987</option>
                                                            <option value="1986">1986</option>
                                                            <option value="1985">1985</option>
                                                            <option value="1984">1984</option>
                                                            <option value="1983">1983</option>
                                                            <option value="1982">1982</option>
                                                            <option value="1981">1981</option>
                                                            <option value="1980">1980</option>
                                                        </select>
                                                        -->
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
                                                <input type="password" name="password" class="form-control" required>
                                            </div>
                                        </div> 
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">invoice</i>Address</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Address Line One</h1>
                                                <input name="invlineone" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Address Line Two</h1>
                                                <input name="invlinetwo" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Town/City</h1>
                                                <input name="invtown" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>State</h1>
                                                <input name="invstate" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>ZIP Code</h1>
                                                <input name="invzip" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Country</h1>
                                                <input name="invcountry" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-6 col-lg-6">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">delivery</i>Address</h6>
                                            <hr>
                                            <div class="form-label-group">
                                                <h6>Address Line One</h1>
                                                <input name="shiplineone" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Address Line Two</h1>
                                                <input name="shiplinetwo" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Town/City</h1>
                                                <input name="shiptown" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>State</h1>
                                                <input name="shipstate" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>ZIP Code</h1>
                                                <input name="shipzip" class="form-control">
                                            </div>
                                            <div class="form-label-group">
                                                <h6>Country</h1>
                                                <input name="shipcountry" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-label-group">
                                            <button class="btn btn-lg btn-outline-info btn-block text-uppercase" type="submit">Submit</button>
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
        
    </body>
</html>
