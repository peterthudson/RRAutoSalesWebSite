<?php

    session_start();

    if(!isset($_SESSION['user_id'])){

        header("Location: login.php");
    }

    //Get info on all users
    $allUsersEndpoint = "http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/api/user/allUsers.php?userid={$_SESSION['user_id']}&apikey={$_SESSION['apikey']}";
    $allUsersJsonResult = file_get_contents($allUsersEndpoint);
    $allUsersArrayResult = json_decode($allUsersJsonResult, true);
    
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

        <title>Profile</title>

        <!-- Add some formatting to hide certain table columns when the screen width is narrowed down -->
        <style>
            @media screen and (max-width: 991px) {
                .optionalcolumn {
                    display: none;
                }
            }

        </style>
    </head>



    <body>
        
        <!-- Add the Navbar to the top of the page -->
        <?php
            $headerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/navbar.php";
            include($headerpath);
        ?>

        <div class="container">
            <div class="main-body">

                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/mypayments.php">Payment Options</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/wishlist/mywishlist.php">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/viewhistory/myviewhistory.php">View History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/mylistedvehicles.php">Listed Vehicles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/myOwnedVehicles.php">Purchased</a>
                    </li>
                    <?php
                        if ($_SESSION['admin'] == 1) {
                            echo "
                                <li class='nav-item'>
                                    <a class='nav-link active' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/useradmin.php'>User Admin</a>
                                </li>
                            ";

                        }
                    ?>
                </ul>

                <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><h3 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">user</i>Administration</h3></li>
                    </ol>
                </nav>

                <div class="container-fluid" id=mainbodycontent>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-11 col-md-11 col-lg-11 col-xl-11 mx-auto">
                                <div class="card card-signin my-5">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">User ID</th>
                                                    <th scope="col">Surname</th>
                                                    <th class="optionalcolumn" scope="col">Forename</th>
                                                    <th class="optionalcolumn" scope="col">Email</th>
                                                    <th class="optionalcolumn" scope="col">Status</th>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $counter = 1;

                                                    foreach ($allUsersArrayResult as $user){
                                                        $tableUserID = $user["User_ID"];
                                                        $tableUserSurname = $user["user_surname"];
                                                        $tableUserForename = $user["user_forename"];
                                                        $tableUserEmail = $user["user_email"];
                                                        
                                                        $apikey = $user['user_apikey'];
                                                        
                                                        if($user["user_admin"] == 1) {
                                                            $adminStatus = "Admin";
                                                        } else {
                                                            $adminStatus = "User";
                                                        }
                                                        
                                                        if($counter%2 == 0) {
                                                            $rowClass = "table table-light";
                                                        } else {
                                                            $rowClass = "table";
                                                        }

                                                        echo "
                                                            <tr class='$rowClass'>
                                                                <td>$tableUserID</td>
                                                                <td>$tableUserSurname</td>
                                                                <td class='optionalcolumn'>$tableUserForename</td>
                                                                <td class='optionalcolumn'>$tableUserEmail</td>
                                                                <td class='optionalcolumn'>$adminStatus</td>
                                                                <td><a class='btn btn-sm btn-primary' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/editprofile.php?userID=$tableUserID&userAPIkey=$apikey'>Edit</a></td>
                                                                <td><a class='btn btn-sm btn-danger' href='http://phudson03.lampt.eeecs.qub.ac.uk/rrautosales/user/confirmdelete.php?userID=$tableUserID&userAPIkey=$apikey'>Delete</a></td>
                                                            </tr>
                                                        ";

                                                        $counter++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $footerpath = $_SERVER['DOCUMENT_ROOT'] . "/rrautosales/templates/footer.php";
            include($footerpath);
        ?>

        <!-- Javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    </body>
</html>