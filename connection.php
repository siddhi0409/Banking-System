<?php

$username = "root";
$password = "";
$server = 'localhost';
$db = 'bank';


$con = mysqli_connect($server, $username, $password, $db);

if($con){
    ?>
    <?php
} else {
    die("No connection" . mysqli_connect_error());
}

?>