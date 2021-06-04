<?php
    $passw = "4b1x5zfd6ggpQhlm";
       
    $username = "phudson03";
 
    $db = "phudson03";
 
    $host = "phudson03.lampt.eeecs.qub.ac.uk";
 
    $conn = new mysqli($host, $username, $passw, $db);
 
    if($conn->connect_error){
        echo "not connected".$conn->connect_error;
    }
 
?>